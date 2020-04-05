<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Validator;
use App\Libs\Breadcrumbs;

class ContactController extends Controller
{
	public function __construct()
	{
		Breadcrumbs::push('お問い合わせ');
		View::share('Breadcrumbs', Breadcrumbs::get());
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
		$this->sendMail();
		$this->saveSession();
		return view('contact.finish');
	}

	private function sendMail()
	{
		//$to = 'test@gmail.com'; $cc = 'cc@mail.com'; $bcc = 'bcc@mail.com';
		//Mail::to($to)
		//->cc($cc)
		//->bcc($bcc)
		//->send(new Purchase());
	}

	private function saveSession()
	{
		//各処理
		session()->regenerateToken();
		session()->forget('contact');
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
