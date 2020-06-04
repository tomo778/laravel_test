<?php

namespace app\Services;

use App\Models\Product;
use App\Models\ProductCategory;

class ProductService
{
    public function list(): \Illuminate\Pagination\LengthAwarePaginator
    {
        $paginate = Product::with('add_category')
            ->statusCheck()
            ->paginate(10);
        return $paginate;
    }

    public function detail(int $id): \App\Models\Product
    {
        $results = Product::with('add_category')
            ->StatusCheck()
            ->find($id);
        if (empty($results)) {
            abort('404');
        }
        return $results;
    }

    public function categoryList(int $id): \Illuminate\Pagination\LengthAwarePaginator
    {
        $ids = ProductCategory::where('category_id', $id)
            ->pluck('product_id');
        return Product::with('add_category')
            ->statusCheck()
            ->whereIn('id', $ids)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }
}
