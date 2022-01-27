<?php

namespace App\Actions\Deal;

use App\Constant\RecordConstant;
use App\Service\Curl\CurlRequestService;
use http\Exception\InvalidArgumentException;

final class CreateDealAction
{
    public function execute(CreateDealRequest $request): CreateDealResponse
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

        $response = (new CurlRequestService())
            ->getResponse(
                $data,
                $createDealUrl,
                $request->getAccessToken()
            );

        if(!$response->data) {
            throw new InvalidArgumentException('Ошибка создания записи Сделка');
        }

        $recordId = '';

        foreach ($response->data as $dataItem) {
            $recordId = $dataItem->details->id;
        }

        return new CreateDealResponse($recordId);
    }
}
