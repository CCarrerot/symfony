<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\Utilisateur;
use App\Entity\Test;

class AppFixtures extends Fixture
{
	  private $passwordHasher;

     public function __construct(UserPasswordHasherInterface $passwordHasher)
     {
         $this->passwordHasher = $passwordHasher;
     }

    public function load(ObjectManager $manager)
    {
		
		 // création d'utilisateurs
         $user = new Utilisateur;
		 $user->setEmail("cc@cc.fr");
		 $user->setPassword($this->passwordHasher->hashPassword(
            $user,
            'rascol'         ));
         $roles[] = 'ROLE_USER';         
         $user->setRoles($roles)->setNom("cc") ;
         $manager->persist($user);
         $admin=new Utilisateur;
		 $admin->setEmail("admin@admin.fr");
		  $admin->setPassword($this->passwordHasher->hashPassword(
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
