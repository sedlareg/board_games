<?php

namespace App\Controller;

use App\Entity\Boardgame;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\BoardgameRepository;
use App\Repository\CommentRepository;
use App\SpamChecker;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoardgameController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    )
    {
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
    public function show(
        Request                           $request,
        Boardgame                         $boardgame,
        CommentRepository                 $commentRepository,
        SpamChecker                       $spamChecker,
        #[Autowire('%photo_dir%')] string $photoDir,
    ): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setBoardgame($boardgame);

            if ($photo = $form['photo']->getData()) {
                $filename = bin2hex(random_bytes(6)) . '.' . $photo->guessExtension();
                $photo->move($photoDir, $filename);
                $comment->setPhotoFile($filename);
            }

            $this->entityManager->persist($comment);

            $context = [
                'user_ip' => $request->getClientIp(),
                'user_agent' => $request->headers->get('user-agent'),
                'referrer' => $request->headers->get('referer'),
                'permalink' => $request->getUri(),
            ];

            if ($spamChecker->getSpamScore($comment, $context) !== 0) {
                throw new \RuntimeException('Blatant spam, go away!');
            }

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
