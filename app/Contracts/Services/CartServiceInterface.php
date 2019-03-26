<?php

namespace App\Contracts\Services;

interface CartServiceInterface
{
    public function addToCart($id);
    public function orderConfirm();
}
