<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\News;
use App\Models\RCategory;
use App\DataAccess\NewsDataAccess;
use App\DataAccess\CategoryDataAccess;

use App\Library\Common;
use Validator;

class CategoryController extends Controller
{
	public function __construct(CategoryDataAccess $CategoryDataAccess)
	{
		View::share('side_categorys', $CategoryDataAccess->categorys());
	}
	public function index(NewsDataAccess $NewsDataAccess, $id)
	{
		$results = RCategory::select('plugin_id')
			->where('category_id', $id)
			->where('category', 'news')
			->get()->toArray();
		foreach ($results as $k => $v) {
			$tmp[] = $v['plugin_id'];
		}
		$paginate = News::whereIn('id', $tmp)->paginate(2);
		$datas = $NewsDataAccess->news_datas($paginate);
		return view('category', ['paginate' => $paginate, 'datas' => $datas, 'bc' => ['category_id' => $id]]);
	}
}
