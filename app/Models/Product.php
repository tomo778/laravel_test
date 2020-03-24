<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'm_product';

    public $timestamps = true;

    protected $guarded = [
        'id',
        '_token',
        'category',
    ];

    public function scopeStatusCheck($query)
    {
        return $query->where('m_product.status', config('const.STATUS_ON'));
    }
}
