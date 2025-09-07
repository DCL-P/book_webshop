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


class SignupPageController extends AbstractController
{

    private $passwordHasher;
    private $em;

    //for dependency injections, i decided too go for a constructor injection, since this method is a lot more maintainable then method injection (which requires you to import the dependency in every single method in your class..)
    public function __construct(UserPasswordHasherInterface $UserPasswordHasherInterface, EntityManagerInterface $EntityManagerInterface){
        $this->passwordHasher = $UserPasswordHasherInterface;
        $this->em = $EntityManagerInterface;
    }

    #[Route('/signup', name: 'signup-page')]
    public function index(Request $request): Response
    {
        $user = new Users();

        $form = $this->createForm(UserForm::class, $user);

        $form->handleRequest($request);

        if($form->IsSubmitted() && $form->IsValid()){

            //fetching all the data from the submitted form
            $form_data = $form->getData();

            //since the form is connected too the Users entity, you can make use of the entities getters and setters!
            //using entity getter to fetch password, but might change it too manually fetch it out of the form. For security reasons.
            $plain_password = $form_data->getPassword();

            //encrypting user password
            $hashed_password = $this->passwordHasher->hashPassword($user, $plain_password);
            $user->setPassword($hashed_password);

            //using the entity manager interface to commit and push the newly created user record too the database
            $this->em->persist($user);
            $this->em->flush();

            $submit_message = 'You successfuly created a new account! :D';
            return $this->render('signup_page.html.twig', ['create_account_form' => $form, 'submit_message' => $submit_message]);
        } else {
            $submit_message = 'Your account creation has failed :/ Have you tried inputing all the fields correctly?';
            return $this->render('signup_page.html.twig', ['create_account_form' => $form, 'submit_message' => $submit_message]);
        }

        return $this->render('signup_page.html.twig', ['create_account_form' => $form]);
    }
}