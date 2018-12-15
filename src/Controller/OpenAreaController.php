<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class OpenAreaController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        return $this->render('open_area/home.html.twig', [
            'controller_name' => 'OpenAreaController',
        ]);
    }


    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('open_area/contact.html.twig', [
            'controller_name' => 'OpenAreaController',
        ]);
    }
}
