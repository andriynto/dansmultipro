<?php namespace App\Http\Controllers;

/*
 *
 * Project name : Dansmultipro Monolite Exam
 * author       : Andriyanto, S.kom
 * 
 * (c) Andriyanto <andriynto0115@gmail.com>
 */

use DataTables;
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
        return view('backend.dashboard');
    }

    public function lists()
    {
        $client   = new Client;
        
        $response        = $this->jobServices->resources(request()->all());
        
        if(isset($response['statusCode']) && $response['statusCode'] == 200)
        {
            if(!empty(request()->input('search.value')))
            {
                $search = strtoupper(request()->input('search.value'));

                $totalFiltered = $response['data']['totalFiltered'];
                $totalData = $response['data']['totalData'];
            }
            else
            {                
                $totalFiltered = $response['data']['totalFiltered'];
                $totalData = $response['data']['totalData'];
            }

            return DataTables::of($response['data']['data'])->with([
                'data'          => $response['data']['data'],
                'draw'          => intval(request()->input('draw')),  
                "recordsTotal"      => intval($totalData),  
                "recordsFiltered"   => intval($totalFiltered), 
            ])->make(true);
        }
    }
}