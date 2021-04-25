<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordEncoderInterface $passwordEncoder)
    {}

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++){
            $user = new User();
            $user->setEmail("user+$i@mail.com");
            $user->setPassword($this->passwordEncoder->encodePassword($user,'password'));
            if ($i%2 == 0){
                $user->setIsVerified(true);
            }
            if ($i == 0){
                $user->setRoles(['ROLE_ADMIN']);
            }
            $manager->persist($user);
        }

        $manager->flush();
    }
}
