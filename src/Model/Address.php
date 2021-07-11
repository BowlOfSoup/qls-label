<?php

declare(strict_types = 1);

namespace App\Model;

class Address
{
    /** @var string */
    private $companyName;

    /** @var string */
    private $fullName;

    /** @var string */
    private $street;

    /** @var string */
    private $houseNumber;

    /** @var string */
    private $zibCode;

    /** @var string */
    private $city;

    /** @var string */
    private $countryCode;

    /** @var string */
    private $email;

    /** @var string */
    private $phone;

    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): Address
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): Address
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function setStreet(string $street): Address
    {
        $this->street = $street;

        return $this;
    }

    public function getHouseNumber(): string
    {
        return $this->houseNumber;
    }

    public function setHouseNumber(string $houseNumber): Address
    {
        $this->houseNumber = $houseNumber;

        return $this;
    }

    public function getZibCode(): string
    {
        return $this->zibCode;
    }

    public function setZibCode(string $zibCode): Address
    {
        $this->zibCode = $zibCode;

        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): Address
    {
        $this->city = $city;

        return $this;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function setCountryCode(string $countryCode): Address
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): Address
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): Address
    {
        $this->phone = $phone;

        return $this;
    }
}