<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Product;
use App\Library\Common;
use App\Services\CartListener;

class CartController extends Controller
{
	public function __construct()
	{
		$data = [
			'cart_1' => 'カート',
		];
		View::share('bc', $data);
	}

	public function index()
	{
		//var_dump(session('cart'));
		//session()->forget('cart');
		$data = [
			'cart' => session('cart')
		];
		return view('cart', $data);
	}

	public function addItem(Request $Request)
	{
		if (!$this->hasItem($Request->item_id)) {
			$item_data = Product::StatusCheck()
				->where('id', $Request->item_id)
				->first()->toArray();

			$item_data['quantity'] = $Request->quantity;

			$cart_items = session('cart');

			$cart_items['items'][$item_data['id']] = $item_data;

			session(['cart' => $cart_items]);
		} else {
			$data2 = [
				'mes' => 1,
			];
		}

		$data = [
			'cart' => session('cart'),
		];

		if (!empty($data2)) {
			$data = array_merge($data, $data2);
		}

		$this->price();

		return view('cart', $data);
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

		return json_encode(['is_success' => true]);
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
