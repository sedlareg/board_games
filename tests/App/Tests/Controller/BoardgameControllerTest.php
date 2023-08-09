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

    public function testCommentSubmission()
    {
        $client = static::createClient();
        $client->request('GET', '/boardgame/blood-rage-2015');
        $client->submitForm('Submit', [
            'comment[author]' => 'Geraldes',
            'comment[text]' => 'Some feedback from an automated functional test',
            'comment[email]' => 'robot_me@automat.ed',
            'comment[rating]' => 5,
            'comment[photo]' => dirname(__DIR__, 2).'/public/images/under-construction.gif',
        ]);
        $this->assertResponseRedirects();
        $client->followRedirect();
        $this->assertSelectorExists('div:contains("There are 2 comments")');
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
