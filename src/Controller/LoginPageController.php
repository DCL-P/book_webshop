<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Users;
use App\Form\UserForm;

//for encrypting passwords upon account creation
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface; //this interface makes sure you can easily hash yan inputted password
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

//for making sure main authentification featues are available (like login etc)
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


final class LoginPageController extends AbstractController
{

    private $passwordHasher;
    private $em;

    //for dependency injections, i decided too go for a constructor injection, since this method is a lot more maintainable then method injection (which requires you to import the dependency in every single method in your class..)
    public function __construct(UserPasswordHasherInterface $UserPasswordHasherInterface, EntityManagerInterface $EntityManagerInterface, AuthenticationUtils $AuthenticationUtils)
    {
        $this->passwordHasher = $UserPasswordHasherInterface;
        $this->em = $EntityManagerInterface;
        $this->au = $AuthenticationUtils;
    }

    // #[Route('/login', name: 'login-page')]
    public function index(Request $request): Response
    {
        //fetches the error that appears if the login has failed
        $error = $this->au->getLastAuthenticationError();

        //for fetching the last submitted username (too make sure the user doesn't have to input their username again if an error accurs)
        $lastUsername = $this->au->getLastUsername();

        $form = $this->createForm(UserForm::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $form_data = $form->getData();

            $username = $form_data['username'];
            $password = $form_data['password'];

            //fetches the repository and uses the findOneBy method to see if a user exists with the submitted username
            $found_user = $this->em->getRepository(UserRepository::class)->findOneBy(['username' => $username]);

            if($found_user)
            {
                if($this->passwordHasher->isPasswordValid($username, $password)){
                    return $this->redirectToRoute('login-page');
                }
            }
        }
        
       return $this->render('login_page.html.twig', ['login_form' => $form]);
    }

    #[Route('/logout', name: 'logout-page')]
    public function logout(Request $request): Response
    {
        //symfony's security bundle should handle the logout logic by itself
    }
}
