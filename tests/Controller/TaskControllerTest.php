<?php

namespace App\Tests\Controller;

use App\Entity\Task;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var
     */
    private $httpClientConnected;
    /**
     * @var
     */
    private $httpClientConnected2;

    protected function setUp(): void
    {
        // Entity manager
        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();

        // Client HTTP
        $this->httpClientConnected = static::createClient([], [
            'PHP_AUTH_USER' => 'Utilisateur_Test',
            'PHP_AUTH_PW'   => 'PasswordTest',
        ]);

        // Client HTTP 2
        $this->httpClientConnected2 = static::createClient([], [
            'PHP_AUTH_USER' => 'Utilisateur_Test2',
            'PHP_AUTH_PW'   => 'PasswordTest2',
        ]);
    }

    public function testListAction()
    {
        $this->httpClientConnected->followRedirects();
        $this->httpClientConnected->request('GET', '/tasks');

        $this->assertSame(200, $this->httpClientConnected->getResponse()->getStatusCode());
    }

    public function testCreateAction()
    {
        $this->httpClientConnected->followRedirects();
        $crawler = $this->httpClientConnected->request('GET', '/tasks/create');
        $form = $crawler->selectButton('Ajouter')->form();
        $form['task[title]'] = 'Tâche 1000';
        $form['task[content]'] = 'Contenu de la tâche 1000';
        $crawler = $this->httpClientConnected->submit($form);

        $this->assertEquals(200, $this->httpClientConnected->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('html:contains("Superbe ! La tâche a été bien été ajoutée.")')->count());
        $this->assertSame(1, $crawler->filter('div.alert.alert-success')->count());
    }

    public function testEditAction()
    {
        $this->httpClientConnected->followRedirects();
        $task = $this->entityManager->getRepository(Task::class)->findFirstElement();
        $crawler = $this->httpClientConnected->request('GET', '/tasks/'. $task[0]->getId() . '/edit');
        $form = $crawler->selectButton('Modifier')->form();
        $form['task[title]'] = 'Tache 1001';
        $form['task[content]'] = 'Contenu de la tâche 1001';
        $crawler = $this->httpClientConnected->submit($form);

        $this->assertEquals(200, $this->httpClientConnected->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('div.alert.alert-success')->count());
        $this->assertSame(1, $crawler->filter('html:contains("Superbe ! La tâche a bien été modifiée.")')->count());
    }

    public function testToggleTaskAction()
    {
        $this->httpClientConnected->followRedirects();
        $task = $this->entityManager->getRepository(Task::class)->findFirstElement();
        $crawler = $this->httpClientConnected->request('GET', '/tasks/'. $task[0]->getId()  . '/toggle');

        $this->assertEquals(200, $this->httpClientConnected->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('div.alert.alert-success')->count());
    }

    public function testDeleteTaskActionConnectedUser()
    {
        $this->httpClientConnected->followRedirects();
        $task = $this->entityManager->getRepository(Task::class)->findFirstElement();
        $crawler = $this->httpClientConnected->request('GET', '/tasks/'. $task[0]->getId() . '/delete');

        $this->assertEquals(200, $this->httpClientConnected->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('html:contains("Superbe ! La tâche a bien été supprimée.")')->count());
    }

    public function testDeleteTaskActionConnectedUser2()
    {
        $this->httpClientConnected2->followRedirects();
        $task = $this->entityManager->getRepository(Task::class)->findFirstElement();
        $crawler = $this->httpClientConnected2->request('GET', '/tasks/'. $task[0]->getId() . '/delete');

        $this->assertEquals(200, $this->httpClientConnected2->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('html:contains("Oops ! Vous n\'êtes pas à l\'origine de cettte tâche, vous ne pouvez pas la supprimer.")')->count());
    }
}