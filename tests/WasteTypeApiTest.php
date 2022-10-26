<?php

namespace App\Tests;

use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class WasteTypeApiTest extends AbstractApi
{

    public function testIndexNotConnected(): void
    {
        $response = static::createClient()->request('GET', '/api/waste_types');

        $this->assertResponseStatusCodeSame(401);
    }


    /**
     * @throws TransportExceptionInterface
     */
    public function testIndexConnected(): void
    {
        $response = $this->getClient()->request('GET', '/api/waste_types');

        $this->assertResponseStatusCodeSame(200);
    }

    public function testPostNotConnected(): void
    {
        $response = static::createClient()->request('POST', '/api/waste_types/add', [
            'json' => [
                'designation' => 'test',
                'density' => 0,
                'customerDesignation' => 'test',
            ]
        ]);

        $this->assertResponseStatusCodeSame(401);
    }

    public function testPostConnected(): void
    {
        $response = $this->getClient()->request('POST', '/api/waste_types/add', [
            'json' => [
                'designation' => 'test',
                'density' => 0,
                'customerDesignation' => 'test',
            ]
        ]);

        $this->assertResponseStatusCodeSame(200);
    }

    public function testGetOnePostNotConnected(): void
    {
        $response = static::createClient()->request('GET', '/api/waste_types/1');

        $this->assertResponseStatusCodeSame(401);
    }

    public function testGetOnePostConnected(): void
    {
        $response = $this->getClient()->request('GET', '/api/waste_types/1');

        $this->assertResponseStatusCodeSame(200);
    }

    public function testPutNotConnected(): void
    {
        $response = static::createClient()->request('PUT', '/api/waste_types/1', [
            'json' => [
                'designation' => 'test',
                'density' => 0,
                'customerDesignation' => 'test',
            ]
        ]);

        $this->assertResponseStatusCodeSame(401);
    }

    public function testPutConnected(): void
    {
        $response = $this->getClient()->request('PUT', '/api/waste_types/1', [
            'json' => [
                'designation' => 'test',
                'density' => 0,
                'customerDesignation' => 'test',
            ]
        ]);

        $this->assertResponseStatusCodeSame(200);
    }

    public function testDeleteNotConnected(): void
    {
        $response = static::createClient()->request('DELETE', '/api/waste_types/1');

        $this->assertResponseStatusCodeSame(401);
    }

    public function testDeleteConnected(): void
    {
        $response = $this->getClient()->request('DELETE', '/api/waste_types/1');

        $this->assertResponseStatusCodeSame(200);
    }
}
