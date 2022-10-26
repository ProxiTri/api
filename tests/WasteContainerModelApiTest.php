<?php

namespace App\Tests;

use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class WasteContainerModelApiTest extends AbstractApi
{

    public function testIndexNotConnected(): void
    {
        $response = static::createClient()->request('GET', '/api/waste_container_models');

        $this->assertResponseStatusCodeSame(401);
    }


    /**
     * @throws TransportExceptionInterface
     */
    public function testIndexConnected(): void
    {
        $response = $this->getClient()->request('GET', '/api/waste_container_models');

        $this->assertResponseStatusCodeSame(200);
    }

    public function testPostNotConnected(): void
    {
        $response = static::createClient()->request('POST', '/api/waste_container_models/add', [
            'json' => [
                'modelName' => 'test',
                'modelManuFacturer' => 'test',
                'modelUsefulCapacity' => 0,
                'modelType' => 'test',
            ]
        ]);

        $this->assertResponseStatusCodeSame(401);
    }

    public function testPostConnected(): void
    {
        $response = $this->getClient()->request('POST', '/api/waste_container_models/add', [
            'json' => [
                'modelName' => 'test',
                'modelManuFacturer' => 'test',
                'modelUsefulCapacity' => 0,
                'modelType' => 'test',
            ]
        ]);

        $this->assertResponseStatusCodeSame(200);
    }

    public function testGetOnePostNotConnected(): void
    {
        $response = static::createClient()->request('GET', '/api/waste_container_models/1');

        $this->assertResponseStatusCodeSame(401);
    }

    public function testGetOnePostConnected(): void
    {
        $response = $this->getClient()->request('GET', '/api/waste_container_models/1');

        $this->assertResponseStatusCodeSame(200);
    }

    public function testPutNotConnected(): void
    {
        $response = static::createClient()->request('PUT', '/api/waste_container_models/1', [
            'json' => [
                'modelName' => 'test',
                'modelManuFacturer' => 'test',
                'modelUsefulCapacity' => 0,
                'modelType' => 'test',
            ]
        ]);

        $this->assertResponseStatusCodeSame(401);
    }

    public function testPutConnected(): void
    {
        $response = $this->getClient()->request('PUT', '/api/waste_container_models/1', [
            'json' => [
                'modelName' => 'test',
                'modelManuFacturer' => 'test',
                'modelUsefulCapacity' => 0,
                'modelType' => 'test',
            ]
        ]);

        $this->assertResponseStatusCodeSame(200);
    }

    public function testDeleteNotConnected(): void
    {
        $response = static::createClient()->request('DELETE', '/api/waste_container_models/1');

        $this->assertResponseStatusCodeSame(401);
    }

    public function testDeleteConnected(): void
    {
        $response = $this->getClient()->request('DELETE', '/api/waste_container_models/1');

        $this->assertResponseStatusCodeSame(200);
    }
}
