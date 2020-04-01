<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Product;
use Breadcrumbs;
use App\Services\CartService;

class CartController extends Controller
{
	private $CartService;
	public function __construct(CartService $CartService)
	{
		Breadcrumbs::push('カート');
		View::share('Breadcrumbs', Breadcrumbs::get());
		$this->CartService = $CartService;
	}

	public function index()
	{
		return view('cart', ['cart' => session('cart')]);
	}

	public function addItem(Request $Request)
	{
		$this->CartService->set(session('cart'));
		if (!$this->CartService->hasItem($Request->item_id)) {
			session(['cart' => $this->CartService->addItem($Request)]);
			return view('cart', ['cart' => session('cart')]);
		} else {
			return view('cart', ['cart' => session('cart'), 'mes' => 1]);
		}
	}

	public function removeItem(Request $Request)
	{
		$this->CartService->set(session('cart'));
		session(['cart' => $this->CartService->removeItem($Request->id)]);
		return json_encode(['success' => true]);
	}

	public function quantityChange(Request $Request)
	{
		$this->CartService->set(session('cart'));
		session(['cart' => $this->CartService->quantityChange($Request)]);
		return json_encode(['success' => true]);
	}
}