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
                        <td>' . self::activeStateCategory($category->active) . '</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="edit/' . $category->id . '">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a class="btn btn-danger btn-sm" href="#" onclick="delCategory('. $category->id .', \'/admin/categories/delete\')">
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

    public static function activeStateCategory($active = 0) {
        return $active === 0 ? '<span class="badge bg-danger">No</span>' : '<span>Yes</span>';
    }
}