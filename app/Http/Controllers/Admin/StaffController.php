<?php
namespace App\Http\Controllers\Admin;
// 以下を追加
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Staff;
use App\Rules\UniqueEmail;
use Validator;
use DB;

class StaffController extends Controller
{
		public function index ()
		{
			$result = Staff::paginate(10);
			return view('admin.staff.index',['result'=>$result]);
		}

		public function create ()
		{
			return view('admin.staff.edit');
		}

		public function create_exe (Request $request,Staff $Staff)
		{
			$request->merge([
				'password' => password_hash($request->password, PASSWORD_DEFAULT),
			]);
			$Staff->fill($request->all())->save();
			$last_insert_id = $Staff->id;
			return redirect('admin/staff/edit/' . $last_insert_id)->with('one_time_mes', 1);
		}

		public function update ($id)
		{
			$request = Staff::findOrFail($id);
			return view('admin.staff.edit',['result'=>$request]);
		}

		public function update_exe (Request $request)
		{
			DB::transaction(function () use ($request) {
				if (!empty($request->password)) {
					$request->merge([
						'password' => password_hash($request->password, PASSWORD_DEFAULT),
					]);
				} else {
					$request->offsetUnset('password');
				}
				$q = Staff::findOrFail($request->id);
				$q->fill($request->all())->save();
			});
			return redirect('admin/staff/edit/' . $request->id)->with('one_time_mes', 2);
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
