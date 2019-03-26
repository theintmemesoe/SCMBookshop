<?php

namespace App\Dao;

use App\Book;
use App\Contracts\Dao\CartDaoInterface;
use App\User;

class CartDao implements CartDaoInterface
{
    /**
     * Get Cart List
     * @param $id
     * @return
     */
    public function addToCart($id)
    {
        return Book::where('id', $id)->first();
    }

    /**
     * Get Order Confirm
     * @param
     * @return
     */
    public function orderConfirm()
    {
        return User::select('email')->where('type', 1)->first();
    }

}
