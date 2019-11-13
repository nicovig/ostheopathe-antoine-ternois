<?php


namespace App\DataFixtures;


use App\Entity\Practitioner;
use App\Entity\Rights;
use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminRoleRightsFixtures extends Fixture
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $practitioner = new Practitioner();
        $practitioner->setIsLeader(true);
        $manager->persist($practitioner);

        $role = new Role();
        $role->setPractitioner($practitioner);
        $manager->persist($role);

        $right = new Rights();
        $right->setRole($role)
                ->setCanUpdateAppointment(true)
                ->setCanUpdateLocation(true)
                ->setCanUpdatePatient(true)
                ->setCanUpdatePractitioner(true)
                ->setCanUpdatePrescription(true)
                ->setCanUpdateSecretary(true)
                ->setCanUpdateSession(true)
                ->setCanSeeLocation(true)
                ->setCanSeePractitioner(true)
                ->setCanSeeSecretary(true)
                ->setCanSeeSession(true)
                ->setCanUpdateHisAppointment(true)
                ->setCanUpdateHisPatient(true)
                ->setCanSeeHisPrescription(true);
        $manager->persist($right);

        $user = new User();
        $user->setRole($role)
            ->setLastName('Super')
            ->setFirstName('Admin')
            ->setPhone('0606060606')
            ->setMail('super.admin@gmail.com')
            ->setIsActive(true)
            ->setUsername('super.admin@gmail.com')
            ->setPassword($this->encoder->encodePassword($user, 'password'));
        $manager->persist($user);


        $manager->flush();

    }
}