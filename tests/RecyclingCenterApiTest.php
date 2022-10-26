<?php

namespace App\Tests;

use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class RecyclingCenterApiTest extends AbstractApi
{

    public function testIndexNotConnected(): void
    {
        $response = static::createClient()->request('GET', '/api/recycling_centers');

        $this->assertResponseStatusCodeSame(401);
    }


    /**
     * @throws TransportExceptionInterface
     */
    public function testIndexConnected(): void
    {
        $response = $this->getClient()->request('GET', '/api/recycling_centers');

        $this->assertResponseStatusCodeSame(200);
    }

    public function testPostNotConnected(): void
    {
        $response = static::createClient()->request('POST', '/api/recycling_centers/add', [
            'json' => [
                'name' => 'test',
                'latitude' => 0,
                'longitude' => 0,
                'comuneId' => [
                    '/api/communes/1'
                ],
                'businessHours' => 'secteurname',
            ]
        ]);

        $this->assertResponseStatusCodeSame(401);
    }

    public function testPostConnected(): void
    {
        $response = $this->getClient()->request('POST', '/api/recycling_centers/add', [
            'json' => [
                'name' => 'test',
                'latitude' => 0,
                'longitude' => 0,
                'comuneId' => [
                    '/api/communes/1'
                ],
                'businessHours' => 'secteurname',
            ]
        ]);

        $this->assertResponseStatusCodeSame(200);
    }

    public function testGetOnePostNotConnected(): void
    {
        $response = static::createClient()->request('GET', '/api/recycling_centers/1');

        $this->assertResponseStatusCodeSame(401);
    }

    public function testGetOnePostConnected(): void
    {
        $response = $this->getClient()->request('GET', '/api/recycling_centers/1');

        $this->assertResponseStatusCodeSame(200);
    }

    public function testPutNotConnected(): void
    {
        $response = static::createClient()->request('PUT', '/api/recycling_centers/1', [
            'json' => [
                'name' => 'test',
                'latitude' => 0,
                'longitude' => 0,
                'comuneId' => [
                    '/api/communes/1'
                ],
                'businessHours' => 'secteurname',
            ]
        ]);

        $this->assertResponseStatusCodeSame(401);
    }

    public function testPutConnected(): void
    {
        $response = $this->getClient()->request('PUT', '/api/recycling_centers/1', [
            'json' => [
                'name' => 'test',
                'latitude' => 0,
                'longitude' => 0,
                'comuneId' => [
                    '/api/communes/1'
                ],
                'businessHours' => 'secteurname',
            ]
        ]);

        $this->assertResponseStatusCodeSame(200);
    }

    public function testDeleteNotConnected(): void
    {
        $response = static::createClient()->request('DELETE', '/api/recycling_centers/1');

        $this->assertResponseStatusCodeSame(401);
    }

    public function testDeleteConnected(): void
    {
        $response = $this->getClient()->request('DELETE', '/api/recycling_centers/1');

        $this->assertResponseStatusCodeSame(200);
    }
}
