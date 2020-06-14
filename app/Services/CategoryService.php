<?php

namespace app\Services;

use App\Models\Category;

class CategoryService
{
    public function CategoryData(int $id): \App\Models\Category
    {
        return Category::findOrFail($id);
    }
}
