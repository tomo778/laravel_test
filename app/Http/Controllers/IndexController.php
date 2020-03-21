<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\News;
use App\DataAccess\NewsDataAccess;

class IndexController extends Controller
{
	public function index (NewsDataAccess $NewsDataAccess)
	{
		$paginate = News::paginate(6);
		$datas = $NewsDataAccess->news_datas($paginate);
		return view('index',['paginate'=>$paginate, 'datas'=> $datas]);
	}
}
