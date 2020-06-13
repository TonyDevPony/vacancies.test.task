<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
      $this->encoder = $encoder;
    }

  public function load(ObjectManager $manager)
    {
        $user = new User();

        $user->setEmail('kirildemchenko07@gmail.com');
        $user->setPassword(
          $this->encoder->encodePassword($user, 'kiril')
        );

        $manager->persist($user);
        $manager->flush();

        $user = new User();

        $user->setEmail('admin@gmail.com');
        $user->setPassword(
          $this->encoder->encodePassword($user, 'admin')
        );

        $manager->persist($user);
        $manager->flush();
    }
}
