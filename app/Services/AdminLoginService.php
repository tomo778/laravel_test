<?php

namespace App\Services;

use App\Models\Staff;
use App\Libs\LogCustom;

class AdminLoginService
{
	
	static public function authCheck($request)
	{
		$data = Staff::where('email', $request['email'])->first();
		//認証処理
		if (password_verify($request['password'], $data['password'])) {
			self::staffDataInit();
			self::loginDataInit($data);
			$LogCustom = new LogCustom('staff');
			$LogCustom->single('/logs/staff.log', 'id: ' . $data['id'] . ' ' . $data['name']);
			return true;
		}
	}

	static public function loginCheck()
	{
		if (!empty(session('staff_data.email'))) {
			return true;
		}
	}

	static public function staffDataInit()
	{
		$staffs_tmp = Staff::all();
		foreach ($staffs_tmp as $k => $v) {
			$staffs[$v['id']] = $v['name'];
		}
		session(['admin_datas_staffs' => $staffs]);
	}

	static public function staffData()
	{
		return session('staff_data');
	}

	static public function loginDataInit($data)
	{
		session(['staff_data' => $data]);
	}

	static public function logout()
	{
		session()->flush();
	}
}
