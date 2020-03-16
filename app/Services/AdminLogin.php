<?php

namespace App\Services;
use App\Staff;
use App\Services\LoggerCustom;

class AdminLogin
{
	// /**
	//  * Determine if the validation rule passes.
	//  *
	//  * @param  string  $attribute
	//  * @param  mixed  $value
	//  * @return bool
	//  */
	static public function auth_check($request)
	{
		$data = Staff::where('email',$request['email'])->first();
		//認証処理
		if(password_verify($request['password'], $data['password'])){
			//loginデータ作成
			self::staff_data_init();
			self::login_data_init($data);
			//log
			$LoggerCustom = new LoggerCustom('staff');
			$mes = 'id: ' . $data['id'] . ' ' . $data['name'];
			$LoggerCustom->single('/logs/staff.log', $mes);

			return true;
		}
	}

	static public function login_check()
	{
		if (!empty(session('staff_data.email'))) {
			return true;
		}
	}

	static public function staff_data_init()
	{
		$staffs_tmp = Staff::all();
		foreach ($staffs_tmp as $k => $v) {
			$staffs[$v['id']] = $v['name'];
		}
		session(['admin_datas_staffs' => $staffs]);
	}

	static public function staff_data()
	{
		return session('staff_data');
	}

	static public function login_data_init($data)
	{
		session(['staff_data' => $data]);
	}

	static public function logout()
	{
		session()->flush();
	}
}
