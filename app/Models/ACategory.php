<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ACategory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'a_category';

    protected $fillable = [
        'title',
        'text',
        'id',
    ];
}
