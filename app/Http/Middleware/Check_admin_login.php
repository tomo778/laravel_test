<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Services\AdminLogin;

class Check_admin_login
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		//認証処理
		if(!AdminLogin::login_check()){
			return redirect('/admin/login/');
		}
		View::share('category', Category::all()->keyBy('id')->toArray());

		return $next($request);
	}
}
