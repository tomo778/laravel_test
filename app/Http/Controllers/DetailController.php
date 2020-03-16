<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\News;

use App\Library\Common;
use Validator;
use App\DataAccess\NewsDataAccess;
use App\DataAccess\CategoryDataAccess;

class DetailController extends Controller
{
    public function __construct(CategoryDataAccess $CategoryDataAccess)	{
		View::share('side_categorys', $CategoryDataAccess->categorys());
	}

    public function index (NewsDataAccess $NewsDataAccess, $id)
	{
		$request = News::where('id', $id)
		->where('status', config('const.STATUS_ON'))
		->first();
		if($request == null) {
			abort('404');
		}
        $categorys = $NewsDataAccess->news_detail($id);
		return view('detail',['result'=>$request, 'categorys'=> $categorys, 'bc'=> ['detail_id'=>$id]]);
	}
}
