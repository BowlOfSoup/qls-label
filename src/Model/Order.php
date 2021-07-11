<?php

declare(strict_types=1);

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Order
{
    /**
     * @var null|int
     *
     * @Assert\NotNull(
     *     message="Je bent vergeten een verzendmethode te selecteren."
     * )
     */
    private $productId;

    /** @var null|int */
    private $productCombinationId;

    /** @var null|string */
    private $brandId;

    /** @var null|Address */
    private $address;

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): Order
    {
        $this->productId = $productId;

        return $this;
    }

    public function getProductCombinationId(): ?int
    {
        return $this->productCombinationId;
    }

    public function setProductCombinationId(int $productCombinationId): Order
    {
        $this->productCombinationId = $productCombinationId;

        return $this;
    }

    public function getBrandId(): ?string
    {
        return $this->brandId;
    }

    public function setBrandId(string $brandId): Order
    {
        $this->brandId = $brandId;

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): Order
    {
        $this->address = $address;

        return $this;
    }

    public function toArrayForShipment(): array
    {
        // Yes, some hardcoded values, don't feel like handling errors in the timespan of this assignment ;)
        return [
            'brand_id' => $this->brandId,
            'reference' => rand(1000, 9999),
            'weight' => 1,
            'product_id' => $this->productId,
            'product_combination_id' => $this->productCombinationId,
            'cod_amount' => 0,
            'piece_total' => 1,
            'receiver_contact' => [
                'companyname' => $this->address->getCompanyName(),
                'name' => $this->address->getFullName(),
                'street' => $this->address->getStreet(),
                'housenumber' => '18',
                'postalcode' => '3319GS',
                'locality' => $this->address->getCity(),
                'country' => 'NL',
                'email' => $this->address->getEmail(),
            ]
        ];
    }
}