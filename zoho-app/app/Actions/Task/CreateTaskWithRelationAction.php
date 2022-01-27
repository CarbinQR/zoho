<?php

namespace App\Actions\Task;

use App\Constant\RecordConstant;
use App\Service\Curl\CurlRequestService;
use http\Exception\InvalidArgumentException;

final class CreateTaskWithRelationAction
{
    public function execute(CreateTaskWithRelationRequest $request): CreateTaskWithRelationResponse
    {
        $createTaskUrl = $request->getApiDomain()
            . "/crm/"
            . env('ZOHO_API_VERSION')
            . '/'
            . RecordConstant::NAMES['TASK'];

        $headersArray[] = 'Authorization: Zoho-oauthtoken '
            . $request->getAccessToken();
        $headersArray[] = 'Content-Type: application/x-www-form-urlencoded';

        $data = [
            'data' => [
                [
                    'Subject' => 'example title',
                    '$se_module' => $request->getRelatedRecordType(),
                    'What_Id' => $request->getRelatedRecordId(),
                ]
            ],
        ];

        $response = (new CurlRequestService())
            ->getResponse(
                $data,
                $createTaskUrl,
                $request->getAccessToken()
            );

        if(!$response->data) {
            throw new InvalidArgumentException('Ошибка создания записи Задача');
        }

        $recordId = '';

        foreach ($response->data as $dataItem) {
            $recordId = $dataItem->details->id;
        }

        return new CreateTaskWithRelationResponse($recordId);
    }
}
