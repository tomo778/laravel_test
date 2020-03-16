<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\News;
use App\RCategory;
use App\DataAccess\NewsDataAccess;
use App\DataAccess\CategoryDataAccess;

use App\Library\Common;
use Validator;

class ContactController extends Controller
{
	public function __construct(CategoryDataAccess $CategoryDataAccess)	{
		View::share('side_categorys', $CategoryDataAccess->categorys());
	}

	public function index ()
	{
		return view('contact');
	}

	public function back ()
	{
		return view('contact',['Request'=>session('contact')]);
	}

	public function confirm (Request $Request)
	{
		$validator = $this->val($Request);
        if($validator->fails() == true){
			return view('contact',['Request'=>$Request->all(), 'errors'=> $validator->errors()]);
		}
		session(['contact' => $Request->all() ]);
		return view('confirm',['Request'=>$Request->all()]);	
	}

	public function finish ()
	{
		//各処理
		session()->regenerateToken();
		session()->forget('contact');
		return view('finish');
	}

	public function val ($request)
	{
		$validator = Validator::make($request->all(), [
			'name'  => 'required',
			'kanso' => 'required',
		]);
		return $validator;
	}
}
