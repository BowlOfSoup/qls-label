<?php

declare(strict_types=1);

namespace App\Model\Response;

class ProductResponse extends AbstractResponse
{
    /** @var array|Product[] */
    private $products;

    /**
     * @return array|Product[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @param Product[] $products
     */
    public function setProducts(array $products): ProductResponse
    {
        $this->products = $products;

        return $this;
    }
}