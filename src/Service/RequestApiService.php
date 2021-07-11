<?php

declare(strict_types=1);

namespace App\Service;

class RequestApiService
{
    /** @var string */
    private $qlsApiBaseUri;

    /** @var string*/
    private $qlsApiUser;

    /** @var string */
    private $qlsApiPass;

    public function __construct(
        string $qlsApiBaseUri,
        string $qlsApiUser,
        string $qlsApiPass
    ) {
        $this->qlsApiBaseUri = $qlsApiBaseUri;
        $this->qlsApiUser = $qlsApiUser;
        $this->qlsApiPass = $qlsApiPass;
    }

    public function getQlsApiBaseUri(): string
    {
        return $this->qlsApiBaseUri;
    }

    public function addHttpBasicAuthentication(array $requestOptions = []): array
    {
        return array_merge_recursive($requestOptions, [
            'auth_basic' => [$this->qlsApiUser, $this->qlsApiPass],
        ]);
    }
}