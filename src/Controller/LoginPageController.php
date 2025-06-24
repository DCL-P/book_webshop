<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class LoginPageController extends AbstractController
{
    #[Route('/login', name: 'login_page')]
    public function index(): Response
    {
        $user = new Users();
        
        return $this->render('login_page.html.twig');
    }
}
