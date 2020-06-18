<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Crawler;
/**
 * Description of TesterControllerTest
 *
 * @author Christophe Carrérot
 */
class TesterControllerTest extends WebTestCase
{
    
    /**
     * test de /tester/liste qui redirige vers login car l'on n'est pas authentifié
     */
    public function testListeNonAuthentified()
    {
        //il faut être admin
        $client = static::createClient();
        $client->request('GET', '/tester/liste');
         $this->assertTrue($client->getResponse()->isRedirect('/login'));
    }
    
    /**
     * test de /tester/liste qui affiche la page car l'on est bien authentifié
     */
    public function testListeAuthentified()
    {
        /*Authentification simplifiée car un fichier /config/packages/tests/security.yaml 
        a été créé. Il contiendra
        security:
            firewalls:
            # replace 'main' by the name of your own firewall
                main:
                    http_basic: ~
         */
       $client = static::createClient([], [
                    'PHP_AUTH_USER' => 'cc',
                    'PHP_AUTH_PW'   => 'cc',
                ]);
        $client->request('GET', '/tester/liste');
       
        // vérifie que la page s'affiche correctement (code OK 200)
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    
     /**
     * Test authentification
     */
    public function testLogin()
    {
         $client = static::createClient();
        $crawler=$client->request('GET', '/login');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
       //authentification en remplissant le formulaire de login
       $form = $crawler->selectButton('Se connecter')->form();

       // set some values
       $values = $form->getValues();
        $form['username'] = 'cc';
         $form['password'] = 'cc';
       // $form['_csrf_token']=$values['_csrf_token'];
        // submit the form
        $crawler = $client->submit($form);
        $this->assertTrue($client->getResponse()->isRedirect('/tester/liste'));
       // $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}