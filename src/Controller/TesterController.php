<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Test;
/**
 * Description of TesterController
 * Controleur pour gérer les pages en lien avec les testeurs
 * @author Carrerot
 */
class TesterController extends AbstractController
{
    /**
     * fourni la liste des tests à effectuer
     * @Route("/tester/liste", name="liste")
     * @IsGranted("ROLE_USER")
     */
    public function liste(EntityManagerInterface  $manager)
    {
        // récupération de la date courante
        $today = date(" d/m/Y à H:m:s");
        // génère une page html
        //return new Response("<html><body>Liste des Tests à effectuer le".$today."</body></html>");
        
        
        // récupération de tous les tests de la bdd
        $tests=$manager->getRepository(Test::class)->findAll();
    //utilise le template present dans template/tester/liste.html.twig
        return $this->render("tester/liste.html.twig", ["dateDuJour" => $today,"tests"=>$tests]);
    }
     
   /**
    * affiche les détails du test
    * @Route("/tester/test/{id}", name="affiche_test",requirements={"numero"="\d+"})
    * @IsGranted("ROLE_USER")
 */
    public function test(Test $id)
    {
        return $this->render("tester/test.html.twig", ["test" => $id]);
    }
    
    
    /**
     * Création d'un test
     * @Route("/tester/new", name="creer_test")
     * @IsGranted("ROLE_USER")
     */
     public function creer_test(Request $request,ObjectManager $manager)
     {
         if($request->getMethod()=="POST")
         {
            $test=new Test();
            $test->setNom($request->query->get("Nom"));
            $test->setEtat($request->query->get("etat"));
            $manager->persist($test);
            $manager->flush();
            return $this->render("tester/creer_test.html.twig",["save"=>"réussi"]);
         }
          else  
            return $this->render("tester/creer_test.html.twig");
     }
}















