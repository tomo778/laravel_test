<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\News;
use App\Models\RCategory;
use App\Models\Category;
use App\DataAccess\NewsDataAccess;
//use App\DataAccess\CategoryDataAccess;

use App\Library\Common;
use Validator;

class CategoryController extends Controller
{
	public function index(NewsDataAccess $NewsDataAccess, $id)
	{
		$category = Category::find($id)->toArray();
		$results = RCategory::select('plugin_id')
			->where('category_id', $id)
			->where('category', 'news')
			->get()->toArray();
		foreach ($results as $k => $v) {
			$tmp[] = $v['plugin_id'];
		}
		$paginate = News::whereIn('id', $tmp)->paginate(6);
		$datas = $NewsDataAccess->news_datas($paginate);
		return view('category', ['paginate' => $paginate, 'datas' => $datas, 'bc' => ['category_name' => $category['title']]]);
	}
}
