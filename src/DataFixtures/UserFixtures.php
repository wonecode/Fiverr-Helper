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
        'user' => 1,
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

        $user = new User();
        $user->setEmail('lochlainn@fiverr.com');
        $user->setUsername('Lochlainn Gadault');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'admin'));
        $user->setRoles(['ROLE_USER']);
        $user->setLevel(100);
        $user->setExperience(3640);
        $user->setImage("https://ibb.co/Tb6VFS3");
        $manager->persist($user);


        $user = new User();
        $user->setEmail('mael@fiverr.com');
        $user->setUsername('Mael Chariault');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'admin'));
        $user->setRoles(['ROLE_USER']);
        $user->setLevel(100);
        $user->setExperience(3640);
        $user->setImage("https://ibb.co/t4JNWb5");
        $manager->persist($user);

        $user = new User();
        $user->setEmail('loic@fiverr.com');
        $user->setUsername('Loic Pinguet');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'admin'));
        $user->setRoles(['ROLE_USER']);
        $user->setLevel(100);
        $user->setExperience(3640);
        $user->setImage("https://ibb.co/ys3WMGg");
        $manager->persist($user);

        $user = new User();
        $user->setEmail('tennessee@fiverr.com');
        $user->setUsername('Tennessee Houry');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'admin'));
        $user->setRoles(['ROLE_USER']);
        $user->setLevel(100);
        $user->setExperience(3640);
        $user->setImage("https://ibb.co/wL0cjGY");
        $manager->persist($user);

        foreach ($fakeUsers['results'] as $key => $fakeUser){
            $user = new User();
            $user->setEmail($fakeUser['email']);
            $user->setUsername($fakeUser['login']['username']);
            $user->setPassword($this->passwordHasher->hashPassword($user, '12345'));
            $user->setLevel(self::LEVEL['user']);
            $user->setExperience(0);
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
        $user->setExperience(3640);
        $manager->persist($user);

        $user = new User();
        $user->setEmail('user@fiverr.com');
        $user->setUsername('user');
        $user->setPassword($this->passwordHasher->hashPassword($user, '12345'));
        $user->setLevel(self::LEVEL['user']);
        $user->setExperience(0);
        $manager->persist($user);

        $manager->flush();
    }
}
