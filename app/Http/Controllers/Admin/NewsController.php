<?php

namespace App\Http\Controllers\Admin;
// 以下を追加
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Services\LoggerCustom;
use App\Models\News;
use App\Models\Category;
use App\Models\RCategory;
use Validator;
use Log;
use DB;


class NewsController extends Controller
{

	public function __construct()	{
		$this->middleware('check_admin_login');
	}

	public function index ()
	{
		$result = News::paginate(10);
		return view('admin.news.index',['result'=>$result]);
	}

	// public function search (Request $request)
	// {
	// 	$tmp2 = array('title','text');
	// 	$query = News::query();
	// 	$query = Common::fw_search($query, $request['fw'], $tmp2);
	// 	$result = $query->paginate(10);
	// 	return view('admin.news',['result'=>$result, 'request'=>$request]);
	// }

	public function create ()
	{
		return view('admin.news.edit');
	}

	public function create_exe (Request $request)
	{
		$post_data = $request->all();
		unset($post_data['_token']);
		unset($post_data['sw']);
		$tm = $post_data['category'];
		$post_data['category'] = implode(',', $post_data['category']);
		$id = News::insertGetId($post_data);
		foreach ($tm as $k => $v) {
			$tmp['plugin'] = 'news';
			$tmp['plugin_id'] = $id;
			$tmp['category'] = 'news';
			$tmp['category_id'] = $v;
			RCategory::insert($tmp);
		}
		return redirect('admin/news/edit/' . $id)->with('one_time_mes', 1);
	}

	public function update ($id)
	{
		$request = News::findOrFail($id);
		$request['category'] = explode(',', $request['category']);
		return view('admin.news.edit',['result'=>$request]);
	}

	public function update_exe (Request $request)
	{

		$post_data = $request->all();
		unset($post_data['_token']);
		unset($post_data['sw']);
		$tm = $post_data['category'];
		$post_data['category'] = implode(',', $post_data['category']);

		DB::beginTransaction();
		try {
			$request = News::lockForUpdate()->findOrFail($post_data['id']);
			News::where('id', $post_data['id'])
			//->lockForUpdate()
			->update($post_data);
			//throw new \PDOException;
			RCategory::where('plugin_id','=',$post_data['id'])
			->where('plugin','=','news')
			//->lockForUpdate()
			->delete();
			foreach ($tm as $k => $v) {
				$tmp['plugin'] = 'news';
				$tmp['plugin_id'] = $post_data['id'];
				$tmp['category'] = 'news';
				$tmp['category_id'] = $v;
				RCategory::insert($tmp);
			}
			DB::commit();
		} catch (\PDOException $e){
			DB::rollBack();
			//log
			$LoggerCustom = new LoggerCustom(get_class());
			$mes = 'PDOException Error. Rollback was executed.';
			$LoggerCustom->single('/logs/transaction.log', $mes);
			abort('500');
		} catch (\Exception $e){
			DB::rollBack();
			//log
			$LoggerCustom = new LoggerCustom(get_class());
			$mes = 'register() Exception Error.';
			$LoggerCustom->single('/logs/transaction.log', $mes);
			abort('500');
		}

		return redirect('admin/news/edit/' . $post_data['id'])->with('one_time_mes', 2);
	}

	public function val (Request $request)
	{
		$validator = Validator::make($request->all(), [
			'title'  => 'required',
			'text' => 'required',
		]);
		if ($validator->fails()) {
			return json_encode(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);
		} else {
			return json_encode(['success' => true]);
		}
	}
}
