<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\News;
use App\DataAccess\NewsDataAccess;
use App\DataAccess\CategoryDataAccess;

use App\Library\Common;
use Validator;

class IndexController extends Controller
{
	public function __construct(CategoryDataAccess $CategoryDataAccess)	{
		View::share('side_categorys', $CategoryDataAccess->categorys());
	}
	public function index (NewsDataAccess $NewsDataAccess)
	{
		$paginate = News::paginate(2);
		$datas = $NewsDataAccess->news_datas($paginate);

		//  //もしnameがあれば
		//  if(!empty($name)){
        //     $query->where('name','like','%'.$name.'%');
        // }

        // //もしemailがあれば
        // if(!empty($email)){
        //     $query->where('email','like','%'.$email.'%');
        // }
		// var_dump($paginate);
		// exit;
		return view('index',['paginate'=>$paginate, 'datas'=> $datas]);
	}
}
