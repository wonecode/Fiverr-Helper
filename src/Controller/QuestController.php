<?php

namespace App\Controller;

use App\Entity\Quest;
use App\Form\QuestType;
use App\Repository\QuestRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/quest")
 */
class QuestController extends AbstractController
{
    /**
     * @Route("/", name="quest_index", methods={"GET"})
     */
    public function index(QuestRepository $questRepository): Response
    {
        return $this->render('quest/index.html.twig', [
            'quests' => $questRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="quest_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $quest = new Quest();
        $form = $this->createForm(QuestType::class, $quest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($quest);
            $entityManager->flush();

            return $this->redirectToRoute('quest_index');
        }

        return $this->render('quest/new.html.twig', [
            'quest' => $quest,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="quest_show", methods={"GET"})
     */
    public function show(Quest $quest): Response
    { 
        return $this->render('quest/show.html.twig', [
            'quest' => $quest,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="quest_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Quest $quest): Response
    {
        $form = $this->createForm(QuestType::class, $quest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('quest_index');
        }

        return $this->render('quest/edit.html.twig', [
            'quest' => $quest,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="quest_delete", methods={"POST"})
     */
    public function delete(Request $request, Quest $quest): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quest->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($quest);
            $entityManager->flush();
        }

        return $this->redirectToRoute('quest_index');
    }
}
