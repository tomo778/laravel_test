<?php

namespace App\DataAccess;

use Illuminate\Database\DatabaseManager;
use DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\RCategory;

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
			->orderBy('m_category.id', 'desc')
			->get();

		return $c;
	}

	public function product_datas($result)
	{
		$result = $result->toArray();
		$categorys = Category::JoinCategory()
			->orderBy('m_category.id', 'desc')
			->get();

		foreach ($categorys as $k => $v) {
			$i = $v->plugin_id;
			$tmp['category_id'] = $v->category_id;
			$tmp['title'] = $v->title;
			$tmp['text'] = $v->text;
			$categorys_tmp[$i][] = $tmp;
		}
		foreach ($result['data'] as $k => $v) {
			if (isset($categorys_tmp[$v['id']])) {
				(array) $result['data'][$k]['category'] = $categorys_tmp[$v['id']];
			}
		}
		return $result['data'];
	}
}
