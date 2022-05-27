<?php namespace App\Http\Controllers\Auth;

/*
 * This file is part of the Indonusamedia
 *
 * Project name : Finance - UPMI
 * author       : Andriyanto, S.kom
 * 
 * (c) Andriyanto <andriyanto@indonusamedia.co.id>
 */
use Auth;
use Config;
use Session;
use Validator;
use App\Jobs\CreateUser;
use Illuminate\Http\Response;
use App\Abstracts\Http\Controller;
use App\Http\Requests\RegistrationRequest as Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class RegisterController extends Controller
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
        return view('frontend.auth.register');
    }

    public function store(Request $request)
    {
        $request->request->add(['password' => substr(md5(microtime()),rand(0,26),6)]);
        $jobs = $this->ajaxDispatch(new CreateUser($request));

        if($jobs['success'])
        {
            $newUser = $jobs['data'];
            $mailJobs = (new \App\Jobs\Mail\SendPassword([
                'name'      => $newUser['name'],
                'username'  => $request['username'],
                'email'     => $request['email'],
                'password'  => $request['password'],
            ]));

            // Add to Queue for send email.
            $connection = \Queue::connection('database');
            $connection->pushOn('high', $mailJobs);

            flash('your password was sent to your email, check inbox or spam folder.')->success();
        }

        return redirect('login');
    }
}