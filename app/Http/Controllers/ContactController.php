<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Validator;

class ContactController extends Controller
{
	public function __construct()
	{
		$data = [
			'contact_1' => 'お問い合わせ',
		];
		View::share('bc', $data);
	}

	public function index ()
	{
		return view('contact.contact');
	}

	public function back ()
	{
		return view('contact.contact',['Request'=>session('contact')]);
	}

	public function confirm (Request $Request)
	{
		$validator = $this->val($Request);
        if($validator->fails() == true){
			return view('contact.contact',['Request'=>$Request->all(), 'errors'=> $validator->errors()]);
		}
		session(['contact' => $Request->all() ]);
		return view('contact.confirm',['Request'=>$Request->all()]);	
	}

	public function finish ()
	{
		//各処理
		session()->regenerateToken();
		session()->forget('contact');
		return view('contact.finish');
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
