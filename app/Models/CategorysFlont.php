<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategorysFlont extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categorys_flont';

    protected $fillable = [
        'title',
        'text',
    ];
}
