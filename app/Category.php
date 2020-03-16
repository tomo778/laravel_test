<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'm_category';

    // public function aaaa ()
    // {
    //     return $this->hasMany('\App\RCategory','id','category_id');
    // }
}
