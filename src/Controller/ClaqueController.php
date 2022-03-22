<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClaqueController extends AbstractController
{
    /**
     * @Route("/claque", name="claque")
     */
    public function index(): Response
    {
        return $this->render('claque/index.html.twig', [
            'controller_name' => 'ClaqueController',
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home() {
        return $this->render('claque/home.html.twig');
    }
}
