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

    public function getRCategory ()
    {
        return $this->hasMany('\App\Models\RCategory','category_id','id');
    }
}