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

class JobServices extends ResponseApi
{
    /**
     * Get resource data from cloud
     * 
     * http://dev3.dansmultipro.co.id/api/recruitment/positions.json
     * 
     * @param array $data
     * @endpoint civitas/kepegawaian
     * @HTTP GET
     */
    public function resources($data)
    {
        $client   = new Client;

        try {
            $response = $client->get(env('APP_URL') . 'api/jobs', [
                'headers'=> [
                    'Authorization' => 'Bearer ' . session('access_token'),
                    'Accept'        => 'application/json',
                ],
                'json'   => $data,
                'verify' => false
            ]);

            $statusCode = $response->getStatusCode();
            
        }catch (\GuzzleHttp\Exception\RequestException $response) {
            $statusCode = $response->getResponse()->getStatusCode();
            $responseMessage = json_decode($response->getResponse()->getBody()->getContents(), true);
        }

        if($statusCode != 200) {
            return $this->resp($statusCode, $responseMessage);
        }

        $content = json_decode($response->getBody()->getContents(), true);

        return [
            'status'        => true,
            'statusCode'    => $statusCode,
            'responseDescription' => $content['responseDescription'],
            'responseCode'  => $content['responseCode'],
            'data'          => $content['data']
        ];
    }

    /**
     * Get Detail resource data from cloud
     * 
     * @param string uuid $data
     * @endpoint civitas/kepegawaian
     * @HTTP GET
     */
    public function getResource($id)
    {
        $client   = new Client;

        try {
            $response = $client->get($this->urlApis . 'civitas/kepegawaian/' . $id, [
                'headers'=> [
                    'Authorization' => 'Bearer ' . session('access_token'),
                    'Accept'        => 'application/json',
                ],
                'verify' => false
            ]);

            $statusCode = $response->getStatusCode();
        }catch (\GuzzleHttp\Exception\RequestException $response) {
            $statusCode = $response->getResponse()->getStatusCode();
            $responseMessage = json_decode($response->getResponse()->getBody()->getContents(), true);
        }

        if($statusCode != 200) {
            return $this->resp($statusCode, $responseMessage);
        }
        
        $content = json_decode($response->getBody()->getContents(), true);

        return [
            'status'        => true,
            'statusCode'    => $statusCode,
            'responseDescription' => $content['responseDescription'],
            'responseCode'  => $content['responseCode'],
            'data'          => $content['data']
        ];
    }
}