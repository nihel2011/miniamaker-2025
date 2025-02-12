<?php

namespace App\Controller;

use App\Repository\MessageRepository;
use App\Repository\DiscussionRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_USER')]
final class MessageController extends AbstractController{
    function __construct( 
        private DiscussionRepository $dr , 
        private MessageRepository $mr )
        {}
    


    #[Route('/message', name: 'app_message', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('message/index.html.twig', [
            'discussion' => $this-> getUser()->getDiscussions(),
        ]);
    }

    #[Route('/messages/{id}', name: 'app_message_show', methods: ['GET', 'POST'])]
    public function show($id): Response
    {
        return $this->render('message/show.html.twig', [
            'messages' => $this->mr->findByDiscussion($id, ['created_at' => 'DESC']),
        ]);
    }}
