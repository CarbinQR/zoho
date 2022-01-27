<?php

namespace App\Actions\Deal;

use App\Constant\RecordConstant;

final class CreateDealAction
{
    public function execute(
        CreateDealRequest $request
    ): CreateDealResponse
    {
        $createDealUrl = $request->getApiDomain()
            . "/crm/"
            . env('ZOHO_API_VERSION')
            . '/'
            . RecordConstant::NAMES['DEAL'];

        $data = [
            'data' => [
                [
                    'Deal_Name' => 'DealName.Local',
                    'Stage' => 'Need Analysis',
                    'Last_Name' => 'LLastName.Local',
                    'Amount' => '522'
                ]
            ],
        ];

        $headersArray[] = 'Authorization: Zoho-oauthtoken '
            . $request->getAccessToken();
        $headersArray[] = 'Content-Type: application/x-www-form-urlencoded';

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $createDealUrl,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => $headersArray,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HEADER => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
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

        return new CreateDealResponse($recordId);
    }
}
