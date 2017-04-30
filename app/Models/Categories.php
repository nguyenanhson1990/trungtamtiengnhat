<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{

    protected $table = 'categories';

    protected $guarded = [];

    public function content()
    {
        return $this->hasMany('App\Models\Contents','category_id','id');
    }
}
