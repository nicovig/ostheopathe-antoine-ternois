<?php


namespace App\DataFixtures;


use App\Entity\Session;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SessionFixture extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $averageDuration = new \DateTime();
        $averageDuration->setTime(0, 40);

        $session = new Session();
        $session->setType("Séance d'osthéopathie")
            ->setDescription('Une séance d\'osthéopathie')
            ->setAverageDuration($averageDuration)
            ->setIsActive(true);

        $manager->persist($session);
        $manager->flush();
    }

}