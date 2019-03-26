<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Mail\BookMail;
use App\User;
use Illuminate\Support\Facades\Session;
use Mail;

class OrderController extends Controller
{

    /**
     * Call order list
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function getOrder()
    {
        if (Session::has('cart')) {
            $cart = Session::get('cart');
            return view('order.orderList')->with(['book' => $cart]);
        }
        return view('order.orderList')->with(['book' => []]);

    }

    /**
     * Order Confirm
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function orderConfirm()
    {
        $users = User::select('email')->where('type', 0)->first();
        $this->sendMail($users);
        Session::forget('cart');
        return redirect('order/orderList');
    }

    /**
     * send mail for order
     *
     * @param $email
     */
    public static function sendmail($email)
    {
        Mail::to($email)->send(new BookMail());
    }

    /**
     *Back to list
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function backOrderConfirm()
    {
        return redirect('cart/cartList');
    }

}
