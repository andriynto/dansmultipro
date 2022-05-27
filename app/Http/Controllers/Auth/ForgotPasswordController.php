<?php namespace App\Http\Controllers\Auth; 

use DB;
use Mail; 
use Hash;
use Config;
use Carbon\Carbon;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function showForgetPasswordForm()
    {
        return view('frontend.auth.forget');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $valids = ['email' => 'required|email'];

        $request->validate($valids);

        $email  = $request->email;
        $userEmailExists = User::where('email', $email)->exists();
        if($userEmailExists) {

            $token = Str::random(64);
            $created_at = Carbon::now();
            \DB::table('password_resets')->insert(
                ['email' => $request->email, 'token' => $token, 'created_at' => $created_at]
            );

            $mailJobs = (new \App\Jobs\Mail\SendResetPassword([
                'email'     => $request->email,
                'token'     => $token,
                'created_at'=> $created_at
            ]));

            $connection = \Queue::connection('database');
            $connection->pushOn('high', $mailJobs);

            flash()->success('Link perubahan password telah dikirimkan ke email anda');

            return back()->with('message', 'We have e-mailed your password reset link!');
        }

        flash()->error('Email anda tidak terdaftar');

        return back()->with('message', 'email not register');
    }

    /**
    * Write code on Method
    * 
    * @return response()
    */
    public function showResetPasswordForm($token) { 
        return view('frontend.auth.forgetPasswordLink', ['token' => $token]);
    }

        /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitResetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users',
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'
          ]);

          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email, 
                                'token' => $request->token
                              ])->first();

          if(!$updatePassword){
              flash()->error('Terjadi kesalahan, token salah!');
              return back();
          }

          $user = User::where('email', $request->email)
                      ->update(['password' => bcrypt($request->password)]);

          DB::table('password_resets')->where(['email'=> $request->email])->delete();

          flash()->success('Perubahan kata sandi berhasil');
          return redirect('/login');
      }
}