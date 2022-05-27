<?php namespace App\Http\Controllers\Auth;

/*
 *
 * Project name : Dansmultipro Monolite Exam
 * author       : Andriyanto, S.kom
 * 
 * (c) Andriyanto <andriynto0115@gmail.com>
 */

use DataTables;
use App\Http\Requests\VerifyRequest as Request;
use Illuminate\Routing\Controller;

class VerifyController extends Controller
{
     /**
     * Display a verify form.
     * @return Response
     */
    public function show()
    {
        $expired_in = auth()->user()->expired_in;
        return view('backend.auth.verify.show', compact('expired_in'));
    }
     /**
     * Store data update for change password
     * and activatio user
     * .
     * @return Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $expired_in = $user->expired_in;

        if($expired_in >= \Carbon\Carbon::now() )
        {
            $code = $user->activation_code;
            if($code === request()->input('pin'))
            {
                $updateActivation = $user->update([
                    'verify'      =>  1,
                    'password'    => $request['password']
                ]);

                return response()->json([
                    'status'        => true,
                    'message'       => 'Aktivasi dan pergantian kata sandi berhasil'
                ], 200);
            }

            return response()->json([
                'status'        => false,
                'message'       => 'Pin Code tidak sesuai / salah'
            ], 522);
        }

        return response()->json([
            'status'        => false,
            'message'       => 'Pin Code telah expired'
        ], 522);
    }

     /**
     * Get data and send pin code on email.
     * 
     * @return Response
     */
    public function get()
    {
        $user = auth()->user();

        $expired_at = \Carbon\Carbon::now()->addMinutes(3);

        $pin        = $this->generateRandomString();
        $expired_in = $user->expired_in;
        
        if(\Carbon\Carbon::now() > $expired_in || is_null($expired_in))
        {
            /** send password information */
            $mailJobs = (new \App\Jobs\Mail\SendPinCode([
                'name'      => $user->name,
                'email'     => $user->email,
                'activity'  => 'Perubahan Password',
                'expired_at'=> $expired_at,
                'pin'       => $pin
            ]));

            $connection = \Queue::connection('database');
            $connection->pushOn('high', $mailJobs);   

            $updateExpiredAt = $user->update([
                'expired_in'        => $expired_at,
                'activation_code'   => $pin
            ]);

            return response()->json([
                'status'        => true,
                'expired_at'    => $expired_at
            ], 200);
        }

    }

    /**
     * Generate random password
     *
     * @return mix random string
     */
    private function generateRandomString($length = 6)
    {
        $characters = '1234567890';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}