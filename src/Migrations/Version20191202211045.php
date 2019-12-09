<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\Task;
use App\Entity\User;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191202211045 extends AbstractMigration implements ContainerAwareInterface
{
    public function getDescription() : string
    {
        return 'Migration file to change a task with null user to \'anonyme\' user';
    }

    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function up(Schema $schema) : void
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $anonymousUser = $em->getRepository(User::class)->findOneBy(['username' => 'anonyme']);

        $anonymousUser->getUsername();

        $anonymousTasks = $em->getRepository(Task::class)->findBy(['user' => null]);

        /** @var Task $task */
        foreach ($anonymousTasks as $task) {
            $task->setUser($anonymousUser);
        }

        $em->flush();
    }

    public function down(Schema $schema) : void
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $anonymousUser = $em->getRepository(User::class)->findOneBy(['username' => 'anonyme']);
        $anonymousTasks = $em->getRepository(Task::class)->findBy(['user' => $anonymousUser]);

        /** @var Task $task */
        foreach ($anonymousTasks as $task) {
            $task->setUser(null);
        }

        $em->flush();
    }
}
