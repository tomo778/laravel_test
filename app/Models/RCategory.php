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

    public function getCategory ()
    {
        return $this->hasOne('\App\Models\Category','id','category_id');
    }
}
