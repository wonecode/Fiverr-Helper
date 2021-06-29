<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ranking", name="ranking_")
 */
class RankingController extends AbstractController
{
    /**
     * @Route("/index", name="index")
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
