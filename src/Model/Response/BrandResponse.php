<?php

declare(strict_types=1);

namespace App\Model\Response;

use App\Model\Response\Brand;

class BrandResponse extends AbstractResponse
{
    /** @var array|Brand[] */
    private $brands;

    /**
     * @return array|Brand[]
     */
    public function getBrands(): array
    {
        return $this->brands;
    }

    /**
     * @param Brand[] $brands
     */
    public function setBrands(array $brands): BrandResponse
    {
        $this->brands = $brands;

        return $this;
    }
}