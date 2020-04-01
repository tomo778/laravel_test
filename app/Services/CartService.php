<?php

namespace app\Services;

use Illuminate\Database\DatabaseManager;
use App\Models\Product;

class CartService
{
	private $cartItems;

	public function set($items)
	{
		$this->cartItems = $items;
	}

	public function addItem($Request)
	{
		$item_data = Product::StatusCheck()
			->where('id', $Request->item_id)
			->first()->toArray();
		$item_data['quantity'] = $Request->quantity;
		$this->cartItems['items'][$item_data['id']] = $item_data;
		$this->cartItems['price'] = $this->totalAmount();
		return $this->cartItems;
	}

	public function removeItem($id)
	{
		unset($this->cartItems['items'][$id]);
		$this->cartItems['price'] = $this->totalAmount();
		return $this->cartItems;
	}

	public function quantityChange($Request)
	{
		$this->cartItems['items'][$Request->id]['quantity'] = $Request->quantity;
		$this->cartItems['price'] = $this->totalAmount();
		return $this->cartItems;
	}

	public function hasItem($item_id)
	{
		if (empty($this->cartItems['items'])) {
			return false;
		}
		return array_key_exists($item_id, $this->cartItems['items']);
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
