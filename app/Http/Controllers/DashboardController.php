<?php namespace App\Http\Controllers;

/*
 *
 * Project name : Dansmultipro Monolite Exam
 * author       : Andriyanto, S.kom
 * 
 * (c) Andriyanto <andriynto0115@gmail.com>
 */

use Illuminate\Routing\Controller;
use \Carbon\Carbon,
    GuzzleHttp\Client,
    GuzzleHttp\Exception\RequestException;

use App\Services\JobServices;

class DashboardController extends Controller
{

    protected $jobServices;

    public function __construct(JobServices $jobServices)
    {
        $this->jobServices = $jobServices;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $client   = new Client;
        
        $response        = $this->jobServices->resources(request()->all());
        dd($response);
        // try {
        //     $response = $client->get( env('APP_URL') . 'api/jobs', [
        //         'headers'=> [
        //             'Authorization' => 'Bearer ' . session('access_token'),
        //             'Accept'        => 'application/json',
        //         ],
        //         'json'   => $data,
        //         'verify' => false
        //     ]);

        //     $statusCode = $response->getStatusCode();
            
        // }catch (\GuzzleHttp\Exception\RequestException $response) {
        //     $statusCode = $response->getResponse()->getStatusCode();
        //     $responseMessage = json_decode($response->getResponse()->getBody()->getContents(), true);
        // }

        // if($statusCode != 200) {
        //     return $this->resp($statusCode, $responseMessage);
        // }

        // $content = json_decode($response->getBody()->getContents(), true);

        // return [
        //     'status'        => true,
        //     'statusCode'    => $statusCode,
        //     'responseDescription' => $content['responseDescription'],
        //     'responseCode'  => $content['responseCode'],
        //     'data'          => $content['data']
        // ];
        
        return view('backend.dashboard');
    }
}