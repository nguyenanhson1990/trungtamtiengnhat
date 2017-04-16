<?php
/**
 * Created by PhpStorm.
 * User: IT Hero
 * Date: 4/16/2017
 * Time: 1:13 PM
 */

namespace App\Repositories;


use App\Models\Contents;

class ContentsRepository implements ContentsRepositoryInterface
{
    public function __construct()
    {
        return Contents::class;
    }

}