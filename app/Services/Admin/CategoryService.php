<?php

namespace app\Services\Admin;

use App\Models\Category;
use App\Models\CategorysFlont;

class CategoryService
{
    public function categorysFlontSet(): void
    {
        $results = Category::select('categorys.id', 'categorys.title', 'categorys.text')
            ->leftJoin('product_category', 'product_category.category_id', '=', 'categorys.id')
            ->leftJoin('products', 'products.id', '=', 'product_category.product_id')
            ->where('products.status', config('const.STATUS_ON'))
            ->groupBy('categorys.id')
            ->orderBy('categorys.id', 'asc')
            ->get()
            ->toArray();
        CategorysFlont::truncate();
        CategorysFlont::insert($results);
    }
}
