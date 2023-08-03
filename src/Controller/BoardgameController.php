<?php

namespace App\Controller;

use App\Entity\Boardgame;
use App\Repository\BoardgameRepository;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class BoardgameController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(Environment $twig, BoardgameRepository $boardgameRepository): Response
    {
        /*return $this->render('boardgame/index.html.twig', [
            'controller_name' => 'BoardgameController',
        ]);*/
        return new Response($twig->render('boardgame/index.html.twig', [
            'boardgames' => $boardgameRepository->findAll(),
        ]));
    }

    #[Route('/boardgame/{id}', name: 'boardgame')]
    public function show(Environment $twig, Boardgame $boardgame, CommentRepository $commentRepository): Response
    {
        return new Response($twig->render('boardgame/show.html.twig', [
            'boardgame' => $boardgame,
            'comments' => $commentRepository->findBy(['boardgame' => $boardgame], ['createdAt' => 'DESC']),
        ]));
    }
}
