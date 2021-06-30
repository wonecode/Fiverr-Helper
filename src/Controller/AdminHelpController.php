<?php

namespace App\Controller;

use App\Entity\Help;
use DateTimeImmutable;
use App\Form\Help1Type;
use App\Repository\HelpRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/help", name="admin_")
 */
class AdminHelpController extends AbstractController
{
    /**
     * @Route("/", name="help_index", methods={"GET"})
     */
    public function index(HelpRepository $helpRepository): Response
    {
        return $this->render('admin_help/index.html.twig', [
            'helps' => $helpRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="help_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $help = new Help();
        $form = $this->createForm(Help1Type::class, $help);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($help);
            $entityManager->flush();

            return $this->redirectToRoute('admin_help_index');
        }

        return $this->render('admin_help/new.html.twig', [
            'help' => $help,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="help_show", methods={"GET"})
     */
    public function show(Help $help): Response
    {
        return $this->render('admin_help/show.html.twig', [
            'help' => $help,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="help_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Help $help): Response
    {
        $form = $this->createForm(Help1Type::class, $help);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $help->setUpdatedAt(new DateTimeImmutable());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_help_index');
        }

        return $this->render('admin_help/edit.html.twig', [
            'help' => $help,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="help_delete", methods={"POST"})
     */
    public function delete(Request $request, Help $help): Response
    {
        if ($this->isCsrfTokenValid('delete'.$help->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($help);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_help_index');
    }
}
