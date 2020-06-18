<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Utilisateurs;
use App\Entity\Test;

class ADTFixtures extends Fixture
{
     private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }
 
    public function load(ObjectManager $manager)
    {
         // création d'utilisateurs
         $user = new Utilisateurs;
		 $user->setUsername("csc");
		  $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'rascol'         ));
         $roles[] = 'ROLE_USER';         
        // $user->setRoles($roles) ;
         $admin=new Utilisateurs;
		 $user->setUsername("admisn");
		  $user->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'admin'         ));
         $roles[] = 'ROLE_ADMIN';         
        // $admin->setRoles($roles) ;
         $manager->persist($admin);
         
         // création de 2 tests
         $test= new Test();
         $test->setEtat("encours");
         $test->setNom("Palpeur Topologique");
         $manager->persist($test);
         $test2= new Test();
         $test2->setEtat("encours");
         $test2->setNom("Barrière immatérielle et enceinte");
         $manager->persist($test2);
        $manager->flush();
    }
}
