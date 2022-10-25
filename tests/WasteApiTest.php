<?php

namespace App\Tests;

use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class WasteApiTest extends AbstractApi
{

    public function testIndexNotConnected(): void
    {
        $response = static::createClient()->request('GET', '/api/wastes');

        $this->assertResponseStatusCodeSame(401);
    }


    /**
     * @throws TransportExceptionInterface
     */
    public function testIndexConnected(): void
    {
        $response = $this->getClient()->request('GET', '/api/wastes');

        $this->assertResponseStatusCodeSame(200);
    }

    public function testPostNotConnected(): void
    {
        $response = static::createClient()->request('POST', '/api/wastes/add', [
            'json' => [
                'name' => 'test',
                'serialNumber' => 'test',
                'wasteType' => [
                    '/api/waste_types/1'
                ],
                'wasteContainerModel' => [
                    '/api/waste_container_models/1'
                ],
                'installFirstDate' => new \DateTimeImmutable(),
                'installNewDate' => new \DateTimeImmutable(),
                'localisationCityId' => 'test'
            ]
        ]);

        $this->assertResponseStatusCodeSame(401);
    }

    public function testPostConnected(): void
    {
        $response = $this->getClient()->request('POST', '/api/wastes/add', [
            'json' => [
                'name' => 'test',
                'serialNumber' => 'test',
                'wasteType' => [
                    '/api/waste_types/1'
                ],
                'wasteContainerModel' => [
                    '/api/waste_container_models/1'
                ],
                'installFirstDate' => new \DateTimeImmutable(),
                'installNewDate' => new \DateTimeImmutable(),
                'localisationCityId' => 'test'
            ]
        ]);

        $this->assertResponseStatusCodeSame(200);
    }

    public function testGetOnePostNotConnected(): void
    {
        $response = static::createClient()->request('GET', '/api/wastes/1');

        $this->assertResponseStatusCodeSame(401);
    }

    public function testGetOnePostConnected(): void
    {
        $response = $this->getClient()->request('GET', '/api/wastes/1');

        $this->assertResponseStatusCodeSame(200);
    }

    public function testPutNotConnected(): void
    {
        $response = static::createClient()->request('PUT', '/api/wastes/1', [
            'json' => [
                'name' => 'test',
                'serialNumber' => 'test',
                'wasteType' => [
                    '/api/waste_types/1'
                ],
                'wasteContainerModel' => [
                    '/api/waste_container_models/1'
                ],
                'installFirstDate' => new \DateTimeImmutable(),
                'installNewDate' => new \DateTimeImmutable(),
                'localisationCityId' => 'test'
            ]
        ]);

        $this->assertResponseStatusCodeSame(401);
    }

    public function testPutConnected(): void
    {
        $response = $this->getClient()->request('PUT', '/api/wastes/1', [
            'json' => [
                'name' => 'test',
                'serialNumber' => 'test',
                'wasteType' => [
                    '/api/waste_types/1'
                ],
                'wasteContainerModel' => [
                    '/api/waste_container_models/1'
                ],
                'installFirstDate' => new \DateTimeImmutable(),
                'installNewDate' => new \DateTimeImmutable(),
                'localisationCityId' => 'test'
            ]
        ]);

        $this->assertResponseStatusCodeSame(200);
    }

    public function testDeleteNotConnected(): void
    {
        $response = static::createClient()->request('DELETE', '/api/wastes/1');

        $this->assertResponseStatusCodeSame(401);
    }

    public function testDeleteConnected(): void
    {
        $response = $this->getClient()->request('DELETE', '/api/wastes/1');

        $this->assertResponseStatusCodeSame(200);
    }
}
