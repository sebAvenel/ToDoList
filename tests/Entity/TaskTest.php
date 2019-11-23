<?php

namespace App\Tests\Entity;

use App\Entity\Task;
use App\Entity\User;
use PHPUnit\Framework\TestCase;


class TaskTest extends TestCase
{
    public function testGetId()
    {
        $task = new Task();
        $result = $task->getId();

        $this->assertSame(null, $result);
    }

    public function testCreatedAt()
    {
        $task = new Task();
        $dateTime = new \DateTime();
        $task->setCreatedAt($dateTime);
        $result = $task->getCreatedAt();

        $this->assertSame($dateTime, $result);
    }

    public function testUser()
    {
        $task = new Task();
        $user = new User();
        $task->setUser($user);
        $result = $task->getUser();

        $this->assertSame($user, $result);
    }

    public function testSetTitle()
    {
        $task = new Task();
        $title = 2;

        $this->expectException('TypeError');
        $task->setTitle($title);
    }

    public function testGetTitle()
    {
        $task = new Task();
        $task->setTitle('Un titre');
        $result = $task->getTitle();

        $this->assertSame('Un titre', $result);
    }

    public function testSetContentLength()
    {
        $task = new Task();
        $content = '';

        $this->expectException('LengthException');
        $task->setContent($content);
    }

    public function testSetContentType()
    {
        $task = new Task();
        $content = 2;

        $this->expectException('TypeError');
        $task->setContent($content);
    }

    public function testGetContent()
    {
        $task = new Task();
        $task->setContent('Un texte');
        $result = $task->getContent();

        $this->assertSame('Un texte', $result);
    }

    public function testIsDoneType()
    {
        $task = new Task();
        $isDone = 2;

        $this->expectException('TypeError');
        $task->setIsDone($isDone);
    }

    public function testGetSetIsDone()
    {
        $task = new Task();
        $task->setIsDone(true);
        $result = $task->getIsDone();

        $this->assertSame(true, $result);
    }

    public function testIsDone()
    {
        $task = new Task();
        $task->setIsDone(true);
        $result = $task->isDone();

        $this->assertSame(true, $result);
    }

    public function testToogle()
    {
        $task = new Task();
        $flag = true;
        $task->toggle($flag);
        $result = $task->isDone();

        $this->assertSame($flag, $result);
    }
}