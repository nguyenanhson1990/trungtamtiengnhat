<?php
/**
 * Created by PhpStorm.
 * User: IT Hero
 * Date: 4/23/2017
 * Time: 9:04 PM
 */

function render_multi_menu($data,$seperator,$parent_id,$old)
{
    foreach($data as $key => $value):

        if($value['parent_id'] == $parent_id && $value['id'] != 1)
        {
            if(!empty($old) && $old == $value['id'])
            {
                echo  "<option selected value=".$value['id'].">".$seperator.$value['name'] ."</option>";
            }else{
                echo  "<option value=".$value['id'].">".$seperator.$value['name'] ."</option>";
            }
            unset($data[$key]);
            render_multi_menu($data,$seperator . '-- ',$value['id'],$old);
        }

        endforeach;
}

function render_multi_cat($data,$seperator,$parent_id)
{
    $stt = 1;
    foreach($data as $key => $value):
        if($value['parent_id'] == $parent_id && $value['id'] != 1):
            echo '<tr>';
            echo '<td>'.$stt++.'</td>';
            echo '<td>'.$seperator.$value['name'].'</td>';
            echo '<td>'.$value['desc'].'</td>';
            echo "<td class='text-center'><a href='".Route('category_edit',['id' => $value['id'],'limit' => Request::get('limit'),'page' => Request::get('page')])."'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>
                                        | <a href='#' class='openModel' modalTitle='". __('admin.category.modal_delete_title'). "' data-toggle='modal'
                                        data-target='#modal-component' datacatname='".$value['name']."' datacat_id='".$value['id']."'><i class='fa fa-trash' aria-hidden='true'></i></a></td>";
            echo '</tr>';
            unset($data[$key]);
            render_multi_cat($data,$seperator . '--| ', $value['id']);
         endif;
    endforeach;
}

function render_category_checkbox($data,$seperator,$parent_id,$old_id)
{
    $stt = 1;
    foreach($data as $key => $value):
        if($value['parent_id'] == $parent_id && $value['id'] != 1):
            if(!empty($old_id) && in_array($value['id'],$old_id)){
                echo '<div class="checkbox">';
                echo '<label>';
                    echo $seperator.'<input type="checkbox" checked name="category_id[]" id="category_id" value="'.$value['id'].'">' . $value['name'];
                echo '</label>';
                echo '</div>';
            }else{
                echo '<div class="checkbox">';
                echo '<label>';
                    echo $seperator.'<input type="checkbox" name="category_id[]" id="category_id" value="'.$value['id'].'">' . $value['name'];
                echo '</label>';
                echo '</div>';
            }

            unset($data[$key]);
            render_category_checkbox($data,'&nbsp&nbsp&nbsp&nbsp', $value['id'],$old_id);
        endif;
    endforeach;
}

function page_limit($limit, $record_per_page)
{
    if(empty($limit)){
        $limit = $record_per_page;
    }

    return $limit;
}