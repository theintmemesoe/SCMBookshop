<?php

namespace App\Http\Controllers\Order;

use App\Contracts\Services\CartServiceInterface;
use App\Http\Controllers\Controller;
use App\Mail\BookMail;
use Illuminate\Support\Facades\Session;
use Mail;

class OrderController extends Controller
{
    private $cartService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CartServiceInterface $cartService)
    {
        $this->cartService = $cartService;
    }

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
        $users = $this->cartService->orderConfirm();
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
