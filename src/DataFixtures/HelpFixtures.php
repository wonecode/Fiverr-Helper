<?php

namespace App\DataFixtures;

use App\Entity\Help;
use DateTimeImmutable;
use App\DataFixtures\UserFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class HelpFixtures extends Fixture implements DependentFixtureInterface
{
    private const SUBJECTS = [
        [
            'category'=> 'PHP',
            'subject' => 'Need your help for php code',
            'description' => 'I need your help because my site turn in a loop infinite.'
        ],
        [
            'category'=> 'Design',
            'subject' => 'Need your help for design',
            'description' => 'Please my design is not beautiful. I need your opinion.'
        ],
        [
            'category'=> 'CSS',
            'subject' => 'Need your help for css code',
            'description' => 'I have a problem with a css animation. Can you help me please.'
        ]
    ];

    public function load(ObjectManager $manager)
    {
        for ($i=0; $i < UserFixtures::USERS_NUMBER; $i++) {
            $askHelp = self::SUBJECTS[array_rand(self::SUBJECTS)];
            $help = new Help();
            $help->setSubject($askHelp['subject']);
            $help->setDescription($askHelp['description']);
            $help->setActive(true);
            $help->setCreatedAt(new DateTimeImmutable());
            $help->setApplicant($this->getReference('user_' . $i));
            $help->setCategory($this->getReference('category_' . $askHelp['category']));
            $manager->persist($help);
        }

        $help = new Help();
        $help->setSubject('My design is good but not enough');
        $help->setDescription('Please help me');
        $help->setActive(true);
        $help->setCreatedAt(new DateTimeImmutable());
        $help->setApplicant($this->getReference('lochlainn'));
        $help->setCategory($this->getReference('category_Design'));
        $manager->persist($help);

        $help = new Help();
        $help->setSubject('I\'m looking to a work-study in React/Node');
        $help->setDescription('Please help me to find out my work-study... Thanks guys !');
        $help->setActive(true);
        $help->setCreatedAt(new DateTimeImmutable());
        $help->setApplicant($this->getReference('lochlainn'));
        $help->setCategory($this->getReference('category_Javascript'));
        $manager->persist($help);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            CategoryFixtures::class
        ];
    }
}
