<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contents extends Model
{
    use SoftDeletes;

    protected $table = 'contents';

    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany('App\models\categories','content_category','content_id','category_id');
    }
}
