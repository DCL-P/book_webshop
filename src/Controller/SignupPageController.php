<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SignupPageController extends AbstractController
{
    #[Route('/signup', name: 'signup_page')]
    public function index(): Response
    {
        return $this->render('signup_page.html.twig');
    }
}
