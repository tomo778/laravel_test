<?php
namespace App\DataAccess;

use Illuminate\Database\DatabaseManager;
use DB;
use App\News;
use App\Category;

class NewsDataAccess
{
	protected $db;
	public function __construct(DatabaseManager $db)
	{
		$this->db = $db;
	}

	public function news_detail($id = null)
	{
		$result = DB::table('m_category')
		->leftJoin('r_category','r_category.category_id','=','m_category.id')
		->whereIn('r_category.plugin_id', [$id])
		->orderBy('m_category.id','desc')
		->get();

		return $result;
	}

	public function news_datas($result2)
	{
		$result2 = $result2->toArray();

		$re = DB::table('m_category')
		->leftJoin('r_category','r_category.category_id','=','m_category.id')
		->orderBy('m_category.id','desc')
		->get();
		foreach($re as $k => $v) {
			$i = $v->plugin_id;
			$tmp['category_id'] = $v->category_id;
			$tmp['title'] = $v->title;
			$tmp['text'] = $v->text;
			$re2[$i][] = $tmp;
		}
		foreach($result2['data'] as $k => $v) {
			if (isset($re2[$v['id']])) {
				(array)$result2['data'][$k]['category'] = $re2[$v['id']];
			}
		}
		return $result2['data'];
	}
}