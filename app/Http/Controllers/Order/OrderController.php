<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Contracts\Services\OrderServiceInterface;
use App\Genre;
use lluminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Auth;
use App\User;
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
         return view('order.orderList');

    }

}