<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Contracts\Services\OrderServiceInterface;
use lluminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Config;
use App\Book;
use App\Cart;
use Log;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param 
     * @return \Illuminate\Http\Response
     */
    public function getCart()
    { 
        if(Session::has('cart')){
            $book=Book::all();
            $carts=Session::has('cart')? Session::get('cart'):null;
            return view('cart.cartList')->with(['book'=>$book])->with(['carts'=>$carts->items]);
        }else{
            return view('cart.cartList')->with(['book'=>$book]);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function addToCart($id){
        $bookCat = Book::where('id',$id)->first();
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->Add($bookCat,$bookCat->id);
        Session::put('cart',$cart);
        return redirect('book/bookList');
    }

    /**
     * Display a listing of the resource.
     *
     * @param 
     * @return \Illuminate\Http\Response
     */
    public  function clearCart(){
        Session::forget('cart');
        return redirect('book/bookList');
    }

      /**
     * Display a listing of the resource.
     *
     * @param 
     * @return \Illuminate\Http\Response
     */
    public  function removeCart(Request $request,$id)
    {
        // $data = session(['key' => 'value']);
        

        //     $oldCart=Session::get('cart');
        //     $cart=new Cart($oldCart);
        //     $cart->remove($id);
        //     Session::put('cart',$cart);
        //     return redirect()->back();
        
            $products = session('cart');
            
            foreach ($products as $key => $value)
            {
                Log::info($value);
            //     if ($value['id'] == $id) 
            //     {                
            //         unset($products [$key]);            
            //     }
            }
            
            
           
            $request->session()->push('cart',$products);
         
            return redirect()->back();
            
        // Cart::remove($id);
        // return redirect()->back();
    }
  
      /**
     * Display a listing of the resource.
     *
     * @param 
     * @return \Illuminate\Http\Response
     */
    // public function confirmBook($id){
    //     $user_id=Auth()->User()->id;
    //     $cart=Session::get('cart');
    //     return redirect()->back();
    // }

    public function confirmBook(Request $requset,$id){
        $bookCat = Book::where('id',$id)->first();
        $quantity = $request->session()->get('quantity');
        $oldCart = Session::has('order') ? Session::get('order') : null;
        $cart = new Cart($oldCart);
        $cart->Add($bookCat,$bookCat->id,$quantity);
        Session::put('order',$cart);
        return redirect('book/bookList');
    }

}