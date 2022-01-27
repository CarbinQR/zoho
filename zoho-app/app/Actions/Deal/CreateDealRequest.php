<?php

namespace App\Actions\Deal;

final class CreateDealRequest
{
    private string $accessToken;

    private string $apiDomain;

    public function __construct(
        string $accessToken,
        string $apiDomain
    ) {
        $this->accessToken = $accessToken;
        $this->apiDomain = $apiDomain;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function getApiDomain(): string
    {
        return $this->apiDomain;
    }
}
