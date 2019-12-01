<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    /**
     * @var
     */
    private $httpClient;

    protected function setUp(): void
    {
        // Client HTTP
        $this->httpClient = static::createClient();
    }

    public function testLogin()
    {
        $this->httpClient->followRedirects();
        $crawler = $this->httpClient->request('GET', '/login');
        $form = $crawler->selectButton('Se connecter')->form();
        $form['_username'] = 'Utilisateur_Test';
        $form['_password'] = 'PasswordTest';
        $this->httpClient->submit($form);

        $this->assertEquals(200, $this->httpClient->getResponse()->getStatusCode());
    }

    public function testLogout()
    {
        $this->httpClient->followRedirects();
        $this->httpClient->request('GET', '/logout');

        $this->assertEquals(200, $this->httpClient->getResponse()->getStatusCode());
    }
}