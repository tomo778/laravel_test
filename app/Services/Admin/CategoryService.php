<?php

namespace app\Services\Admin;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CategorysFlont;

class CategoryService
{
    public function list(): \Illuminate\Pagination\LengthAwarePaginator
    {
        $paginate = Category::paginate(20);
        return $paginate;
    }

    public function create(Request $request): int
    {
        $q = Category::create($request->all());
        return $q->id;
    }

    public function updateDatas(int $id): \App\Models\Category
    {
        return Category::findOrFail($id);
    }

    public function update(Request $request): void
    {
        $q = Category::findOrFail($request->id);
        $q->fill($request->all())->save();
    }

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
