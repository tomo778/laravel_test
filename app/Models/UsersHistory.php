<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UsersHistory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users_history';
    
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'order_id',
        'title',
        'price',
        'quantity',
    ];

    /** JSONに含めるアクセサ */
    protected $appends = [
        'createdAtJa'
    ];

    public function getCreatedAtJaAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('Y年m月d日H:i');//'Y年m月d日(D)H:i'
    }
}
