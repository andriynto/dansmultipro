<?php namespace App\Http\Controllers\Auth;

/*
 * This file is part of the Indonusamedia
 *
 * Project name : MSA
 * author       : Andriyanto, S.kom
 * 
 * (c) Andriyanto <andriyanto@Indonusamedia.co.id>
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
    public function checkAccessToken()
    {
        return response()->json([
            'ip'        => request()->ip(),
            'last_logged_in_at'=> auth()->user(),
            'token_expired' => false
        ], 200);
    }
}