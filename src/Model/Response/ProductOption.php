<?php

declare(strict_types=1);

namespace App\Model\Response;

class ProductOption
{
    /** @var null|int */
    private $id;

    /** @var null|string */
    private $name;

    /** @var null|int */
    private $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): ProductOption
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): ProductOption
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): ProductOption
    {
        $this->price = $price;

        return $this;
    }
}