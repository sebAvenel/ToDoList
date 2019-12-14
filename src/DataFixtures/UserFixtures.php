<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        $user = new User();
        $user->setUsername("anonyme");
        $user->setRoles(['ROLE_ADMIN']);
        $user->setEmail($faker->email);
        $password = $this->passwordEncoder->encodePassword($user, $faker->password);
        $user->setPassword($password);
        $manager->persist($user);

        $user = new User();
        $user->setUsername("Utilisateur_Test");
        $user->setRoles(['ROLE_ADMIN']);
        $user->setEmail($faker->email);
        $password = $this->passwordEncoder->encodePassword($user, 'PasswordTest');
        $user->setPassword($password);
        $manager->persist($user);

        $user = new User();
        $user->setUsername("Utilisateur_Test2");
        $user->setRoles(['ROLE_ADMIN']);
        $user->setEmail($faker->email);
        $password = $this->passwordEncoder->encodePassword($user, 'PasswordTest2');
        $user->setPassword($password);
        $manager->persist($user);

        $user = new User();
        $user->setUsername("Utilisateur_Test3");
        $user->setRoles(['ROLE_USER']);
        $user->setEmail($faker->email);
        $password = $this->passwordEncoder->encodePassword($user, 'PasswordTest3');
        $user->setPassword($password);
        $manager->persist($user);

        $manager->flush();
    }
}
