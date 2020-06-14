<?php

namespace app\Services\Admin;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;

class ProductService
{
    public function list(): \Illuminate\Pagination\LengthAwarePaginator
    {
        $paginate = Product::with('add_category')
            ->paginate(20);
        return $paginate;
    }

    public function create(Request $request): int
    {
        $q = Product::create($request->all());
        $last_id = $q->id;
        ProductCategory::InsertRel($request->category, $last_id);
        return $last_id;
    }

    public function updateDatas(int $id): \App\Models\Product
    {
        return Product::with('add_category')
            ->findOrFail($id);
    }

    public function update(Request $request): void
    {
        $q = Product::findOrFail($request->id);
        $q->fill($request->all())->save();
        ProductCategory::where('product_id', '=', $request->id)
            ->delete();
        ProductCategory::InsertRel($request->category, $request->id);
    }
}
