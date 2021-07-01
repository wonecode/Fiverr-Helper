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
        $user->setImage("https://i.ibb.co/z7py0Yv/1622720197208-e-1625140800-v-beta-t-BYXXAj-CPT1-IAh-Fx-FNV86la-Jwaqt-BBFSA2-Ge4-Y5y-JF9-I.jpg");
        $manager->persist($user);
        $this->addReference('lochlainn', $user);


        $user = new User();
        $user->setEmail('mael@fiverr.com');
        $user->setUsername('Mael Chariault');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'admin'));
        $user->setRoles(['ROLE_USER']);
        $user->setLevel(100);
        $user->setExperience(3640);
        $user->setImage("https://i.ibb.co/37C8L0H/1621346390927-e-1625140800-v-beta-t-6qpif-Z4n-Pg-K6a-P-Mz7b-GA2-Rkk-Ndshesg-REI-Ql-Ztm-Cs.jpg");
        $manager->persist($user);

        $user = new User();
        $user->setEmail('loic@fiverr.com');
        $user->setUsername('Loic Pinguet');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'admin'));
        $user->setRoles(['ROLE_USER']);
        $user->setLevel(100);
        $user->setExperience(3640);
        $user->setImage("https://i.ibb.co/pXmJsG4/1622118256076-e-1625140800-v-beta-t-ii-LY-m-PEL8-RPm-NGb-LTs1-2oy04-Leoa3-VAZ-HUHU-Sl-U.jpg");
        $manager->persist($user);

        $user = new User();
        $user->setEmail('tennessee@fiverr.com');
        $user->setUsername('Tennessee Houry');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'admin'));
        $user->setRoles(['ROLE_USER']);
        $user->setLevel(1);
        $user->setExperience(0);
        $user->setImage("https://i.ibb.co/PYmD0Xt/1622115993708-e-1625140800-v-beta-t-1y-ADt-GBwo-YB-LZsc-024-NAekdn-JIQSs-Gl-Fc-E00c-IXAA.jpg");
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
