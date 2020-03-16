<?php

namespace App\Http\Controllers\Admin;
// 以下を追加
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Staff;
use App\Library\Common;
use Validator;
use App\Services\AdminInit;

class IndexController extends Controller
{
	public function __construct()	{
		//View::share('artist', Artist::all()->keyBy('id')->toArray());
		$this->middleware('check_admin_login');
	}

	public function index ()
	{
		// var_dump(AdminInit::aaa());
		// exit;
		return view('admin/index');
	}
}
