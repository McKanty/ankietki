<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnkietaController extends AbstractController
{
    #[Route('/ankieta', name: 'ankieta')]
    public function index(): Response
    {
        return $this->render('ankieta/index.html.twig', [
            'controller_name' => 'AnkietaController',
        ]);
    }
}
