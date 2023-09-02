<?php

namespace App\Helpers;

class Helper {
    public static function categories($categories, $parent_id=0, $char='') {
        $html = '';
        foreach ($categories as $key => $category) {
            if($category->parent_id === $parent_id) {
                $html .= '
                    <tr>
                        <td>' . $category->id . '</td>
                        <td>' . $char . $category->name . '</td>
                        <td>' . $category->description . '</td>
                        <td>' . $category->content . '</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href={{url("admin/categories/edit/' . $category->id . '")}}>
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a class="btn btn-danger btn-sm" href="#" onclick="remove('. $category->id .', \'/admin/categories/delete\')">
                                <i class="fa-solid fa-xmark"></i>
                            </a>
                        </td>
                    </tr>
                ';

                //Delete item after using
                unset($categories[$key]);

                //Function callback 
                $html .= self::categories($categories, $category->id, $char. '[' . $category->name . '] ');
            }
        }
        return $html;
    }
}