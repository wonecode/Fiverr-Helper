<?php

namespace App\Controller;

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
    public function index(): Response
    {
        return $this->render('easter/index.html.twig', [
            'controller_name' => 'EasterController',
        ]);
    }
}
