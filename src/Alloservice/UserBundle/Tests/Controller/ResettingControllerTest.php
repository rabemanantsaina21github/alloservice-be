<?php

namespace Alloservice\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ResettingControllerTest extends WebTestCase
{
    public function testRequest()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/request');
    }

}
