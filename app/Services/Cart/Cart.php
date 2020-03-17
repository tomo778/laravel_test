<?php

namespace App\Services\Cart;

use App\Services\LoggerCustom;
use App\Services\CartListener;

class Cart
{
	private $items = [];
	private $listeners = [];

	public function __construct()
	{
		$this->items = $items;
		$this->listeners = $listeners;
	}

	public function addItem($item_data)
	{
		$this->items[] = $item_data;
		$this->notify();
	}

	public function removeItem($item_id)
	{
		unset($this->items[$item_id]);
		$this->notify();
	}

	public function getItems()
	{
		return $this->items;
	}

	public function hasItem($item_id)
	{
		return array_key_exists($item_id, $this->items);
	}

	public function addObserver(CartListener $listener)
	{
		$this->listeners[get_class($listener)] = $listener;
	}
	public function removeObserver(CartListener $listener)
	{
		unset($this->listeners[get_class($listener)]);
	}
	public function notify()
	{
		foreach ($this->listeners as $listener) {
			$listener->update($this);
		}
	}
}
