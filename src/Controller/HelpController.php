<?php

namespace App\Controller;

use App\Entity\Help;
use App\Form\HelpType;
use DateTimeImmutable;
use App\Entity\Comment;
use App\Entity\FilterCategory;
use App\Form\CommentType;
use App\Form\FilterCategoryType;
use App\Repository\HelpRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/help", name="help_")
 */
class HelpController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(HelpRepository $helpRepository, Request $request): Response
    {
        $helps = $helpRepository->findBy([
            'active' => true
        ]);

        $filterCategory = new FilterCategory();
        $form = $this->createForm(FilterCategoryType::class, $filterCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($filterCategory->getCategory()) {
                $helps = $helpRepository->findBy([
                    'active' => $filterCategory->getActive(),
                    'category' => $filterCategory->getCategory()
                ]);
            } else {
                $helps = $helpRepository->findBy([
                    'active' => $filterCategory->getActive()
                ]);
            }
        }

        return $this->render(
            'help/index.html.twig',
            [
                'helps' => $helps,
                'filter' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/new", name="new")
     */
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $help = new Help();

        $form = $this->createForm(HelpType::class, $help);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $help->setCreatedAt(new DateTimeImmutable());
            $help->setActive(true);
            $help->setApplicant($this->getUser());
            $em->persist($help);
            $em->flush();

            return $this->redirectToRoute('help_index');
        }

        return $this->render('help/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{help}", name="show")
     */
    public function show(Help $help, Request $request, EntityManagerInterface $em): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setUser($this->getUser());
            $comment->setHelp($help);
            $em->persist($comment);

            $help->addAssist($this->getUser());

            $em->flush();
            return $this->redirectToRoute('help_show', ['help' => $help->getId()]);
        }

        return $this->render(
            'help/show.html.twig',
            [
                'help' => $help,
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/edit/{help}", name="edit")
     */
    public function edit(Help $help, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(HelpType::class, $help);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $help->setUpdatedAt(new DateTimeImmutable());
            $em->flush();
            $this->addFlash('info', '
            your request for help has been modified.');
            return $this->redirectToRoute('help_show', ['help' => $help->getId()]);
        }

        return $this->render('help/edit.html.twig', [
            'help' => $help,
            'form' => $form->createView(),
            'button_label' => 'Modify your request',
        ]);
    }

    /**
     * @Route("/remove/{id}", name="delete", methods={"POST"})
     */
    public function delete(Request $request, Help $help, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete' . $help->getId(), $request->request->get('_token'))) {
            $em->remove($help);
            $em->flush();
            $this->addFlash('danger', 'your request for help has been deleted');
        }

        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/close/{help}", name="close")
     */
    public function close(Help $help, EntityManagerInterface $em): Response
    {
        $help->setActive(false);
        $em->flush();

        return $this->redirectToRoute('help_index');
    }
}
