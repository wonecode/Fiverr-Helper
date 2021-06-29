<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ExperienceCalculator;

class AdminController extends AbstractController
{
    private ExperienceCalculator $experience;
    
    /**
     * @Route("/admin", name="admin")
     */
    public function index(ExperienceCalculator $experience): Response
    {
        dd($experience->test()); 

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}
