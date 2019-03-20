<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Contracts\Services\OrderServiceInterface;
use App\Book;
use lluminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Support\Facades\Session;
use Log;
use DB;


class OrderController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function getOrder()
    { 
        if(Session::has('cart')){
            $cart = Session::get('cart');
            return view('order.orderList')->with(['book'=>$cart]);
        }
        return view('order.orderList')->with(['book'=>[]]);
           
    }

}