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
        $quest = new Quest();
        $quest->setName('Welcome in your first quest');
        $quest->setDescription('For this first quest you just have to help a freelance !');
        $quest->setExperience(10);
        $quest->setMinimumLevel(1);
        $quest->setGoal(1);
        $manager->persist($quest);

        $quest = new Quest();
        $quest->setName('Help a Web dev');
        $quest->setDescription('For this one you just have to help a web developer !');
        $quest->setExperience(135);
        $quest->setMinimumLevel(1);
        $quest->setGoal(1);
        $manager->persist($quest);

        $quest = new Quest();
        $quest->setName('Help two people');
        $quest->setDescription('For this one you just have to help two persons !');
        $quest->setExperience(1);
        $quest->setMinimumLevel(2);
        $quest->setGoal(2);
        $manager->persist($quest);

        $quest = new Quest();
        $quest->setName('Help two designer');
        $quest->setDescription('For this one you just have to help two designer !');
        $quest->setExperience(10);
        $quest->setMinimumLevel(2);
        $quest->setGoal(2);
        $manager->persist($quest);

        for ($i = 0; $i < self::MAX_FIXTURES; $i++) {
            $quest = new Quest();
            $quest->setName($this->faker->sentence());
            $quest->setDescription($this->faker->paragraph());
            $quest->setExperience($this->faker->numberBetween(1, 100));
            $quest->setMinimumLevel($this->faker->numberBetween(1, 100));
            $quest->setGoal($this->faker->numberBetween(1, 20));

            $manager->persist($quest);
        }
       

        $manager->flush();
    }
}
