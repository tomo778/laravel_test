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
    protected $table = 'staffs';

    public $timestamps = true;

    protected $fillable = [
        'id',
        '_token',
    ];
}
