<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Product;
use App\DataAccess\ProductDataAccess;

class DetailController extends Controller
{
	public function index(ProductDataAccess $ProductDataAccess, $id)
	{
		$request = Product::StatusCheck()->find($id);
		$categorys = $ProductDataAccess->product_detail($id);
		$f = collect($categorys)->first()->toArray();
		$data = [
			'result' => $request,
			'categorys' => $categorys,
			'bc' => [
				'detail_1' => $f,
				'detail_2' => $request->title
				]
		];
		return view('detail', $data);
	}
}
