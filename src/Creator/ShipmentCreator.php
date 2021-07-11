<?php

declare(strict_types=1);

namespace App\Creator;

use App\Model\Order;
use App\Service\RequestApiService;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ShipmentCreator
{
    private const URI = '%s/company/%s/shipment/create';

    /** @var HttpClientInterface */
    private $client;

    /** @var RequestApiService */
    private $requestApiService;

    public function __construct(
        HttpClientInterface $client,
        RequestApiService $requestApiService
    ) {
        $this->client = $client;
        $this->requestApiService = $requestApiService;
    }

    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function createShipment(string $companyId, Order $order): array
    {
        // I'm not going to put everything in nice objects again, see App\Fetcher\* for examples on that.
        // Working with plain arrays now.

        $options = [
            'json' => $order->toArrayForShipment(),
        ];
        $response = $this->client->request(
            'POST',
            sprintf(static::URI, $this->requestApiService->getQlsApiBaseUri(), $companyId),
            $this->requestApiService->addHttpBasicAuthentication($options)
        );

        return $response->toArray();
    }
}