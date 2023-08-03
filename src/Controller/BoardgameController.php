<?php

namespace App\Controller;

use App\Entity\Boardgame;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\BoardgameRepository;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoardgameController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

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

    //#[Route('/boardgame/{id}', name: 'boardgame')]
    #[Route('/boardgame/{slug}', name: 'boardgame')]
    public function show(Request $request, Boardgame $boardgame, CommentRepository $commentRepository): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setBoardgame($boardgame);
            $this->entityManager->persist($comment);
            $this->entityManager->flush();

            return $this->redirectToRoute('boardgame', ['slug' => $boardgame->getSlug()]);
        }

        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $commentRepository->getCommentPaginator($boardgame, $offset);

        return $this->render('boardgame/show.html.twig', [
            'boardgame' => $boardgame,
            'comments' => $paginator,
            'previous' => $offset - CommentRepository::PAGINATOR_PER_PAGE,
            'next' => min(count($paginator), $offset + CommentRepository::PAGINATOR_PER_PAGE),
            'comment_form' => $form,
        ]);
    }
}
