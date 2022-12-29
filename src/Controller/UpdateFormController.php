<?php

namespace App\Controller;

use App\Form\UpdateFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UpdateFormController extends AbstractController
{
    #[Route('/update/form', name: 'app_update_form')]
    public function index(Request $request, UserPasswordHasherInterface $hasher, EntityManagerInterface $em, $updated = false): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $form = $this->createForm(UpdateFormType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $newPassword = $form->getData();

            if( !is_null($newPassword)) {
                $password = $hasher->hashPassword($newPassword, $newPassword->getPassword());
                $user->setPassword($password);
            } else {
                $user->getPassword();
            }

            $em->persist($user);

            $em->flush();
            $updated = true;
        }

        return $this->render('update_form/index.html.twig', [
            'controller_name' => 'UpdateFormController',
            'form' => $form->createView(),
            'updated' => $updated
        ]);
    }
}
