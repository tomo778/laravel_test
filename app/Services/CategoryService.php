<?php

namespace app\Services;

use Illuminate\Database\DatabaseManager;
use App\Models\Category;

class CategoryService
{
	protected $db;
	public function __construct(DatabaseManager $db)
	{
		$this->db = $db;
	}

	public function productDetail($id = null)
	{
		$categorys = Category::JoinCategory()
			->whereIn('r_category.plugin_id', [$id])
			->orderBy('m_category.id', 'asc')
			->get();

		return $categorys;
	}

	public function CategoryGet($id) {
		return Category::find($id)->toArray();
	}

}
