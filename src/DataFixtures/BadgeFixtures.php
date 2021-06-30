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
        $badge->setMinimumLevel(2);
        $badge->setImage('build/images/badge.png');

        $badge = new badge();
        $manager->persist($badge);
        $badge->setName('Bronze');
        $badge->setStatus('Reach level 15');
        $badge->setMinimumLevel(15);
        $badge->setImage('build/images/badgevert.png');

        $badge = new badge();
        $manager->persist($badge);
        $badge->setName('Silver');
        $badge->setStatus('Reach level 50');
        $badge->setMinimumLevel(50);
        $badge->setImage('build/images/badgeargent.png');

        $badge = new badge();
        $manager->persist($badge);
        $badge->setName('Gold');
        $badge->setStatus('Reach level 75');
        $badge->setMinimumLevel(75);
        $badge->setImage('build/images/badgerouge.png');

        $manager->flush();
    }
}
