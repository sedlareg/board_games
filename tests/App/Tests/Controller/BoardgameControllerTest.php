<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BoardgameControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Give your feedback');
    }

    public function testBoardgamePage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertCount(3, $crawler->filter('h4'));

        $client->clickLink('Rate');

        $this->assertPageTitleContains('Blood Rage');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Blood Rage 2015');
        $this->assertSelectorExists('div:contains("There are 1 comments")');
    }
}
