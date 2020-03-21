<?php
namespace App\Http\Controllers\Admin;
// 以下を追加
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Staff;
use App\Rules\UniqueEmail;
use Validator;

class StaffController extends Controller
{
		public function index ()
		{
			$result = Staff::paginate(10);
			return view('admin.staff.index',['result'=>$result]);
		}

		public function search (Request $request)
		{
			$tmp2 = array('title','text');
			$query = Staff::query();
			$query = Common::fw_search($query, $request['fw'], $tmp2);
			$result = $query->paginate(10);
			return view('admin.staff',['result'=>$result, 'request'=>$request]);
		}

		public function create ()
		{
			$request['id'] = '';
			return view('admin.staff.edit',['mode_name'=>'追加','result'=>$request]);
		}

		public function create_exe (Request $request)
		{
			$post_data = $request->all();
			unset($post_data['_token']);
			unset($post_data['sw']);
			$post_data['password'] = password_hash($post_data['password'], PASSWORD_DEFAULT);
			$id = Staff::insertGetId($post_data);
			return redirect('admin/staff/edit/' . $id)->with('one_time_mes', 1);
		}

		public function update ($id)
		{
			$request = Staff::findOrFail($id);
			return view('admin.staff.edit',['mode_name'=>'更新','result'=>$request]);
		}

		public function update_exe (Request $request)
		{
			$post_data = $request->all();
			unset($post_data['_token']);
			unset($post_data['sw']);
			if (!empty($post_data['password'])) {
				$post_data['password'] = password_hash($post_data['password'], PASSWORD_DEFAULT);
			} else {
				unset($post_data['password']);
			}
			Staff::where('id', $post_data['id'])
			  ->update($post_data);
			return redirect('admin/staff/edit/' . $post_data['id'])->with('one_time_mes', 2);
		}

		public function val (Request $request)
		{
			if (!empty($request['id'])) {
				$validator = Validator::make($request->all(), [
					'name'  => 'required',
					'email' => ['required','email', new UniqueEmail($request->all())],
					//'password' => 'required',
				]);
			} else {
				$validator = Validator::make($request->all(), [
					'name'  => 'required',
					'email' => ['required','email', new UniqueEmail($request->all())],
					'password' => 'required',
				]);
			}

			if ($validator->fails()) {
				return json_encode(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);
			} else {
				return json_encode(['success' => true]);
			}
		}
	}
