<?php

namespace App\Controller;

use App\Form\PasswordFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    #[Route('/account', name: 'app_account')]
    public function index(Request $request, UserPasswordHasherInterface $hasher, EntityManagerInterface $em, $updated = false): Response
    {
       /** @var User $user */
       $user = $this->getUser();
       $form = $this->createForm(PasswordFormType::class);

       $form->handleRequest($request);
       if($form->isSubmitted() && $form->isValid()){

           $newPassword = $form->getData();

           $password = $hasher->hashPassword($newPassword, $newPassword->getPassword());
           $user->setPassword($password);

           $em->persist($user);

           $em->flush();
           $updated = true;
       }

       return $this->render('account/index.html.twig', [
           'controller_name' => 'AccountController',
           'form' => $form->createView(),
           'updated' => $updated
       ]);
    }
}
