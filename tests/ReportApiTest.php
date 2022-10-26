<?php

namespace App\Tests;

use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class ReportApiTest extends AbstractApi
{

    public function testIndexNotConnected(): void
    {
        $response = static::createClient()->request('GET', '/api/reports');

        $this->assertResponseStatusCodeSame(401);
    }


    /**
     * @throws TransportExceptionInterface
     */
    public function testIndexConnected(): void
    {
        $response = $this->getClient()->request('GET', '/api/reports');

        $this->assertResponseStatusCodeSame(200);
    }

    public function testPostNotConnected(): void
    {
        $response = static::createClient()->request('POST', '/api/reports/add', [
            'json' => [
                'localisationName' => 'test',
                'localisationNumber' => 'test',
                'localisationLongitude' => 'test',
                'localisationLatitude' => 'test',
                'message' => 'test',
                'image' => 'test',
                'userId' => [
                    '/api/users/1'
                ],
            ]
        ]);

        $this->assertResponseStatusCodeSame(401);
    }

    public function testPostConnected(): void
    {
        $response = $this->getClient()->request('POST', '/api/reports/add', [
            'json' => [
                'localisationName' => 'test',
                'localisationNumber' => 'test',
                'localisationLongitude' => 'test',
                'localisationLatitude' => 'test',
                'message' => 'test',
                'image' => 'test',
                'userId' => [
                    '/api/users/1'
                ],
            ]
        ]);

        $this->assertResponseStatusCodeSame(200);
    }

    public function testGetOnePostNotConnected(): void
    {
        $response = static::createClient()->request('GET', '/api/reports/1');

        $this->assertResponseStatusCodeSame(401);
    }

    public function testGetOnePostConnected(): void
    {
        $response = $this->getClient()->request('GET', '/api/reports/1');

        $this->assertResponseStatusCodeSame(200);
    }

    public function testPutNotConnected(): void
    {
        $response = static::createClient()->request('PUT', '/api/reports/1', [
            'json' => [
                'localisationName' => 'test',
                'localisationNumber' => 'test',
                'localisationLongitude' => 'test',
                'localisationLatitude' => 'test',
                'message' => 'test',
                'image' => 'test',
                'userId' => [
                    '/api/users/1'
                ],
            ]
        ]);

        $this->assertResponseStatusCodeSame(401);
    }

    public function testPutConnected(): void
    {
        $response = $this->getClient()->request('PUT', '/api/reports/1', [
            'json' => [
                'localisationName' => 'test',
                'localisationNumber' => 'test',
                'localisationLongitude' => 'test',
                'localisationLatitude' => 'test',
                'message' => 'test',
                'image' => 'test',
                'userId' => [
                    '/api/users/1'
                ],
            ]
        ]);

        $this->assertResponseStatusCodeSame(200);
    }

    public function testDeleteNotConnected(): void
    {
        $response = static::createClient()->request('DELETE', '/api/reports/1');

        $this->assertResponseStatusCodeSame(401);
    }

    public function testDeleteConnected(): void
    {
        $response = $this->getClient()->request('DELETE', '/api/reports/1');

        $this->assertResponseStatusCodeSame(200);
    }
}
