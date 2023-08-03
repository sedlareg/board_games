<?php
namespace App\EntityListener;

use App\Entity\Boardgame;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

#[AsEntityListener(event: Events::prePersist, entity: Boardgame::class)]
#[AsEntityListener(event: Events::preUpdate, entity: Boardgame::class)]
class BoardgameEntityListener
{
    public function __construct(
        private readonly SluggerInterface $slugger,
    ) {
    }

    public function prePersist(Boardgame $boardgame, LifecycleEventArgs $event)
    {
        $boardgame->computeSlug($this->slugger);
    }

    public function preUpdate(Boardgame $boardgame, LifecycleEventArgs $event)
    {
        $boardgame->computeSlug($this->slugger);
    }
}
