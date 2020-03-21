<?php

namespace App\Http\Controllers\Admin;
// 以下を追加
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Staff;
use App\Library\Common;
use Validator;
use App\Services\AdminInit;

class IndexController extends Controller
{
	public function index ()
	{
		// var_dump(AdminInit::aaa());
		// exit;
		return view('admin/index');
	}
}
