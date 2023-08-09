<?php

namespace App\Tests;

use Symfony\Component\Panther\PantherTestCase;

class BoardgamePantherTest extends PantherTestCase
{
    public function testIndex()
    {
        $_SERVER['SYMFONY_PROJECT_DEFAULT_ROUTE_URL'] = 'http://127.0.0.1:36473/';

        $client = static::createPantherClient(['external_base_uri' => rtrim($_SERVER['SYMFONY_PROJECT_DEFAULT_ROUTE_URL'], '/')]);
        $client->request('GET', '/');

        //$this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Give your feedback!');
    }
}
