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

    public function scopeInsertCategory($query, $array, $plugin, $category, $last_id)
    {
		foreach ($array as $k => $v) {
			$tmp['plugin'] = $plugin;
			$tmp['plugin_id'] = $last_id;
			$tmp['category'] = $category;
			$tmp['category_id'] = $v;
			$data[] = $tmp;
		}
        return $query->insert($data);
    }
}
