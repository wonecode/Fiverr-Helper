<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\QuestRepository;
use App\Service\ExperienceCalculator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile/{id}", name="profile")
     */
    public function index(User $user, QuestRepository $questRepository, ExperienceCalculator $experience): Response
    {
        if ($user !== $this->getUser()) {
            return new RedirectResponse('/');
        }
        return $this->render('profile/index.html.twig', [
            'user' => $user,
            'quests' => $questRepository->findAll(),
            'experience' => $experience->percentageExperience(),
            'badges' =>$user->getBadge(),
        ]);
    }


}