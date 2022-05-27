<?php namespace App\Http\Controllers\Auth;

/*
 *
 * Project name : Dansmultipro Monolite Exam
 * author       : Andriyanto, S.kom
 * 
 * (c) Andriyanto <andriynto0115@gmail.com>
 */

use Auth;
use Config;
use Session;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('frontend.auth.login');
    }

    /**
     * store login to check authorization
     *
     * @param string username
     * @param string password
     * 
     * @return bool
     */
    public function store(Request $request)
    {
        $valids = [
            'email'    => 'required|max:255',
            'password' => 'required|min:6'
        ];

        $validator = Validator::make($request->all(), $valids);
        
        if( !$validator->fails() )
        {
            $field = filter_var(request($this->username()), FILTER_VALIDATE_EMAIL)
            ? $this->username()
            : 'username';

            $remember_me = request('remember_me') ? true : false;

            # Unauthorized..
            if (!auth()->attempt( [$field => request('email'), 'password' => request('password')], $remember_me) ) {
                
                flash(trans('auth.failed'))->error();
                redirect()->back()->withErrors($validator)->withInput();
            }
        }

        $http = new \GuzzleHttp\Client;
        $urlToken = env('APP_URL') . 'oauth/token';
        $response = $http->post($urlToken, [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => '9665acdc-278f-4315-8349-45fd4a5a8987',
                'client_secret' => 'RP4UUTLLfgjemhstrI8EvK3g9c4F86ZGh14JMqUo',
                'username' => auth()->user()->email,
                'password' => request('password'),
                'scope' => '',
            ],
        ]);

        $token = json_decode((string) $response->getBody(), true);
        
        session()->put('access_token', $token['access_token']);
        session()->put('refresh_token', $token['refresh_token']);

        return redirect('login')
            ->withErrors( $validator)
            ->withInput();
    }

    /**
     * Logout and redirect logout
     * 
     */
    public function destroy()
    {
        $this->logout();
        return redirect('login');
    }

    /**
     * Destroy all session
     * 
     */
    public function logout()
    {
        auth()->logout();
        session()->flush();
        session()->forget('access_token');
        session()->forget('refresh_token');
        
        if (env('SESSION_DRIVER') == 'database') {
            $request = app('Illuminate\Http\Request');
            $request->session()->getHandler()->destroy($request->session()->getId());
        }
    }
}