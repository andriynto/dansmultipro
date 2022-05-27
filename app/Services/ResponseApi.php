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

class ResponseApi 
{
    public function resp($statusCode, $responseMessage)
    {
        if($statusCode == 422) {
            return [
                'statusCode'    => $statusCode,
                'errorMessage'  => $responseMessage
            ];
        }
        
        else if($statusCode == 401 || $statusCode == 403 || $statusCode == 419) {
            return [
                'statusCode'    => $statusCode,
                'errorMessage'  => $responseMessage['message']
            ];
        }

        else if($statusCode == 500) {
            return [
                'statusCode'    => $statusCode,
                'errorMessage'  => 'Terjadi kesalahan jaringan'
            ];
        }
    }
}