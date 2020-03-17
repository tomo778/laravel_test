<?php
namespace App\DataAccess;

use Illuminate\Database\DatabaseManager;
use DB;
use App\Models\Category;
use App\Models\News;

class CategoryDataAccess
{
	protected $db;
	public function __construct(DatabaseManager $db)
	{
		$this->db = $db;
	}

	public function categorys()
	{
		$results = DB::table('m_category')
		->select('m_category.id','m_category.title')
		->leftJoin('r_category','r_category.category_id','=','m_category.id')
		->leftJoin('m_news','m_news.id','=','r_category.plugin_id')
		->where('m_news.status', config('const.STATUS_ON'))
		->where('r_category.plugin', 'news')
		->groupBy('m_category.id')
		->orderBy('m_category.id','desc')
		->get()->keyBy('id')->toArray();
		return $results;
	}

}
