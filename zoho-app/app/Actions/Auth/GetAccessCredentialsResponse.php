<?php

namespace App\Actions\Auth;

use stdClass;

final class GetAccessCredentialsResponse
{
    private stdClass $accessCredentials;

    public function __construct(stdClass $accessCredentials)
    {
        $this->accessCredentials = $accessCredentials;
    }

    public function getAccessToken(): string
    {
        return $this->accessCredentials->access_token;
    }

    public function getApiDomain(): string
    {
        return $this->accessCredentials->api_domain;
    }

    public function getTokenType(): string
    {
        return $this->accessCredentials->token_type;
    }
}
