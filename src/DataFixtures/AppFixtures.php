<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Boardgame;
use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private PasswordHasherFactoryInterface $passwordHasherFactory,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $bloodRage = new Boardgame();
        $bloodRage->setTitle('Blood Rage');
        $bloodRage->setAuthor('Eric M. Lang');
        $bloodRage->setYear('2015');
        $bloodRage->setSdj(false);
        $manager->persist($bloodRage);

        $arkNova = new Boardgame();
        $arkNova->setTitle('Ark Nova');
        $arkNova->setAuthor('Mathias Wigge');
        $arkNova->setYear('2021');
        $arkNova->setSdj(false);
        $manager->persist($arkNova);

        $cascadia = new Boardgame();
        $cascadia->setTitle('Cascadia');
        $cascadia->setAuthor('Randy Flynn');
        $cascadia->setYear('2021');
        $cascadia->setSdj(true);
        $manager->persist($cascadia);

        $comment1 = new Comment();
        $comment1->setBoardgame($bloodRage);
        $comment1->setAuthor('Geraldes');
        $comment1->setEmail('geraldes@mooneye.de');
        $comment1->setText('This is a fantastic boardgame.');
        $comment1->setRating(10);
        $manager->persist($comment1);

        $admin = new Admin();
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setUsername('admin');
        $admin->setPassword($this->passwordHasherFactory->getPasswordHasher(Admin::class)->hash('test'));
        $manager->persist($admin);

        // alles in die DB schreiben
        $manager->flush();
    }
}
