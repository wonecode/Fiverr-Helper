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

    public const USERS_NUMBER = 20;
    private const LEVEL = [
        'user' => 0,
        'admin' => 100
    ];

    public function __construct(UserGeneratorApi $userGenerator, UserPasswordHasherInterface $passwordHasher)
    {
        $this->userGenerator = $userGenerator;
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        $fakeUsers = $this->userGenerator->getManyUser(self::USERS_NUMBER);

        foreach ($fakeUsers['results'] as $key => $fakeUser){
            $user = new User();
            $user->setEmail($fakeUser['email']);
            $user->setUsername($fakeUser['login']['username']);
            $user->setPassword($this->passwordHasher->hashPassword($user, '12345'));
            $user->setLevel(self::LEVEL['user']);
            $user->setImage($fakeUser['picture']['large']);
            $manager->persist($user);
            $this->addReference('user_' . $key, $user);
        }

        $user = new User();
        $user->setEmail('admin@fiverr.com');
        $user->setUsername('admin');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'admin'));
        $user->setRoles(['ROLE_ADMIN']);
        $user->setLevel(self::LEVEL['admin']);
        $manager->persist($user);

        $user = new User();
        $user->setEmail('user@fiverr.com');
        $user->setUsername('user');
        $user->setPassword($this->passwordHasher->hashPassword($user, '12345'));
        $user->setLevel(self::LEVEL['user']);
        $manager->persist($user);

        $manager->flush();
    }
}
