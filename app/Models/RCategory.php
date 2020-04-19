<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RCategory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'r_category';

    protected $fillable = [
        'plugin',
        'plugin_id',
        'category',
        'category_id',
    ];

    public function getCategory ()
    {
        return $this->hasOne('\App\Models\Category::class','id','category_id');
    }
}