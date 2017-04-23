<?php
/**
 * Created by PhpStorm.
 * User: IT Hero
 * Date: 4/23/2017
 * Time: 9:04 PM
 */

function render_multi_menu($data,$seperator,$parent_id,$old)
{

    foreach($data as $value):

        if($value['parent_id'] == $parent_id)
        {
            if(!empty($old) && $old == $value['id'])
            {
                echo  "<option selected value=".$value['id'].">".$seperator.$value['name'] ."</option>";
            }else{
                echo  "<option value=".$value['id'].">".$seperator.$value['name'] ."</option>";
            }
            render_multi_menu($data,$seperator.='-- ',$value['id'],$old);
        }

        endforeach;
}