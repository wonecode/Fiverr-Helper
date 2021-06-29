<?php

namespace App\DataFixtures;

use App\Entity\Easter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EasterFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $easter = new Easter();
        $easter->setTitle('Hackathon');
        $easter->setUserNumber(5);
        $easter->setLevel(100);
        $easter->setExperience(3640);
        $manager->persist($easter);
        $manager->flush();
    }
}
