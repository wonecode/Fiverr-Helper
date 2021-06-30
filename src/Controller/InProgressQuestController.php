<?php

namespace App\Controller;

use App\Entity\InProgressQuest;
use App\Entity\Quest;
use App\Repository\InProgressQuestRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class InProgressQuestController extends AbstractController
{
    /**
     * @Route("/activate/{id}", name="active")
     */
    public function activate(Quest $quest, EntityManagerInterface $em, InProgressQuestRepository $inProgressQuestRepository): Response
    {
        $authorisation = $inProgressQuestRepository->findby([
            'user' => $this->getUser(),
            'isAccomplished' => false,
        ]);
        if (!$authorisation) {
            $inProgress = new InProgressQuest();

            $inProgress->setQuest($quest);
            $inProgress->setUser($this->getUser());

            $em->persist($inProgress);
            $em->flush();

            return $this->redirectToRoute('help_index');
        }
        $this->addFlash('danger', "You already got an active quest");
        return $this->redirectToRoute('profile', ['id' => $this->getUser()->getId()]);
    }

    public function countGoal()
    {
        //re
    }
}
