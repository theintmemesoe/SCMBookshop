<?php

namespace App\Contracts\Dao;

interface CartDaoInterface
{
    public function addToCart($id);
    public function orderConfirm();
}
