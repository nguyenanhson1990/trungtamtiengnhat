<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{

    protected $table = 'categories';

    protected $guarded = [];

    public function contents()
    {
        return $this->belongsToMany('App\models\contents','content_category','category_id','content_id');
    }
}
