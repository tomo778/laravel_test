<?php

namespace App\Http\Controllers\Admin;
// 以下を追加
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Staff;
use App\Library\Common;
use Validator;
use App\Services\AdminLogin;

class LoginController extends Controller
{
	public function login ()
	{
		return view('admin/login', ['result'=>'']);
	}
	public function login_check (Request $request)
	{
		//認証処理
		if(!AdminLogin::auth_check($request)){
			$request['err'] = true;
			return view('admin/login',['result'=>$request]);
		}
		return redirect('admin')->with('one_time_mes', 1);
	}

	public function logout ()
	{
		AdminLogin::logout();
		return redirect('admin/login');
	}
}
