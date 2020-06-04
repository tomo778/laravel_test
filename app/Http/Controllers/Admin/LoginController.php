<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AdminLoginService;

class LoginController extends Controller
{
    public function login()
    {
        return view('admin/login', ['result' => '']);
    }

    public function loginCheck(Request $request)
    {
        //認証処理
        if (!AdminLoginService::authCheck($request)) {
            $request['err'] = true;
            return view('admin/login', ['result' => $request]);
        }
        return redirect('admin')->with('one_time_mes', 1);
    }

    public function logout()
    {
        AdminLoginService::logout();
        return redirect('admin/login');
    }
}
