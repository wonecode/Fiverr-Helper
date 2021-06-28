<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class UserGeneratorApi
{
    private HttpClientInterface $client;
    private const URL = 'https://randomuser.me/api/';

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getOneUser(): array
    {
        $response = $this->client->request(
            'GET', self::URL, [
                'query' => [
                    'nat' => 'us'
                ]
            ]
        );

        return $response->toArray();
    }

    public function getManyUser(int $number): array
    {
        $response = $this->client->request(
            'GET', self::URL, [
                'query' => [
                    'results' => $number,
                    'nat' => 'us'
                ]
            ]
        );

        return $response->toArray();
    }
}
