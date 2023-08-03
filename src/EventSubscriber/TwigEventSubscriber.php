<?php

namespace App\EventSubscriber;

use App\Repository\BoardgameRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Twig\Environment;

class TwigEventSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly Environment $twig,
        private readonly BoardgameRepository $boardgameRepository
    ){
    }

    public function onControllerEvent(ControllerEvent $event): void
    {
        $this->twig->addGlobal('boardgames', $this->boardgameRepository->findAll());
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ControllerEvent::class => 'onControllerEvent',
        ];
    }
}
