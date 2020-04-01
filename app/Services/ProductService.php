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

	public function product_detail($id = null)
	{
		$c = Category::JoinCategory()
			->whereIn('r_category.plugin_id', [$id])
			->orderBy('m_category.id', 'asc')
			->get();

		return $c;
	}

	public function ProductProcessing($result)
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

	public function TopPage()
	{
		$paginate = Product::StatusCheck()->paginate(6);
		$datas = $this->ProductProcessing($paginate);
		return ['paginate' => $paginate, 'datas' => $datas];
	}

	public function DetailPage($id)
	{
		return Product::StatusCheck()->find($id);
	}

	public function CategoryDetail($id)
	{
		$results = RCategory::select('plugin_id')
			->where('category_id', $id)
			->where('category', 'product')
			->get()->toArray();
		foreach ($results as $k => $v) {
			$tmp[] = $v['plugin_id'];
		}
		$paginate = Product::StatusCheck()->whereIn('id', $tmp)->paginate(6);
		$datas = $this->ProductProcessing($paginate);
		return compact('paginate','datas');
	}
}
