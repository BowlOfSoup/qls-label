<?php

declare(strict_types=1);

namespace App\Fetcher;

use App\Form\Response\BrandResponseFormType;
use App\Model\Response\Brand;
use App\Model\Response\BrandResponse;
use App\Service\RequestApiService;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class BrandFetcher
{
    private const URI = '%s/company/%s/brand';

    /** @var HttpClientInterface */
    private $client;

    /** @var RequestApiService */
    private $requestApiService;

    /** @var FormFactory */
    private $formFactory;

    public function __construct(
        HttpClientInterface $client,
        RequestApiService $requestApiService,
        FormFactoryInterface $formFactory
    ) {
        $this->client = $client;
        $this->requestApiService = $requestApiService;
        $this->formFactory = $formFactory;
    }

    /**
     * @return array|Brand[]
     *
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function fetchAllBrandsByCompany(string $companyId): array
    {
        $options = [];
        $response = $this->client->request(
            'POST',
            sprintf(static::URI, $this->requestApiService->getQlsApiBaseUri(), $companyId),
            $this->requestApiService->addHttpBasicAuthentication($options)
        );

        $brandResponseForm = $this->formFactory->create(BrandResponseFormType::class);
        $brandResponseForm->submit($response->toArray());

        /** @var BrandResponse $brandResponseData */
        $brandResponseData = $brandResponseForm->getData();

        return $brandResponseData->getBrands();
    }

    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function fetchRandomBrandByCompany(string $companyId): Brand
    {
        $brandsByCompany = $this->fetchAllBrandsByCompany($companyId);
        shuffle($brandsByCompany);

        return end($brandsByCompany);
    }
}