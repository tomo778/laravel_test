<?php

namespace app\Services;

use Illuminate\Database\DatabaseManager;
use App\Models\Product;
use App\Models\Category;
use App\Models\RCategory;
use Carbon\Carbon;

class ProductService
{
	protected $db;
	public function __construct(DatabaseManager $db)
	{
		$this->db = $db;
	}

	public function productDetail($id = null)
	{
		$c = Category::JoinCategory()
			->whereIn('r_category.plugin_id', [$id])
			->orderBy('m_category.id', 'asc')
			->get();

		return $c;
	}

	public function productProcessing($result)
	{
		$result = $result->toArray();
		$categorys = Category::JoinCategory()
			->orderBy('m_category.id', 'asc')
			->get();

		foreach ($categorys as $k => $v) {
			$i = $v->plugin_id;
			$tmp['category_id'] = $v->category_id;
			$tmp['title'] = $v->title;
			$tmp['text'] = $v->text;
			$categorys_tmp[$i][] = $tmp;
		}
		foreach ($result['data'] as $k => $v) {
			//日付format変更
			$dt = new Carbon($v['created_at']);
			$result['data'][$k]['created_at_format'] = $dt->format('Y年m月d日');
			if (isset($categorys_tmp[$v['id']])) {
				$result['data'][$k]['category'] = $categorys_tmp[$v['id']];
			}
		}
		return $result['data'];
	}

	public function topPage()
	{
		$paginate = Product::StatusCheck()->paginate(6);
		$datas = $this->productProcessing($paginate);
		return ['paginate' => $paginate, 'datas' => $datas];
	}

	public function detailPage($id)
	{
		$results = Product::StatusCheck()->find($id);
		if (empty($results)) {
			abort('404');
		}
		return $results;
	}

	public function categoryDetail($id)
	{
		$results = RCategory::select('plugin_id')
			->where('category_id', $id)
			->where('category', 'product')
			->get()->toArray();
		foreach ($results as $k => $v) {
			$plugin_ids[] = $v['plugin_id'];
		}
		if (empty($plugin_ids)) {
			abort('404');
		}
		$paginate = Product::StatusCheck()->whereIn('id', $plugin_ids)->paginate(6);
		$datas = $this->productProcessing($paginate);
		return compact('paginate','datas');
	}
}
