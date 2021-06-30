<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/leaderboard", name="ranking_")
 */
class RankingController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->findBy([],[
            'level' => 'DESC',
            'username' => 'ASC'
        ]);

        return $this->render('ranking/index.html.twig', [
            'users' => $users,
        ]);
    }
}
