<?php


namespace App\Helpers;


use App\Entity\Role;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AccountStatusException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class AppHelpers implements UserCheckerInterface
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    }
/*########################################################################*/

    /**
     * Checks the user account before authentication.
     *
     * @throws AccountStatusException
     */
    public function checkPreAuth(UserInterface $user){

    }

    /**
     * Checks the user account after authentication.
     *
     * @throws AccountStatusException
     */
    public function checkPostAuth(UserInterface $user){

    }

    /*
     * Param : a UserData from form (User form embbed in fom)
     * Return : proper User Object, with encoded password & good username (mail)
     * Uses : Account Controller
     *
     * */
    public function properUserObject(User $userData, Role $role){
        $properUser = new User();
        $properUser->setRole($role);
        $properUser->setLastName($userData->getLastName());
        $properUser->setFirstName($userData->getFirstName());
        $properUser->setPhone($userData->getPhone());
        $properUser->setMail($userData->getMail());
        $properUser->setUsername($userData->getMail());
        $properUser->setPassword($this->encoder->encodePassword($userData, $userData->getPassword()));
        return $properUser;
    }

    /*
     * Return : new DateTimeObject with actual date
     * Uses : AccountController
     *
     * */
    public function now(){
        $date = new \DateTime();
        return $date;
    }

}