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
    protected $table = 'categorys';

    public $timestamps = true;

    protected $guarded = [
        'title',
        'text',
    ];

    // public function getCategoryRel()
    // {
    //     return $this->hasMany('\App\Models\CategoryRel', 'category_id', 'id');
    // }

    // public function scopeJoinCategory($query)
    // {
    //     return $query->leftJoin('category_rel', 'category_rel.category_id', '=', 'categorys.id');
    // }

    // public function scopeJoinCategoryProduct($query)
    // {
    //     return $query->leftJoin('products', 'products.id', '=', 'category_rel.plugin_id');
    // }

    // public function scopeStatusCheck($query)
    // {
    //     return $query->where('products.status', config('const.STATUS_ON'));
    // }
}
