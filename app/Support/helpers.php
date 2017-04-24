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

function render_multi_cat($data,$seperator,$parent_id)
{
    $stt = 1;
    foreach($data as $key => $value):
        if($value['parent_id'] == $parent_id):
            echo '<tr>';
            echo '<td>'.$stt++.'</td>';
            echo '<td>'.$seperator.$value['name'].'</td>';
            echo '<td>'.$value['desc'].'</td>';
            echo "<td class='text-center'><a href='".Route('user_edit',['id' => $value['id']])."'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>
                                        | <a href='#' class='openModel' modalTitle='". __('admin.users.modal_delete_title'). "' data-toggle='modal'
                                        data-target='#modal-component' datauser_id='".$value['id']."'><i class='fa fa-trash' aria-hidden='true'></i></a></td>";
            echo '</tr>';

            render_multi_cat($data,$seperator . '--| ', $value['id']);
            endif;
        endforeach;
}