<?php

declare(strict_types=1);

namespace App\Model\Response;

class Product
{
    /** @var null|int */
    private $id;

    /** @var null|string */
    private $name;

    /** @var null|string */
    private $specifications;

    /** @var null|array|ProductOption[] */
    private $options;

    /** @var null|array|ProductCombination[] */
    private $combinations;

    /** @var null|array|ProductPricing[] */
    private $pricing;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): Product
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): Product
    {
        $this->name = $name;

        return $this;
    }

    public function getSpecifications(): ?string
    {
        return $this->specifications;
    }

    public function setSpecifications(string $specifications): Product
    {
        $this->specifications = $specifications;

        return $this;
    }

    /**
     * @return array|ProductOption[]|null
     */
    public function getOptions(): ?array
    {
        return $this->options;
    }

    /**
     * @param ProductOption[] $options
     */
    public function setOptions(array $options): Product
    {
        $this->options = $options;

        return $this;
    }

    /**
     * @return array|ProductCombination[]|null
     */
    public function getCombinations(): ?array
    {
        return $this->combinations;
    }

    /**
     * @param ProductCombination[] $combinations
     */
    public function setCombinations(array $combinations): Product
    {
        $this->combinations = $combinations;

        return $this;
    }

    public function getPricing(): ?array
    {
        return $this->pricing;
    }

    public function setPricing(?array $pricing): Product
    {
        $this->pricing = $pricing;

        return $this;
    }
}