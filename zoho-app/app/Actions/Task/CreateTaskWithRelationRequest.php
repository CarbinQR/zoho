<?php

namespace App\Actions\Task;

final class CreateTaskWithRelationRequest
{
    private string $accessToken;

    private string $apiDomain;

    private string $relatedRecordId;

    private string $relatedRecordType;

    public function __construct(
        string $accessToken,
        string $apiDomain,
        string $relatedRecordId,
        string $relatedRecordType
    ) {
        $this->accessToken = $accessToken;
        $this->apiDomain = $apiDomain;
        $this->relatedRecordId = $relatedRecordId;
        $this->relatedRecordType = $relatedRecordType;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function getApiDomain(): string
    {
        return $this->apiDomain;
    }

    public function getRelatedRecordId(): string
    {
        return $this->relatedRecordId;
    }

    public function getRelatedRecordType(): string
    {
        return $this->relatedRecordType;
    }
}
