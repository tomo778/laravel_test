<?php

namespace app\Services;

use App\Models\Category;

class CategoryService
{
    public function CategoryGet(int $id): \App\Models\Category
    {
        return Category::find($id);
    }
}
