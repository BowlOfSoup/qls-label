<?php

declare(strict_types=1);

namespace App\Model;

class OrderLine
{
    /** @var int */
    private $number;

    /** @var string */
    private $productName;

    public function getNumber(): int
    {
        return $this->number;
    }

    public function setNumber(int $number): OrderLine
    {
        $this->number = $number;

        return $this;
    }

    public function getProductName(): string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): OrderLine
    {
        $this->productName = $productName;

        return $this;
    }
}