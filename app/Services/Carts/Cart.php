<?php

namespace App\Services\Carts;

// class CartItem
// {
// 	private $product;
// 	private $quantity;
// 	public function __construct($product, $quantity)
// 	{
// 		$this->product = $product;
// 		$this->quantity = $quantity;
// 	}
// 	public function totalAmount()
// 	{
// 		return $this->product->price * $this->quantity;
// 	}
// }

class Cart
{
	private $cartItems;
	public function __construct($cartItems)
	{
		$this->cartItems = $cartItems;
	}
	public function totalAmount()
	{
		return array_reduce(
			$this->cartItems['items'],
			function ($total, $cartItem) {
				return $total + $cartItem['price'] * $cartItem['quantity'];
			},
			0
		);
	}
}
