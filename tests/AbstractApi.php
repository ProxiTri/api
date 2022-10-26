<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use ApiPlatform\Symfony\Bundle\Test\Client;

class AbstractApi extends ApiTestCase
{
    private Client $client;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->client = static::createClient();


    }

    private function register(): void
    {
        $response = static::createClient()->request('POST', '/api/register', [
            'json' => [
                'email' => $_ENV['ADMIN_EMAIL'],
                'password' => $_ENV['ADMIN_PASSWORD'],
            ]
        ]);
    }

    public function getClient(): Client
    {
        $response = static::createClient()->request('POST', '/api/login', [
            'json' => [
                'username' => $_ENV['ADMIN_EMAIL'],
                'password' => $_ENV['ADMIN_PASSWORD']
            ]
        ]);

        $this->client->setDefaultOptions([
            'headers' => [
                'Authorization' => 'Bearer ' . $response->toArray()["token"]
            ],
        ]);

        return $this->client;
    }
}