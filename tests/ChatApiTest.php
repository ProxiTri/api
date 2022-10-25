<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use ApiPlatform\Symfony\Bundle\Test\Client;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class ChatApiTest extends ApiTestCase
{
    private Client $client;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->client = static::createClient();
    }

    public function testIndexNotConnected(): void
    {
        $response = static::createClient()->request('GET', '/api/chats');

        $this->assertResponseStatusCodeSame(401);
    }

    public function getClient(): Client
    {
        $response = static::createClient()->request('POST', '/api/login', [
            'json' => [
                'username' => 'alexis.briet2003@gmail.com',
                'password' => 'azerty'
            ]
        ]);

        $this->client->setDefaultOptions([
            'headers' => [
                'Authorization' => 'Bearer ' . $response->toArray()["token"]
            ],
        ]);

        return $this->client;
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testIndexConnected(): void
    {
        $response = $this->getClient()->request('GET', '/api/chats');

        $this->assertResponseStatusCodeSame(200);
    }
}
