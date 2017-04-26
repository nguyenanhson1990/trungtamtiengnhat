<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contents extends Model
{
    use SoftDeletes;

    protected $table = 'contents';

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo('App\models\categories','category_id');
    }
}
