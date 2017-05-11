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
        return date("Y-m-d H:i:s",strtotime(str_replace('/','-',$date)));
    }

    public static function mysql_to_date($date)
    {
        return date('d/m/Y', strtotime($date) );
    }

    public static function upload_file($file,$destination,$file_name)
    {
        $file = $file->move($destination,$file_name);

        return $file;
    }

}