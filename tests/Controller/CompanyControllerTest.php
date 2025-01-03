<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CompanyControllerTest extends WebTestCase
{
    public function testGetCompanyCollection(): void
    {
        $client = static::createClient([], ['HTTP_HOST' => '127.0.0.1:8000']);

        $client->jsonRequest('GET', '/api/companies/10/0');

        $content = $client->getResponse()->getContent();
        // here I check only is json is valid, normally we could test if count of elements equals expected
        // it will require additional db test base, for example app I use dev database assigned to this docker
        $this->assertJson($content);

        $this->assertResponseStatusCodeSame(200);
    }
}


