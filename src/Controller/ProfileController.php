<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\QuestRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function index(UserRepository $userRepository, QuestRepository $questRepository): Response
    {
        return $this->render('profile/index.html.twig', [
            'user' => $userRepository->find(3),
            'quests' => $questRepository->findAll(),
        ]);
    }


}