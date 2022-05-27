<?php namespace App\Jobs\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

class SendResetPassword implements ShouldQueue
{
    protected $request;

    public $tries = 3;

    public $timeout = 180;

    /**
     * Create a new job instance.
     *
     * @param  $request
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    public function handle()
    {
        //izxb-lokp-dgdj-zmoc
        $title = ['title' => "RESET KATA SANDI | e-BPHTB KARO"];
        $data = array_merge($this->request, $title);

        $send = Mail::send('mails.forgetPassword', $data, function ($message) use($data)
        {
            $message->setContentType('text/html');
            $message->from('andriynto0115@gmail.com', 'DAnS Multipro');
            $message->subject("RESET KATA SANDI");
            $message->to($data['email']);
        });

        if (Mail::failures()) {
            return false;
        }

        return true;
    }
}