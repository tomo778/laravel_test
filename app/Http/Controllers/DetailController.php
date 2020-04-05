<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Product;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Libs\Breadcrumbs;

class DetailController extends Controller
{
	public function index($id, CategoryService $categoryService, ProductService $productService)
	{
		$request = $productService->detailPage($id);
		$categorys = $categoryService->productDetail($id);
		$category = collect($categorys)->first()->toArray();
		Breadcrumbs::push($category['title'], route('category',$category['category_id']));
		Breadcrumbs::push($request->title);
		$data = [
			'result' => $request,
			'categorys' => $categorys,
			'Breadcrumbs' => Breadcrumbs::get()
		];
		return view('detail', $data);
	}
}
