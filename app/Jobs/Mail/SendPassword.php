<?php namespace App\Jobs\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

class SendPassword implements ShouldQueue
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
        $title = ['title' => "Account Activation | DAnS Multipro"];
        $data = array_merge($this->request, $title);

        $send = Mail::send('mails.password', $data, function ($message) use($data)
        {
            $message->setContentType('text/html');
            $message->from('andriynto0115@gmail.com', 'DAnS Multipro');
            $message->subject("Account Activation");
            $message->to($data['email'], $data['name']);
        });

        if (Mail::failures()) {
            return false;
        }

        return true;
    }
}