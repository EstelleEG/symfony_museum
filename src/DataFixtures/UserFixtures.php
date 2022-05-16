<?php

namespace App\DataFixtures;

use App\Entity\Interfaces\IRole;
use App\Entity\User; 
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserFixtures extends Fixture implements IRole
{

    private $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher) 
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }


    public function load(ObjectManager $manager): void
    {
        $user = new User;
        $user->setEmail("admin@admin.fr");
        $user->setNom("greg");
        $user->setPrenom("estelle");
        $user->addRole(self::ROLE_ADMIN);
        $user->setPassword($this->userPasswordHasher->hashPassword(
            $user, 
            "123123"
            )
    );
        $manager->persist($user);

        $user = new User;
        $user->setEmail("admin2@admin.fr");
        $user->setNom("robin");
        $user->setPrenom("anne");
        $user->setPassword($this->userPasswordHasher->hashPassword(
             $user, 
             "147147"
             )
    );
        $manager->persist($user);
        $manager->flush();
    }
}
