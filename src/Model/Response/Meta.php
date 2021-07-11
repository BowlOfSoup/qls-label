<?php

declare(strict_types=1);

namespace App\Model\Response;

class Meta
{
    /** @var null|int */
    private $statusCode;

    public function getStatusCode(): ?int
    {
        return $this->statusCode;
    }

    public function setStatusCode(int $statusCode): Meta
    {
        $this->statusCode = $statusCode;

        return $this;
    }
}