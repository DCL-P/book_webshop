<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class homepageController extends AbstractController
{
    #[Route('/', name:'home-route')]
    public function ShowHomepage(): Response
    {
        return $this->render('homepage.html.twig');
    }
}