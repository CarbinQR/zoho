<?php

namespace App\Actions\Deal;

final class CreateDealResponse
{
    private string $dealId;

    public function __construct(string $dealId)
    {
        $this->dealId = $dealId;
    }

    public function getRecordId(): string
    {
        return $this->dealId;
    }
}
