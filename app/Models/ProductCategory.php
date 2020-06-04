<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_category';

    protected $fillable = [
        'product_id',
        'category_id',
    ];

    public function scopeDeleteRel(Object $query, int $id): void
    {
        $query->where('product_id', '=', $id)->delete();
    }

    public function scopeInsertRel(Object $query, array $categorys, int $last_id): void
    {
        foreach ($categorys as $k => $v) {
            $tmp['product_id'] = $last_id;
            $tmp['category_id'] = $v;
            $data[] = $tmp;
        }
        $query->insert($data);
    }
}
