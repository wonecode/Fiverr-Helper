<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    private const CATEGORIES = [
        'PHP' => [
            'color' => 'bg-custom-1'
        ],
        'CSS' => [
            'color' => 'bg-custom-2'
        ],
        'Design' => [
            'color' => 'bg-custom-3'
        ],
        'Javascript' => [
            'color' => 'bg-custom-4'
        ],
        'Python' => [
            'color' => 'bg-custom-5'
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::CATEGORIES as $key => $categoryName) {
            $category = new Category();
            $category->setName($key);
            $category->setColor($categoryName['color']);
            $manager->persist($category);
            $this->addReference('category_' . $key, $category);
        }

        $manager->flush();
    }
}
