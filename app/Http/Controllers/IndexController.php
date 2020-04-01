<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Product;
use App\Services\ProductService;

class IndexController extends Controller
{
	public function index(ProductService $ProductService)
	{
		$datas = $ProductService->TopPage();
		return view('index', ['paginate' => $datas['paginate'], 'datas' => $datas['datas']]);
	}
}
