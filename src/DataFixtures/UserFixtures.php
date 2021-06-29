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
        $user = new User();
        $user->setEmail('lochlainn@fiverr.com');
        $user->setUsername('lochlainn');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'admin'));
        $user->setRoles(['ROLE_USER']);
        $user->setLevel(100);
        $user->setImage("https://media-exp1.licdn.com/dms/image/D4D35AQFVyelP05kGFA/profile-framedphoto-shrink_200_200/0/1622720197208?e=1625018400&v=beta&t=k8UG0fHD170bDsBwBIk7cw3Ca8nzEgiSSvU6pAhXce4");
        $manager->persist($user);


        $user = new User();
        $user->setEmail('mael@fiverr.com');
        $user->setUsername('mael');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'admin'));
        $user->setRoles(['ROLE_USER']);
        $user->setLevel(100);
        $user->setImage("https://media-exp1.licdn.com/dms/image/D5635AQHWER4YttvKdg/profile-framedphoto-shrink_200_200/0/1621346390927?e=1625018400&v=beta&t=7tz7uYLPBxRgpx7NWWrBp3LwU0h9rWB8gIbPCCnQdK8");
        $manager->persist($user);

        $user = new User();
        $user->setEmail('loic@fiverr.com');
        $user->setUsername('loic');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'admin'));
        $user->setRoles(['ROLE_USER']);
        $user->setLevel(100);
        $user->setImage("https://media-exp1.licdn.com/dms/image/D5635AQEVv0U3IL3Mug/profile-framedphoto-shrink_200_200/0/1622118256076?e=1625018400&v=beta&t=K9-xzZw0DBBy7YDThLfxGJuSttqOWSDR5vhozMRgQ0U");
        $manager->persist($user);

        $user = new User();
        $user->setEmail('tennessee@fiverr.com');
        $user->setUsername('tennessee');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'admin'));
        $user->setRoles(['ROLE_USER']);
        $user->setLevel(100);
        $user->setImage("https://media-exp1.licdn.com/dms/image/D4E35AQG1sIo5SrFhbQ/profile-framedphoto-shrink_200_200/0/1622115993708?e=1625018400&v=beta&t=gN1mbxMfNpCRMbhOjb8crBfr0mYu100-6Jhovka8h_g");
        $manager->persist($user);

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
