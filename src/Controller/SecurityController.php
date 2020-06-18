<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Utilisateurs;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Doctrine\ORM\EntityManagerInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }
    
     /**
     * @Route("/register", name="app_register")
     */
   public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder,EntityManagerInterface $manager): Response
    {
 
        if ($request->isMethod('POST')) 
        {
            $user = new Utilisateurs();
            $user->setEmail($request->request->get('email'));
            $user->setNom($request->request->get('nomComplet'));
             $user->setPrenom($request->request->get('prenom'));
            $user->setUsername($request->request->get('username'));
            $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));
            if ($request->request->get('role')==="ROLE_ADMIN")
                $roles[] = 'ROLE_ADMIN';
            else
                $roles[] = 'ROLE_USER';
                
                
            $user->setRoles($roles);
            $manager->persist($user);
            $manager->flush();
            //return $this->redirectToRoute("liste");
            return $this->render('security/register.html.twig',['user' => $user] );
        }
        return $this->render('security/register.html.twig',['user' => null]);
    }
    
    
     /**
      * Affichahge de la liste des utilisateurs (menu admin)
     * @Route("/listeUsers", name="app_listeUsers")
      *@IsGranted("ROLE_ADMIN")
      * 
     */
   public function listeUsers(): Response
    {
        // récupération du répository associé à la classe (généré automatiquement avec les entities)
        $repository = $this->getDoctrine()->getRepository(Utilisateurs::class);
        // récupération de tous les utilisateurs
        $allUsers = $repository->findAll();

       return $this->render('security/listeUsers.html.twig', ["allUsers"=> $allUsers,]);
    } 
    

    /**
     * @Route("/logout", name="app_logout", methods={"GET"})
     */
    public function logout()
    {
        // controller can be blank: it will never be executed!
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
    
}
