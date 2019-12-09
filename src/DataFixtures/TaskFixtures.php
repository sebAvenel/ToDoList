<?php

namespace App\DataFixtures;

use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class TaskFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        $booleans = [true, false];

        for ($i = 1; $i <= 10; $i++){
            $task = new Task();
            $task->setIsDone($booleans[rand(0, 1)]);
            $task->setCreatedAt(new \DateTime());
            $task->setTitle('Tâche' . $i);
            $task->setContent($faker->text);

            $manager->persist($task);
        }

        $manager->flush();
    }
}
