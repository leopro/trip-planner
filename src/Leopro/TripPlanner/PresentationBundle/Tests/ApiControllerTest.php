<?php

namespace Leopro\TripPlanner\PresentationBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpKernel\Client;

class ApiControllerTest extends WebTestCase
{
    public function testCreateTrip()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $form = $crawler->filter('#trip_save')->form();
        $client->submit(
            $form,
            array(

            )
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('This value should not be blank', $client->getCrawler()->filter('body')->text());

        $form = $crawler->filter('#trip_save')->form();
        $client->submit(
            $form,
            array(
                'trip[name]' => 'my new wonderful trip'
            )
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('ok', $client->getCrawler()->filter('body')->text());
    }
} 