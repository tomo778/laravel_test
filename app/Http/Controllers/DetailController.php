<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Product;
use ProductDataAccess;
use Breadcrumbs;

class DetailController extends Controller
{
	public function index($id)
	{
		$request = Product::StatusCheck()->find($id);
		$categorys = ProductDataAccess::product_detail($id);
		$f = collect($categorys)->first()->toArray();
		Breadcrumbs::push($f['title'], route('category',$f['category_id']));
		Breadcrumbs::push($request->title);
		$data = [
			'result' => $request,
			'categorys' => $categorys,
			'Breadcrumbs' => Breadcrumbs::get()
		];
		return view('detail', $data);
	}
}
