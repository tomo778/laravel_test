<?php

namespace App\DataAccess;

use Illuminate\Database\DatabaseManager;
use DB;
use App\Models\News;
use App\Models\Category;
use App\Models\RCategory;

class NewsDataAccess
{
	protected $db;
	public function __construct(DatabaseManager $db)
	{
		$this->db = $db;
	}

	public function news_detail($id = null)
	{
		// $c = RCategory::where('plugin_id', $id)->get();
		// foreach($c as $v) {
		// 	$r = $v->getCategory()->get()->toArray();
		// 	var_dump($r);
		// }
		// exit;

		$c = DB::table('m_category')
			->leftJoin('r_category', 'r_category.category_id', '=', 'm_category.id')
			->whereIn('r_category.plugin_id', [$id])
			->orderBy('m_category.id', 'desc')
			->get();

		return $c;
	}

	public function news_datas($result)
	{
		$result = $result->toArray();
		$categorys = DB::table('m_category')
			->leftJoin('r_category', 'r_category.category_id', '=', 'm_category.id')
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
