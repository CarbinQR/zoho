<?php

namespace App\Actions\Task;

use App\Constant\RecordConstant;

final class CreateTaskWithRelationAction
{
    public function execute(
        CreateTaskWithRelationRequest $request
    ): CreateTaskWithRelationResponse
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

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $createTaskUrl,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headersArray,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HEADER => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        ]);

        $response = json_decode(
            curl_exec($curl)
        );

        curl_close($curl);

        $recordId = '';

        foreach ($response->data as $dataItem) {
            $recordId = $dataItem->details->id;
        }

        return new CreateTaskWithRelationResponse($recordId);
    }
}
