<?php

namespace App\Controller;

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
    #[Route('/complete', name: 'app_complete', methods: [ 'POST'])]
    public function complete( Request $request): Response
    {

        $username= $request->request->get('username');
        $fullname= $request->request->get('fullname');

        if (!empty($username) && !empty($fullname)) {
        }


        $this->addFlash('success', 'Votre profil a bien été complétement.');
        return $this->redirectToRoute('app_profile');
    }

}
