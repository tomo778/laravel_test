<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

use App\Libs\Breadcrumbs;
use App\Services\CartService;

class CartController extends Controller
{
	private $cartService;
	public function __construct(CartService $cartService)
	{
		Breadcrumbs::push('カート');
		View::share('Breadcrumbs', Breadcrumbs::get());
		$this->cartService = $cartService;
	}

	public function index()
	{
		return view('cart', ['cart' => session('cart')]);
	}

	public function addItem(Request $Request)
	{
		$this->cartService->set(session('cart'));
		if (!$this->cartService->hasItem($Request->item_id)) {
			session(['cart' => $this->cartService->addItem($Request)]);
			return view('cart', ['cart' => session('cart')]);
		} else {
			return view('cart', ['cart' => session('cart'), 'mes' => 1]);
		}
	}

	public function removeItem(Request $Request)
	{
		$this->cartService->set(session('cart'));
		session(['cart' => $this->cartService->removeItem($Request->id)]);
		return json_encode(['success' => true]);
	}

	public function quantityChange(Request $Request)
	{
		$this->cartService->set(session('cart'));
		session(['cart' => $this->cartService->quantityChange($Request)]);
		return json_encode(['success' => true]);
	}
}
