<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Users;
use App\Form\CreateUserForm;

//for encrypting passwords upon account creation
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


//---CONTROLLER IS NOT FULLY FUNCTIONAL YET DUE TO PASSWORD HASHING NOT BEING USED CORRECTLY---//
final class SignupPageController extends AbstractController
{
    #[Route('/signup', name: 'signup_page')]
    public function index(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $encrypt_password): Response
    {
        $user = new Users();

        $form = $this->createForm(CreateUserForm::class, $user);

        $form->handleRequest($request);

        if($form->IsSubmitted() && $form->IsValid()){

            //fetch all the data inserted into the sumbitted form
            $form_data = $form->getData();
            var_dump($form_data);
            var_dump($user->getPassword());

            //encrypting user password
            $plain_password = $form_data->getPassword();
            $hashed_password = $encrypt_password->hashPassword($user,  $plain_password);
            $user->setPassword($hashed_password);

            //using the entity manager interface to commit and push the newly created user record too the database
            $em->persist($user);
            $em->flush();

            $submit_message = 'You successfuly created a new account! :D';
            return $this->render('signup_page.html.twig', ['create_account_form' => $form, 'submit_message' => $submit_message]);
        } else {
            $submit_message = 'Your account creation has failed :/ Have you tried inputing all the fields correctly?';
            return $this->render('signup_page.html.twig', ['create_account_form' => $form, 'submit_message' => $submit_message]);
        }

        return $this->render('signup_page.html.twig', ['create_account_form' => $form]);
    }
}
//---CONTROLLER IS NOT FULLY FUNCTIONAL YET DUE TO PASSWORD HASHING NOT BEING USED CORRECTLY---//