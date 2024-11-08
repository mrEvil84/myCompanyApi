<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\HttpClientAssertionsTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CompanyControllerTest extends WebTestCase
{
    use HttpClientAssertionsTrait;
    public function testSomething(): void
    {
        $client = static::createClient([], ['HTTP_HOST' => '127.0.0.1:8000']);

        // Request a specific page

        $crawler = $client->jsonRequest('GET', '/api/companies/10/0');

        $this->assertJson($client->getResponse()->getContent());

        // Validate a successful response and some content

//        $this->assertSelectorTextContains('h1', 'Hello World');
//        $response = static::createClient()->request('GET', '/');
//
//        $this->assertResponseIsSuccessful();
//        $this->assertJsonContains(['@id' => '/']);
    }
}
