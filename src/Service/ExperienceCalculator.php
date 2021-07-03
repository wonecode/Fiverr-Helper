<?php

namespace App\Service;

use App\Entity\Level;
use App\Entity\User;
use App\Entity\Quest;
use App\Repository\LevelRepository;
use Doctrine\ORM\EntityManagerInterface;

class ExperienceCalculator
{
    private EntityManagerInterface $em;
    private LevelRepository $levelRepository;

    public function __construct(EntityManagerInterface $em, LevelRepository $levelRepository)
    {
        $this->em = $em;
        $this->levelRepository = $levelRepository;
    }

    public function getLevelExperience(User $user, int $max = 0): Level
    {
        return $this->levelRepository->findOneBy(['number' => $user->getLevel() + $max]);
    }

    public function percentageExperience(User $user)
    {
        if ($user->getLevel() < $this->levelRepository->findOneBy([],['id' => 'DESC'])->getNumber()) {
            $actualLevelExperience = $this->getLevelExperience($user)->getExperience();
            $neededExperience = $this->getLevelExperience($user, 1)->getExperience();
            $userExperience = $user->getExperience();

            $goalExperience = $neededExperience - $actualLevelExperience;
            $experienceUserCalc = $userExperience - $actualLevelExperience;

            return (($experienceUserCalc * 100) / $goalExperience);
        }

        return 100;
    }

    // Check if user have the minimum level to do quest
    public function isAvailable(Quest $quest, User $user)
    {
        if ($user->getLevel() >= $quest->getMinimumLevel()) {
            if ($user->getFinishedQuest()) {
            }
            return true;
        }
        return false;
    }

    // Simply add experience from quest to user
    public function addExperience(Quest $quest, User $user)
    {
        $user->setExperience($user->getExperience() + $quest->getExperience());
        $this->em->flush();
    }

    // Check if user have minimum Experience to reach next level
    public function canLevelUp(User $user)
    {
        if ($user->getLevel() < $this->levelRepository->findOneBy([],['id' => 'DESC'])->getNumber()) {
            //recupérér le level corespondant à l'expérience utilisateur
            $levelActual = $this->levelRepository->findNextLevel($user->getExperience())->getNumber();
            // si level différent à set user
            if ($user->getLevel() < $levelActual) {
                $user->setLevel($levelActual);
                $this->em->flush();
            }
        }
    }

    // Save quest and user in user_quest table
    public function isAlreadyDo(Quest $quest, User $user)
    {
        $user->addFinishedQuest($quest);
        $this->em->flush();
    }
}
