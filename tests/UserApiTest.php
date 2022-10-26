<?php

namespace App\Tests;

use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class UserApiTest extends AbstractApi
{

    public function testIndexNotConnected(): void
    {
        $response = static::createClient()->request('GET', '/api/users');

        $this->assertResponseStatusCodeSame(401);
    }


    /**
     * @throws TransportExceptionInterface
     */
    public function testIndexConnected(): void
    {
        $response = $this->getClient()->request('GET', '/api/users');

        $this->assertResponseStatusCodeSame(200);
    }

    public function testPostNotConnected(): void
    {
        $response = static::createClient()->request('POST', '/api/users/add', [
            'json' => [
                'email' => 'alexis.briet2003@gmail.com',
                'roles' => [
                    'ROLE_USER',
                    'ROLE_ADMIN',
                ],
                'password' => 'azerty',
                'name' => 'Doe',
                'firstName' => 'John',
                'age' => 19,
                'imgProfile' => 'url',
                'isBan' => false,
                'chats' => [
                ],
                'reports' => [
                ],
            ]
        ]);

        $this->assertResponseStatusCodeSame(401);
    }

    public function testPostConnected(): void
    {
        $response = $this->getClient()->request('POST', '/api/users/add', [
            'json' => [
                'email' => 'alexis.briet2003@gmail.com',
                'roles' => [
                    'ROLE_USER',
                    'ROLE_ADMIN',
                ],
                'password' => 'azerty',
                'name' => 'Doe',
                'firstName' => 'John',
                'age' => 19,
                'imgProfile' => 'url',
                'isBan' => false,
                'chats' => [
                ],
                'reports' => [
                ],
            ]
        ]);

        $this->assertResponseStatusCodeSame(200);
    }

    public function testGetOnePostNotConnected(): void
    {
        $response = static::createClient()->request('GET', '/api/users/1');

        $this->assertResponseStatusCodeSame(401);
    }

    public function testGetOnePostConnected(): void
    {
        $response = $this->getClient()->request('GET', '/api/users/1');

        $this->assertResponseStatusCodeSame(200);
    }

    public function testPutNotConnected(): void
    {
        $response = static::createClient()->request('PUT', '/api/users/1', [
            'json' => [
                'email' => 'alexis.briet2003@gmail.com',
                'roles' => [
                    'ROLE_USER',
                    'ROLE_ADMIN',
                ],
                'password' => 'azerty',
                'name' => 'Doe',
                'firstName' => 'John',
                'age' => 19,
                'imgProfile' => 'url',
                'isBan' => false,
                'chats' => [
                ],
                'reports' => [
                ],
            ]
        ]);

        $this->assertResponseStatusCodeSame(401);
    }

    public function testPutConnected(): void
    {
        $response = $this->getClient()->request('PUT', '/api/users/1', [
            'json' => [
                'email' => 'alexis.briet2003@gmail.com',
                'roles' => [
                    'ROLE_USER',
                    'ROLE_ADMIN',
                ],
                'password' => 'azerty',
                'name' => 'Doe',
                'firstName' => 'John',
                'age' => 19,
                'imgProfile' => 'url',
                'isBan' => false,
                'chats' => [
                ],
                'reports' => [
                ],
            ]
        ]);

        $this->assertResponseStatusCodeSame(200);
    }

    public function testDeleteNotConnected(): void
    {
        $response = static::createClient()->request('DELETE', '/api/users/2');

        $this->assertResponseStatusCodeSame(401);
    }

    public function testDeleteConnected(): void
    {
        $response = $this->getClient()->request('DELETE', '/api/users/2');

        $this->assertResponseStatusCodeSame(200);
    }
}
