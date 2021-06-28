<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Service\UserGeneratorApi;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{   
    private UserGeneratorApi $userGenerator;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserGeneratorApi $userGenerator, UserPasswordHasherInterface $passwordHasher)
    {
        $this->userGenerator = $userGenerator;
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        $fakeUsers = $this->userGenerator->getManyUser(20);

        foreach ($fakeUsers['results'] as $fakeUser){
            $user = new User();
            $user->setEmail($fakeUser['email']);
            $user->setUsername($fakeUser['login']['username']);
            $user->setPassword($this->passwordHasher->hashPassword($user, '12345'));
            $user->setLevel(0);
            $user->setImage($fakeUser['picture']['large']);
            $manager->persist($user);
        }

        $user = new User();
        $user->setEmail('admin@fiverr.com');
        $user->setUsername('admin');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'admin'));
        $user->setRoles(['ROLE_ADMIN']);
        $user->setLevel(100);
        $manager->persist($user);

        $user = new User();
        $user->setEmail('user@fiverr.com');
        $user->setUsername('user');
        $user->setPassword($this->passwordHasher->hashPassword($user, '12345'));
        $user->setLevel(0);
        $manager->persist($user);

        $manager->flush();
    }
}
