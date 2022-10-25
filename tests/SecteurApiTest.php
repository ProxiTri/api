<?php

namespace App\Tests;

use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class SecteurApiTest extends AbstractApi
{

    public function testIndexNotConnected(): void
    {
        $response = static::createClient()->request('GET', '/api/secteurs');

        $this->assertResponseStatusCodeSame(401);
    }


    /**
     * @throws TransportExceptionInterface
     */
    public function testIndexConnected(): void
    {
        $response = $this->getClient()->request('GET', '/api/secteurs');

        $this->assertResponseStatusCodeSame(200);
    }

    public function testPostNotConnected(): void
    {
        $response = static::createClient()->request('POST', '/api/secteurs/add', [
            'json' => [
                'name' => 'test',
                'passages' => [
                    '/api/passages/1'
                ],
                'comuneId' => [
                    '/api/communes/1'
                ],
            ]
        ]);

        $this->assertResponseStatusCodeSame(401);
    }

    public function testPostConnected(): void
    {
        $response = $this->getClient()->request('POST', '/api/secteurs/add', [
            'json' => [
                'name' => 'test',
                'passages' => [
                    '/api/passages/1'
                ],
                'comuneId' => [
                    '/api/communes/1'
                ],
            ]
        ]);

        $this->assertResponseStatusCodeSame(200);
    }

    public function testGetOnePostNotConnected(): void
    {
        $response = static::createClient()->request('GET', '/api/secteurs/1');

        $this->assertResponseStatusCodeSame(401);
    }

    public function testGetOnePostConnected(): void
    {
        $response = $this->getClient()->request('GET', '/api/secteurs/1');

        $this->assertResponseStatusCodeSame(200);
    }

    public function testPutNotConnected(): void
    {
        $response = static::createClient()->request('PUT', '/api/secteurs/1', [
            'json' => [
                'name' => 'test',
                'passages' => [
                    '/api/passages/1'
                ],
                'comuneId' => [
                    '/api/communes/1'
                ],
            ]
        ]);

        $this->assertResponseStatusCodeSame(401);
    }

    public function testPutConnected(): void
    {
        $response = $this->getClient()->request('PUT', '/api/secteurs/1', [
            'json' => [
                'name' => 'test',
                'passages' => [
                    '/api/passages/1'
                ],
                'comuneId' => [
                    '/api/communes/1'
                ],
            ]
        ]);

        $this->assertResponseStatusCodeSame(200);
    }

    public function testDeleteNotConnected(): void
    {
        $response = static::createClient()->request('DELETE', '/api/secteurs/1');

        $this->assertResponseStatusCodeSame(401);
    }

    public function testDeleteConnected(): void
    {
        $response = $this->getClient()->request('DELETE', '/api/secteurs/1');

        $this->assertResponseStatusCodeSame(200);
    }
}
