<?php

namespace App\DataFixtures;

use App\Entity\Badge;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BadgeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $badge = new badge();
        $manager->persist($badge);
        $badge->setName('Unclassified');
        $badge->setStatus('Reach level 2');
        $badge->setImage('build/images/badge.png');

        $badge = new badge();
        $manager->persist($badge);
        $badge->setName('Bronze');
        $badge->setStatus('Reach level 4');
        $badge->setImage('build/images/badge.png');

        $badge = new badge();
        $manager->persist($badge);
        $badge->setName('Silver');
        $badge->setStatus('Reach level 6');
        $badge->setImage('build/images/badge.png');

        $badge = new badge();
        $manager->persist($badge);
        $badge->setName('Gold');
        $badge->setStatus('Reach level 8');
        $badge->setImage('build/images/badge.png');

        $badge = new badge();
        $manager->persist($badge);
        $badge->setName('Platinum');
        $badge->setStatus('Reach level 10');
        $badge->setImage('build/images/badge.png');

        $manager->flush();
    }
}
