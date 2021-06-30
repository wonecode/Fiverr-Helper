<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\BadgeRepository;
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
    public function index(User $user, QuestRepository $questRepository, ExperienceCalculator $experience, BadgeRepository $badge): Response
    {

        for ($i = 1; $i <= $user->getLevel(); ++$i) {
            $level[] = $i;
        }

        

        return $this->render('profile/index.html.twig', [
            'user' => $user,
            'quests' => $questRepository->findby(
                [
                    'minimumLevel' => $level,
                ]
            ),
            'experience' => $experience->percentageExperience($user),
            'badges' => $badge->findby(
                ['minimumLevel' => $level],
            ),
            'accomplished' => $user->getFinishedQuest(),
        ]);
    }
}
