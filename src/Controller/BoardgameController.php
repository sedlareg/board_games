<?php

namespace App\Controller;

use App\Entity\Boardgame;
use App\Repository\BoardgameRepository;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoardgameController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(BoardgameRepository $boardgameRepository): Response
    {
        /*return $this->render('boardgame/index.html.twig', [
            'controller_name' => 'BoardgameController',
        ]);*/
        return $this->render('boardgame/index.html.twig', [
            'boardgames' => $boardgameRepository->findAll(),
        ]);
    }

    #[Route('/boardgame/{id}', name: 'boardgame')]
    public function show(Request $request, Boardgame $boardgame, CommentRepository $commentRepository): Response
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $commentRepository->getCommentPaginator($boardgame, $offset);

        return $this->render('boardgame/show.html.twig', [
            'boardgame' => $boardgame,
            'comments' => $paginator,
            'previous' => $offset - CommentRepository::PAGINATOR_PER_PAGE,
            'next' => min(count($paginator), $offset + CommentRepository::PAGINATOR_PER_PAGE),
        ]);
    }
}
