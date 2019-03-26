<?php

namespace App\Services;

use App\Contracts\Dao\CartDaoInterface;
use App\Contracts\Services\CartServiceInterface;

class CartService implements CartServiceInterface
{
    private $cartDao;

    /**
     * Class Constructor
     * @param OperatorCartDaoInterface
     * @return
     */
    public function __construct(CartDaoInterface $cartDao)
    {
        $this->cartDao = $cartDao;
    }

    /**
     * Get cart List
     * @param $id
     * @return
     */
    public function addToCart($id)
    {
        return $this->cartDao->addToCart($id);
    }

    /**
     * Get order confirm
     * @param
     * @return
     */
    public function orderConfirm()
    {
        return $this->cartDao->orderConfirm();
    }
}
