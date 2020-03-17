<?php

namespace App\Services\Cart;

use App\Services\CartListener;

class PriceListener implements CartListener
{
    public function update(Cart $cart)
    {
        return true;
    }
}
