<?php

declare(strict_types=1);

namespace App\Model\Response;

class ProductCombination
{
    /** @var null|int */
    private $id;

    /** @var null|string */
    private $name;

    /** @var null|array|ProductOption[] */
    private $productOptions;

    /** @var int */
    private $totalPrice;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): ProductCombination
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): ProductCombination
    {
        $this->name = $name;

        return $this;
    }

    public function getProductOptions(): ?array
    {
        return $this->productOptions;
    }

    public function setProductOptions(array $productOptions): ProductCombination
    {
        $this->productOptions = $productOptions;

        return $this;
    }

    public function getTotalPrice(): ?int
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(int $totalPrice): ProductCombination
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }
}