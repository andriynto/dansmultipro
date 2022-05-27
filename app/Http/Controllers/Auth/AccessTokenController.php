<?php namespace App\Http\Controllers\Auth;

/*
 *
 * Project name : Dansmultipro Monolite Exam
 * author       : Andriyanto, S.kom
 * 
 * (c) Andriyanto <andriynto0115@gmail.com>
 */

use Jenssegers\Agent\Agent;
use Illuminate\Routing\Controller;

class AccessTokenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function show()
    {
        return view('backend.auth.token.show');
    }

    public function store()
    {
        $user = \App\Models\User::find(auth()->user()->id);
        $user->createToken('Laravel Password Grant Client')->accessToken;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function checkAccessToken()
    {
        return response()->json([
            'ip'        => request()->ip(),
            'last_logged_in_at'=> auth()->user(),
            'token_expired' => false
        ], 200);
    }
}