<?php

namespace App\HT2Labs\XApi;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use \RuntimeException;

class LrsService
{

    protected $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client();
    }

    /**
     * @param string $endpoint
     * @param string $key
     * @param string $secret
     * @param array $data
     * @return ResponseInterface|null
     */
    public function makeStatementsHttpRequest(string $endpoint, string $key, string $secret, array $data): ?ResponseInterface
    {
        $options = [
            'json' => $data,
            'auth' => [$key, $secret],
            'headers' => [
                'X-Experience-API-Version' => '1.0.1',
            ],
            'timeout' => 10.0,
        ];

        return $this->httpClient->post($endpoint . '/statements', $options);
    }


    /**
     * @param array $data
     * @return ResponseInterface|null
     */
    public function sendToLrs(array $data): ?ResponseInterface
    {
        $endpoint = env('XAPI_ENDPOINT', null);
        $authUser = env('XAPI_KEY', null);
        $authPassword = env('XAPI_SECRET', null);

        if (!($endpoint && $authUser && $authPassword)) {
            throw new RuntimeException('At least one of the required LRS configuration settings is missing!');
        }

        return $this->makeStatementsHttpRequest($endpoint, $authUser, $authPassword, $data);
    }
}