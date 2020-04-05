<?php

namespace App\Http\Controllers\Admin;
// 以下を追加
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ACategory;
use App\Models\RCategory;
use Validator;
use DB;

class ProductController extends Controller
{
	public function index()
	{
		$result = Product::paginate(10);
		return view('admin.product.index', ['result' => $result]);
	}

	public function create()
	{
		return view('admin.product.edit');
	}

	public function create_exe(Request $request, Product $Product)
	{
		$Product->fill($request->all())->save();
		$last_insert_id = $Product->id;
		RCategory::InsertCategory($request->category, 'product', 'product', $last_insert_id);
		$this->aCategorySet();
		return redirect('admin/product/edit/' . $last_insert_id)->with('one_time_mes', 1);
	}

	public function update($id)
	{
		$request = Product::findOrFail($id);
		$request['category'] = RCategory::where('plugin_id', '=', $request->id)
			->where('plugin', '=', 'product')
			->where('category', '=', 'product')
			->get()->keyBy('category_id')->toArray();
		return view('admin.product.edit', ['result' => $request]);
	}

	public function update_exe(Request $request)
	{
		DB::transaction(function () use ($request) {
			$q = Product::findOrFail($request->id);
			$q->fill($request->all())->save();
			RCategory::where('plugin_id', '=', $request->id)
				->where('plugin', '=', 'product')
				->delete();
			RCategory::InsertCategory($request->category, 'product', 'product', $request->id);
			$this->aCategorySet();
		});
		return redirect('admin/product/edit/' . $request->id)->with('one_time_mes', 2);
	}

	public function aCategorySet()
	{
		$results = Category::select('m_category.id', 'm_category.title', 'm_category.text')
			->JoinCategory()
			->JoinCategoryProduct()
			->StatusCheck()
			->where('r_category.plugin', 'product')
			->groupBy('m_category.id')
			->orderBy('m_category.id', 'asc')
			->get()
			->toArray();
		ACategory::truncate();
		ACategory::insert($results);
	}

	public function val(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'title'  => 'required',
			'text' => 'required',
			'category'  => 'required',
			'price'  => ['required', 'integer'],
			'num' => ['required', 'integer'],
		]);
		if ($validator->fails()) {
			return json_encode(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);
		} else {
			return json_encode(['success' => true]);
		}
	}
}
