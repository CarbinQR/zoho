<?php

namespace App\Service\Curl;

use stdClass;

final class CurlRequestService
{
    public function getResponse(
        array $data,
        string $url,
        string $accessToken
    ): ?stdClass {
        $headersArray[] = 'Authorization: Zoho-oauthtoken ' . $accessToken;
        $headersArray[] = 'Content-Type: application/x-www-form-urlencoded';

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
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

        return $response;
    }
}
