<?php namespace App\Services;

/*
 *
 * Project name : Dansmultipro Monolite Exam
 * author       : Andriyanto, S.kom
 * 
 * (c) Andriyanto <andriynto0115@gmail.com>
 */

use \Carbon\Carbon,
    GuzzleHttp\Client,
    GuzzleHttp\Exception\RequestException;

class AccessToken
{
    public function check()
    {
        $client   = new Client;

        $urlApi = env('APP_URL');

        try {
            $response = $client->post($urlApi . 'api/auth/check-accessToken', [
                'headers'=> [
                    'Authorization' => 'Bearer ' . session()->get('access_token'),
                    'Accept'        => 'application/json',
                ],
                'verify' => false,
            ]);

            $statusCode = $response->getStatusCode();

        }catch (\GuzzleHttp\Exception\RequestException $response) {
            $statusCode = $response->getResponse()->getStatusCode();
            $responseMessage = json_decode($response->getResponse()->getBody()->getContents(), true);
        }

        if($statusCode == 419) {
            return [
                'statusCode'    => $statusCode,
                'errorMessage'  => $responseMessage['message']
            ];
        }

        else if($statusCode == 401) {
            return [
                'statusCode'    => $statusCode,
                'errorMessage'  => $responseMessage['message']
            ];
        }

        else if($statusCode == 200) {
            $content = json_decode($response->getBody()->getContents(), true);

            return $content;
        }
    }
}