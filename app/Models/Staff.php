<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'a_staff';

    public $timestamps = true;

    protected $guarded = [
        'id',
        '_token',
    ];
}
