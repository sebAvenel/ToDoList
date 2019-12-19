<?php

namespace App\Tests\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var
     */
    private $httpClient;

    protected function setUp(): void
    {
        // Entity manager
        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();

        // Client HTTP
        $this->httpClient = static::createClient([], [
            'PHP_AUTH_USER' => 'Utilisateur_Test',
            'PHP_AUTH_PW'   => 'PasswordTest',
        ]);
    }

    public function testListAction()
    {
        $this->httpClient->followRedirects();
        $this->httpClient->request('GET', '/users/list');

        $this->assertSame(200, $this->httpClient->getResponse()->getStatusCode());
    }

    public function testCreateAction()
    {
        $faker = Factory::create();
        $this->httpClient->followRedirects();
        $crawler = $this->httpClient->request('GET', '/users/create');
        $form = $crawler->selectButton('Ajouter')->form();
        $form['user[username]'] = $faker->firstName;
        $password = $faker->password;
        $form['user[password][first]'] = $password;
        $form['user[password][second]'] = $password;
        $form['user[roles]'] = 'ROLE_ADMIN';
        $form['user[email]'] = $faker->email;
        $crawler = $this->httpClient->submit($form);

        $this->assertEquals(200, $this->httpClient->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('div.alert.alert-success')->count());
    }

    public function testEditAction()
    {
        $faker = Factory::create();
        $this->httpClient->followRedirects();
        $user = $this->entityManager->getRepository(User::class)->findLastElement();
        $crawler = $this->httpClient->request('GET', '/users/edit/'. $user[0]->getId() . '/user_admin');
        $form = $crawler->selectButton('Modifier')->form();
        $form['user[username]'] = $faker->firstName;
        $form['user[roles]'] = 'ROLE_USER';
        $password = $faker->password;
        $form['user[password][first]'] = $password;
        $form['user[password][second]'] = $password;
        $crawler = $this->httpClient->submit($form);

        $this->assertEquals(200, $this->httpClient->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('div.alert.alert-success')->count());
        $this->assertGreaterThan(0, $crawler->filter('div:contains("utilisateur a bien été modifié")')->count());
    }


}