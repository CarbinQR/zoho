<?php

namespace App\Actions\Auth;

use http\Exception\InvalidArgumentException;

final class GetAccessCredentialsAction
{
    public function execute(): GetAccessCredentialsResponse
    {
        $data = [
            'refresh_token' => env('ZOHO_REFRESH_TOKEN'),
            'grant_type' => 'refresh_token',
            'client_id' => env('ZOHO_CLIENT_ID'),
            'client_secret' => env('ZOHO_CLIENT_SECRET'),
        ];

        $headersArray[] = 'Content-Type: application/x-www-form-urlencoded';

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => env('ZOHO_CREATE_TOKEN_URL'),
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headersArray,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HEADER => false,
            CURLOPT_SSL_VERIFYPEER => false,
        ]);

        $response = json_decode(
            curl_exec($curl)
        );

        curl_close($curl);

        if (!$response->access_token || $response->access_token === '') {
            throw new InvalidArgumentException('Токен не получен');
        }

        return new GetAccessCredentialsResponse($response);
    }
}
