<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersAddress extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users_address';
    
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'zip1',
        'zip2',
        'pref',
        'address1',
        'address2',
    ];
}
