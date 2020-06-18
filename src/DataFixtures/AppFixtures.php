<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
                // création d'utilisateurs
         $user = new Utilisateurs;
		 $user->setUsername("cc");
		  $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'rascol'         ));
         $roles[] = 'ROLE_USER';         
         $user->setRoles($roles) ;
         $user->setEmail("cc") ;
         $admin=new Utilisateurs;
		 $user->setUsername("admin");
		  $user->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'admin'         ));
         $roles[] = 'ROLE_ADMIN';
        $user->setEmail("admin") ;         
         $admin->setRoles($roles) ;
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
