<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contents extends Eloquent
{
    use SoftDeletes;

    protected $table = 'contents';
}
