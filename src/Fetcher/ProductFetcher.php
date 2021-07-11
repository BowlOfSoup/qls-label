<?php

declare(strict_types=1);

namespace App\Fetcher;

use App\Form\Response\ProductResponseFormType;
use App\Model\Response\Product;
use App\Model\Response\ProductResponse;
use App\Service\RequestApiService;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ProductFetcher
{
    private const URI = '%s/company/%s/product';

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
     * @return Product[]
     *
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function fetchAllProductsByCompany(string $companyId): array
    {
        $options = [];
        $response = $this->client->request(
            'POST',
            sprintf(static::URI, $this->requestApiService->getQlsApiBaseUri(), $companyId),
            $this->requestApiService->addHttpBasicAuthentication($options)
        );

        $productResponseForm = $this->formFactory->create(ProductResponseFormType::class);
        $productResponseForm->submit($response->toArray());

        /** @var ProductResponse $productResponseData */
        $productResponseData = $productResponseForm->getData();

        $products = $productResponseData->getProducts();
        $this->calculateTotalCombinationPrices($products);

        usort($products, function (Product $p1, Product $p2) {
            return $p1->getName() <=> $p2->getName();
        });

        return $products;
    }

    /**
     * @param array|Product[] $products
     */
    private function calculateTotalCombinationPrices(array $products)
    {
        $this->setOptionIdAsKey($products);

        foreach ($products as $product) {
            foreach ($product->getCombinations() as $combination) {
                $combinationPrice = 0;
                foreach ($combination->getProductOptions() as $productOption) {
                    $combinationPrice = $combinationPrice + $product->getOptions()[$productOption->getId()]->getPrice();
                }
                $combination->setTotalPrice($combinationPrice);
            }
        }
    }

    /**
     * @param array|Product[] $products
     */
    private function setOptionIdAsKey(array $products)
    {
        foreach ($products as $product) {
            $productOptions = [];
            foreach ($product->getOptions() as $option) {
                $productOptions[$option->getId()] = $option;
            }
            $product->setOptions($productOptions);
        }
    }
}