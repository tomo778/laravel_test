<?php

namespace App\Services\Cart;

interface CartListener 
{
    public function update(Cart $cart);
}