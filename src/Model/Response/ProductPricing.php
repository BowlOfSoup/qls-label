<?php

declare(strict_types=1);

namespace App\Model\Response;

class ProductPricing
{
    /** @var null|int */
    private $price;

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): ProductPricing
    {
        $this->price = $price;

        return $this;
    }
}