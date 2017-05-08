<?php

namespace App\Support;
/**
 * Created by PhpStorm.
 * User: IT Hero
 * Date: 5/7/2017
 * Time: 12:35 AM
 */
class functions
{
    //convert date php to datetime mysql format
    public static function to_date_mysql($date)
    {
        $date = strtotime($date);
        return date('Y-m-d H:i:s', $date );
    }

    public static function upload_file($file,$destination,$file_name)
    {
        $path = $file->storeAs($destination, $file_name);

        return $path;
    }

}