<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Libs\Breadcrumbs;

class CategoryController extends Controller
{
	public function index($id, CategoryService $categoryService, ProductService $productService)
	{
		$datas = $productService->categoryDetail($id);
		$category = $categoryService->categoryGet($id);
		Breadcrumbs::push($category['title']);
		$data = [
			'paginate' => $datas['paginate'],
			'datas' => $datas['datas'],
			'title' => $category['title'],
			'Breadcrumbs' => Breadcrumbs::get()
		];
		return view('category', $data);
	}
}
