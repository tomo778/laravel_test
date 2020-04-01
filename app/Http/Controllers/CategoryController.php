<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Services\CategoryService;
use App\Services\ProductService;
use Breadcrumbs;

class CategoryController extends Controller
{
	public function index($id, CategoryService $CategoryService, ProductService $ProductService)
	{
		$datas = $ProductService->CategoryDetail($id);
		$category = $CategoryService->CategoryGet($id);
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
