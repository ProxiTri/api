<?php

namespace App\Tests;

use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class CommuneApiTest extends AbstractApi
{

    public function testIndexNotConnected(): void
    {
        $response = static::createClient()->request('GET', '/api/communes');

        $this->assertResponseStatusCodeSame(401);
    }


    /**
     * @throws TransportExceptionInterface
     */
    public function testIndexConnected(): void
    {
        $response = $this->getClient()->request('GET', '/api/communes');

        $this->assertResponseStatusCodeSame(200);
    }

    public function testPostNotConnected(): void
    {
        $response = static::createClient()->request('POST', '/api/communes/add', [
            'json' => [
                'message' => 'test',
                'userId' => [
                    '/api/users/1'
                ],
                'isReport' => true,
            ]
        ]);

        $this->assertResponseStatusCodeSame(401);
    }

    public function testPostConnected(): void
    {
        $response = $this->getClient()->request('POST', '/api/communes/add', [
            'json' => [
                'message' => 'test',
                'userId' => [
                    '/api/users/1'
                ],
                'isReport' => true,
            ]
        ]);

        $this->assertResponseStatusCodeSame(200);
    }

    public function testGetOnePostNotConnected(): void
    {
        $response = static::createClient()->request('GET', '/api/communes/1');

        $this->assertResponseStatusCodeSame(401);
    }

    public function testGetOnePostConnected(): void
    {
        $response = $this->getClient()->request('GET', '/api/communes/1');

        $this->assertResponseStatusCodeSame(200);
    }

    public function testPutNotConnected(): void
    {
        $response = static::createClient()->request('PUT', '/api/communes/1', [
            'json' => [
                'message' => 'test',
                'userId' => [
                    '/api/users/1'
                ],
                'isReport' => true,
            ]
        ]);

        $this->assertResponseStatusCodeSame(401);
    }

    public function testPutConnected(): void
    {
        $response = $this->getClient()->request('PUT', '/api/communes/1', [
            'json' => [
                'message' => 'test',
                'userId' => [
                    '/api/users/1'
                ],
                'isReport' => true,
            ]
        ]);

        $this->assertResponseStatusCodeSame(200);
    }

    public function testDeleteNotConnected(): void
    {
        $response = static::createClient()->request('DELETE', '/api/communes/1');

        $this->assertResponseStatusCodeSame(401);
    }

    public function testDeleteConnected(): void
    {
        $response = $this->getClient()->request('DELETE', '/api/communes/1');

        $this->assertResponseStatusCodeSame(200);
    }
}
