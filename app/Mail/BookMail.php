<?php

namespace App\Mail;

use Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Session;
use Log;

class BookMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        if (Session::has('cart')) {
            $cart = Session::get('cart');
            $user = Auth::user()->all();
            Log::info($user);
            return $this->view('emails.verifyOrder')->with(['book' => $cart])->with(['user' => $user]);
        }
        return $this->view('emails.verifyOrder')->with(['book' => []]);
    }

}
