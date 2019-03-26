<?php

namespace App\Http\Controllers\Cart;

use App\Book;
use App\Cart;
use App\Contracts\Services\CartServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
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
     * Call cart list
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function getCart()
    {
        if (Session::has('cart')) {
            $cart = Session::get('cart');
            return view('cart.cartList')->with(['book' => $cart]);
        }
        return view('cart.cartList')->with(['book' => []]);
    }
    /**
     * Add to cart
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function addToCart($id)
    {
        $bookCat = $this->cartService->addToCart($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : [];
        $oldCart[$id] = $bookCat;
        Session::put('cart', $oldCart);
        return redirect('book/bookList');
    }
    /**
     * Clear Cart
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function clearCart()
    {
        Session::forget('cart');
        return redirect('book/bookList');
    }
    /**
     * remove cart
     *
     * @param Request $request,$id
     * @return \Illuminate\Http\Response
     */
    public function removeCart(Request $request, $id)
    {
        $products = session('cart');
        foreach ($products as $key => $value) {
            if ($value->id == $id) {
                unset($products[$key]);
            }
        }
        Log::info($products);
        Session::put('cart', $products);
        return redirect('book/bookList');
    }
    /**
     * Confirm book list
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function confirmBook(Request $request)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : [];
        foreach ($oldCart as $key => $cart) {
            $cart->quantity = $request->quantity[$key];
        }
        Session::put('cart', $oldCart);
        return redirect('order/orderList');
    }
}
