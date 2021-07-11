<?php

declare(strict_types=1);

namespace App\Model\Response;

class Brand
{
    /** @var string */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $website;

    /** @var string */
    private $logoWeb;

    /** @var string */
    private $logoPrint;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): Brand
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Brand
    {
        $this->name = $name;

        return $this;
    }

    public function getWebsite(): string
    {
        return $this->website;
    }

    public function setWebsite(string $website): Brand
    {
        $this->website = $website;

        return $this;
    }

    public function getLogoWeb(): string
    {
        return $this->logoWeb;
    }

    public function setLogoWeb(string $logoWeb): Brand
    {
        $this->logoWeb = $logoWeb;

        return $this;
    }

    public function getLogoPrint(): string
    {
        return $this->logoPrint;
    }

    public function setLogoPrint(string $logoPrint): Brand
    {
        $this->logoPrint = $logoPrint;

        return $this;
    }
}