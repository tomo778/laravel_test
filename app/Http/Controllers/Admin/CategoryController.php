<?php

namespace App\Http\Controllers\Admin;
// 以下を追加
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
//use App\Category;
use App\Category;
use App\Library\Common;
use Validator;

class CategoryController extends Controller
{

	public function __construct()	{
		//View::share('category', Category::all());
		$this->middleware('check_admin_login');

	}

	public function index ()
	{
		$result = Category::paginate(10);
		return view('admin.category.index',['result'=>$result]);
	}

	public function search (Request $request)
	{
		$tmp2 = array('name1','name2');
		$query = Category::query();
		$query = Common::fw_search($query, $request['fw'], $tmp2);

		$result = $query->paginate(10);
		return view('admin.category.index',['result'=>$result, 'request'=>$request]);
	}

	public function create ()
	{
		$request['id'] = '';
		return view('admin.category.edit',['mode_name'=>'追加','result'=>$request]);
	}

	public function create_exe (Request $request)
	{
		$post_data = $request->all();
		unset($post_data['_token']);
		$id = Category::insertGetId($post_data);
		return redirect('admin/category/edit/' . $id)->with('one_time_mes', 1);;
	}

	public function update ($id)
	{
		$request = Category::findOrFail($id);
		return view('admin.category.edit',['mode_name'=>'更新','result'=>$request]);
	}

	public function update_exe (Request $request)
	{
		$post_data = $request->all();
		unset($post_data['_token']);
		Category::where('id', $post_data['id'])
		  ->update($post_data);
		return redirect('admin/category/edit/' . $post_data['id'])->with('one_time_mes', 2);
	}

	// public function sort ()
	// {
	// 	$result = Category::orderBy('sort_num', 'asc')
    //             ->get();
	// 	return view('admin.category.index_sort',['mode_name'=>'並び替え','result'=>$result]);
	// }
	// public function sort_exe (Request $request)
	// {
	// 	foreach ($request['sort_num'] as $k => $v) {
	// 		Category::where('id', $k)
	// 		->update(['sort_num' => $v]);
	// 	}
	// 	$result = Category::orderBy('sort_num', 'asc')
    //             ->get();
	// 	return view('admin.category.index_sort',
	// 	['mode_name'=>'並び替え',
	// 	'update'=>1,
	// 	'result'=>$result]);
	// }
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
