<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class UserController extends AbstractController
{
    #[Route('/profile', name: 'app_profile', methods: ['GET', 'POST'])]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    #[Route('/complete', name: 'app_complete', methods: ['POST'])]
    public function complete(Request $request, EntityManagerInterface $em): Response
    {

        $data = $request->getPayload();

        // dd($data->get('username'));


        // dd($username, $fullname);

        if (!empty($data->get('username')) && !empty($data->get('fullname'))) {

            // Enregistrer les données dans la bdd
            $user = $this->getUser();
            $user
                ->setUsername($data->get('username')) //on met à jour username
                ->setFullname($data->get('fullname')) // on met à jour fullname
            ;
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Votre profil a bien été complétement.');
        } else {
            $this->addFlash('error', 'Veuillez remplir tous les champs.');
        }


        return $this->redirectToRoute('app_profile');
    }
}
