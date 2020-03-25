<?php

namespace app\Services;

use Illuminate\Database\DatabaseManager;
use DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\RCategory;
use Carbon\Carbon;

class ProductDataAccess
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

	public function product_datas($result)
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
}
