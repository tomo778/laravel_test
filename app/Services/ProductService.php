<?php

namespace app\Services;

use App\Models\Product;
use App\Models\ProductCategory;

class ProductService
{
    public function list(): \Illuminate\Pagination\LengthAwarePaginator
    {
        return Product::with('add_category')
            ->statusCheck()
            ->paginate(10);
    }

    public function detail(int $id): \App\Models\Product
    {
        return Product::with('add_category')
            ->StatusCheck()
            ->findOrFail($id);
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
