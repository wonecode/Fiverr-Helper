<?php

namespace App\Controller;


use App\Repository\EasterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/easter", name="easter_")
 */
class EasterController extends AbstractController
{
    /**
     * @Route("/", name="win")
     */
    public function index(EntityManagerInterface $em, EasterRepository $easterRepository): Response
    {
        if ($this->getUser()) {
            $hackathon = $easterRepository->findOneBy(['title' => 'hackathon']);
            if ($this->getUser()->getLevel() < $hackathon->getLevel()) {
                $this->getUser()->setLevel($hackathon->getLevel());
                $this->getUser()->setExperience($hackathon->getExperience());
                $hackathon->setUserNumber($hackathon->getUserNumber() - 1);
                $em->flush();
                return $this->render('easter/index.html.twig');
            }
        }

        return $this->redirectToRoute('home');
    }
}
