<?php

namespace App\Controller;

use App\Service\LoginHistoryService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class PageController extends AbstractController
{
    #[Route('/', name: 'app_homepage', methods: ['GET'])]
    public function index(Request $request, LoginHistoryService $lhs): Response
    {
        if (
            $this->getUser() &&
            $request->headers->get('referer') == "https://localhost:8000/login"
        ) {
            $lhs->addHistory(
                $this->getUser(),
                $request->headers->get('user-agent'),
                $request->getClientIp()
            );
        }
        // dd($request->get('referer'));
        // dd($request);

        if (!$this->getUser()) {
            return $this->render('page/lp.html.twig');
        }

        return $this->render('page/homepage.html.twig');
    }
}
