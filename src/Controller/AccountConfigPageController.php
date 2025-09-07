<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Entity\Users;
use App\Form\UserForm;

final class AccountConfigPageController extends AbstractController
{
    #[Route('/account-config', name: 'account-config-page')]
    public function index(): Response
    {
        $user = $this->getUser();

        // $form = $this->createForm(UserForm::class, $user);

        return $this->render('account_config_page.html.twig', ["user" => $user]);
    }
}
