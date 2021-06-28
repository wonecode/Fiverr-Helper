<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Quest;
use Faker\Factory;
use Faker\Generator;

class QuestFixtures extends Fixture
{
    public const MAX_FIXTURES = 50;
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < self::MAX_FIXTURES; $i++) {
            $quest = new Quest();
            $quest->setName($this->faker->sentence());
            $quest->setDescription($this->faker->paragraph());
            $quest->setExperience($this->faker->numberBetween(0, 100));
            $quest->setMinimumLevel($this->faker->randomDigit());

            $manager->persist($quest);
        }
        $quest = new Quest();
        $quest->setName('Welcome in your first quest');
        $quest->setDescription('For this first quest you just have to help a freelance !');
        $quest->setExperience(10);
        $quest->setMinimumLevel(0);

        $manager->persist($quest);
        
        $manager->flush();
    }
}
