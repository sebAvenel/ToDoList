<?php

namespace App\Tests\Entity;

use App\Entity\Task;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testGetId()
    {
        $user = new User();
        $result = $user->getId();

        $this->assertSame(null, $result);
    }

    public function testSetUsernameLength()
    {
        $user = new User();
        $content = '';

        $this->expectException('LengthException');
        $user->setUsername($content);
    }

    public function testSetUsernameType()
    {
        $user = new User();
        $content = 2;

        $this->expectException('TypeError');
        $user->setUsername($content);
    }

    public function testGetUsername()
    {
        $user = new User();
        $user->setUsername('Name');
        $result = $user->getUsername();

        $this->assertSame('Name', $result);
    }

    public function testPassword()
    {
        $user = new User();
        $user->setPassword('password');
        $result = $user->getPassword();

        $this->assertSame('password', $result);
    }

    public function testEmail()
    {
        $user = new User();
        $email = 'email@email.fr';
        $user->setEmail($email);
        $result = $user->getEmail();

        $this->assertSame($email, $result);
    }

    public function testRole()
    {
        $user = new User();
        $role = ['ROLE_EXAMPLE'];
        $user->setRoles($role);
        $role[] = 'ROLE_USER';
        $result = $user->getRoles();

        $this->assertSame($role, $result);
    }

    public function testAddTask()
    {
        $user = new User();
        $task = new Task();
        $user->addTask($task);
        $result  = $user;

        $this->assertSame($user, $result);
    }

    public function testRemoveTask()
    {
        $user = new User();
        $task = new Task();
        $user->addTask($task);
        $user->removeTask($task);
        $result = $user;

        $this->assertSame($user, $result);
    }
}