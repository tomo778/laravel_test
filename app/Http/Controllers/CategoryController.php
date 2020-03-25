<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Product;
use App\Models\RCategory;
use App\Models\Category;
use ProductDataAccess;
use Breadcrumbs;

class CategoryController extends Controller
{
	public function index($id)
	{
		$category = Category::find($id)->toArray();
		$results = RCategory::select('plugin_id')
			->where('category_id', $id)
			->where('category', 'product')
			->get()->toArray();
		foreach ($results as $k => $v) {
			$tmp[] = $v['plugin_id'];
		}
		$paginate = Product::StatusCheck()->whereIn('id', $tmp)->paginate(6);
		$datas = ProductDataAccess::product_datas($paginate);
		Breadcrumbs::push($category['title']);
		$data = [
			'paginate' => $paginate,
			'datas' => $datas,
			'title' => $category['title'],
			'Breadcrumbs' => Breadcrumbs::get()
		];
		return view('category', $data);
	}
}
