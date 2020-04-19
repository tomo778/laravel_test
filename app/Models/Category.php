<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'm_category';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'text',
    ];

    public function getRCategory()
    {
        return $this->hasMany('\App\Models\RCategory::class', 'category_id', 'id');
    }

    public function scopeJoinCategory($query)
    {
        return $query->leftJoin('r_category', 'r_category.category_id', '=', 'm_category.id');
    }

    public function scopeJoinCategoryProduct($query)
    {
        return $query->leftJoin('m_product', 'm_product.id', '=', 'r_category.plugin_id');
    }

    public function scopeStatusCheck($query)
    {
        return $query->where('m_product.status', config('const.STATUS_ON'));
    }
}
