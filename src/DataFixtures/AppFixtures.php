<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Utilisateur;
use App\Entity\Test;

class AppFixtures extends Fixture
{
     private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }
 
    public function load(ObjectManager $manager)
    {
         // création d'utilisateurs
         $user = new Utilisateur;
		 $user->setEmail("cc@cc.fr");
		  $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'rascol'         ));
         $roles[] = 'ROLE_USER';         
         $user->setRoles($roles)->setNom("cc") ;
         $manager->persist($user);
         $admin=new Utilisateur;
		 $admin->setEmail("admin@admin.fr");
		  $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'admin'         ));
         $roles[] = 'ROLE_ADMIN';         
         $admin->setRoles($roles)->setNom("admin") ;
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
