<?php

namespace App\Controller;

use App\Form\AddImageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddImageController extends AbstractController
{
    #[Route('/add/image', name: 'app_add_image')]
    public function index(Request $request, EntityManagerInterface $em, $updated = false): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $form = $this->createForm(AddImageType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            /** @var UploadedFile $picture */
            $picture = $request->files->get("add_image")['profileImage'];
            $destination = $this->getParameter('kernel.project_dir').'/public/uploads';
            $fileName = $picture->getClientOriginalName();
            $picture->move($destination, $fileName);
            $user->setprofileImage('./uploads/'.$fileName);

            $em->persist($user);

            $em->flush();
            $updated = true;
        }

        return $this->render('add_image/index.html.twig', [
            'controller_name' => 'AddImageController',
            'form' => $form->createView(),
            'updated' => $updated
        ]);
    }
}
