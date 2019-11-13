<?php


namespace App\DataFixtures;


use App\Entity\Location;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LocationFixture extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $location = new Location();
        $location->setAddress('3 Rue des Osthéopathes')
            ->setPostalCode('49000')
            ->setCity('Angers')
            ->setPhone('0202020202')
            ->setMail('mon.cabinet@gmail.com')
            ->setIsActive(true);

        $manager->persist($location);
        $manager->flush();
    }

}