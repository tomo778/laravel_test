<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\News;
use App\Library\Common;
use App\Services\CartListener;

class CartController extends Controller
{
	public function index()
	{
		//var_dump(session('cart'));
		//session()->forget('cart');
		return view('cart', ['cart' => session('cart')]);
	}

	public function addItem(Request $Request)
	{
		//var_dump($Request->quantity);

		if ($this->hasItem($Request->item_id)) {
			return view('cart', ['cart' => session('cart'), 'mes' => 1]);
		} else {
			$item_data = News::where('id', $Request->item_id)
				->where('status', config('const.STATUS_ON'))
				->first()->toArray();

				$item_data['quantity'] = $Request->quantity;

			$cart_items = session('cart');

			$cart_items['items'][$item_data['id']] = $item_data;

			session(['cart' => $cart_items]);
		}
		//var_dump(session('cart'));

		$this->price();

		return view('cart', ['cart' => session('cart')]);
	}

	public function removeItem(Request $Request)
	{
		$cart_items = session('cart');

		unset($cart_items['items'][$Request->id]);

		session(['cart' => $cart_items]);

		$this->price();

		return json_encode(['success' => true]);
	}
	public function quantityChange(Request $Request)
	{
		$cart_items = session('cart');

		$cart_items['items'][$Request->id]['quantity'] = $Request->quantity;

		session(['cart' => $cart_items]);

		$this->price();

		return json_encode(['success' => true]);
	}

	public function hasItem($item_id)
	{
		$cart_items = session('cart');
		if (empty($cart_items['items'])) {
			return false;
		}
		return array_key_exists($item_id, $cart_items['items']);
	}

	public function price()
	{
		$cart_items = session('cart');
		$total = 0;
		foreach ($cart_items['items'] as $k => $v) {
			$tmp = $v['price'] * $v['quantity'];
			$total = $total + $tmp;
		}
		$cart_items['price'] = $total;
		session(['cart' => $cart_items]);
	}
}
