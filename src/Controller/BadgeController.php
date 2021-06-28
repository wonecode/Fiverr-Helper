<?php

namespace App\Controller;

use App\Entity\Badge;
use App\Form\BadgeType;
use App\Repository\BadgeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/badge")
 */
class BadgeController extends AbstractController
{
    /**
     * @Route("/", name="badge_index", methods={"GET"})
     */
    public function index(BadgeRepository $badgeRepository): Response
    {
        return $this->render('badge/index.html.twig', [
            'badges' => $badgeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="badge_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $badge = new Badge();
        $form = $this->createForm(BadgeType::class, $badge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($badge);
            $entityManager->flush();

            return $this->redirectToRoute('badge_index');
        }

        return $this->render('badge/new.html.twig', [
            'badge' => $badge,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="badge_show", methods={"GET"})
     */
    public function show(Badge $badge): Response
    {
        return $this->render('badge/show.html.twig', [
            'badge' => $badge,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="badge_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Badge $badge): Response
    {
        $form = $this->createForm(BadgeType::class, $badge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('badge_index');
        }

        return $this->render('badge/edit.html.twig', [
            'badge' => $badge,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="badge_delete", methods={"POST"})
     */
    public function delete(Request $request, Badge $badge): Response
    {
        if ($this->isCsrfTokenValid('delete'.$badge->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($badge);
            $entityManager->flush();
        }

        return $this->redirectToRoute('badge_index');
    }
}
