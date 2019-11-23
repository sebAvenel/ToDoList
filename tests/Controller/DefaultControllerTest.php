<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultControllerTest extends WebTestCase
{
    public function testHomePage()
    {
        $request = Request::create('/', 'GET');
        $response = new Response();
        $response->prepare($request);

        $this->assertSame(200, $response->getStatusCode());
    }
}