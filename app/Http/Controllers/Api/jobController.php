<?php namespace App\Http\Controllers\Api;

/*
 *
 * Project name : Dansmultipro Monolite Exam
 * author       : Andriyanto, S.kom
 * 
 * (c) Andriyanto <andriynto0115@gmail.com>
 */

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

use \Carbon\Carbon,
    GuzzleHttp\Client,
    GuzzleHttp\Exception\RequestException;

class jobController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function get(Request $request)
    {
        if( request()->isMethod('GET'))
        {
            $client   = new Client;

            try {
                $response = $client->get('http://dev3.dansmultipro.co.id/api/recruitment/positions.json', [
                    'verify' => false
                ]);

                $statusCode = $response->getStatusCode();
                
            }catch (\GuzzleHttp\Exception\RequestException $response) {
                $statusCode = $response->getResponse()->getStatusCode();
                $responseMessage = json_decode($response->getResponse()->getBody()->getContents(), true);
            }
        }

        $responseCode = '500';
        $responseDescription = 'Error';

        if($statusCode != 200) {
            $content = [];
        }else {
            $responseCode = '00';
            $responseDescription = 'Success';
            $content = json_decode($response->getBody()->getContents(), true);
        }

        return response()->json([
            'status'        => true,
            'responseDescription' => $responseDescription,
            'responseCode'  => $responseCode,
            'data'          => [
                'data'      => $content,
                'totalData' => 32,
                'totalFiltered' => count($content),
            ]
        ], 200);
    }
}