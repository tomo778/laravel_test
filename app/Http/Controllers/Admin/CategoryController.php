<?php

namespace App\Http\Controllers\Admin;
// 以下を追加
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Library\Common;
use Validator;
use DB;

class CategoryController extends Controller
{
	public function index ()
	{
		$result = Category::paginate(10);
		return view('admin.category.index',['result'=>$result]);
	}

	public function create ()
	{
		return view('admin.category.edit');
	}

	public function create_exe (Request $request, Category $Category)
	{
		$Category->fill($request->all())->save();
		$last_insert_id = $Category->id;
		return redirect('admin/category/edit/' . $last_insert_id)->with('one_time_mes', 1);
	}

	public function update ($id)
	{
		$request = Category::findOrFail($id);
		return view('admin.category.edit',['result'=>$request]);
	}

	public function update_exe (Request $request)
	{
		DB::transaction(function () use ($request) {
			$q = Category::findOrFail($request->id);
			$q->fill($request->all())->save();
		});
		return redirect('admin/category/edit/' . $request->id)->with('one_time_mes', 2);
	}

	public function val (Request $request) {
		$validator = Validator::make($request->all(), [
			'title'  => 'required',
			'text' => 'required',
			//'ids' => 'required',
		]);

		if ($validator->fails()) {
			return json_encode(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);
		} else {
			return json_encode(['success' => true]);
		}
	}

}
