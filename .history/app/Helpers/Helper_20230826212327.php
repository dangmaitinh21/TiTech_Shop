<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class Helper {
    public static function listCategories($categories, $parent_id=0, $char='') {
        $html = '';
        foreach ($categories as $key => $category) {
            if($category->parent_id === $parent_id) {
                $html .= '
                    <tr>
                        <td>' . $category->id . '</td>
                        <td>' . $char . $category->name . '</td>
                        <td>' . $category->description . '</td>
                        <td>' . $category->content . '</td>
                        <td>' . self::activeState($category->active) . '</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="edit/' . $category->id . '">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a class="btn btn-danger btn-sm" href="#" onclick="delItem('. $category->id .', \'/admin/categories/delete\')">
                                <i class="fa-solid fa-xmark"></i>
                            </a>
                        </td>
                    </tr>
                ';

                //Delete item after using
                unset($categories[$key]);

                //Function callback 
                $html .= self::listCategories($categories, $category->id, $char. '[' . $category->name . '] ');
            }
        }
        return $html;
    }

    public static function activeState($active = 0) {
        return $active === 0 ? '<span class="btn btn-danger">No</span>' : '<span class="btn btn-success">Yes</span>';
    }

    public static function menuCategories($categories, $parent_id=0) {
        $html = '';
        foreach($categories as $key => $category) {
            if ($category->parent_id == $parent_id) {
                $html .= '
                <li>
                    <a href="/categories/'. $category->id .'-'. Str::slug($category->name, '-') .'.html">' . $category->name . '</a>';
                if(self::hasChild($categories, $category->id)) {
                    $html .= '<ul class="sub-menu">
                        '. self::menuCategories($categories, $category->id) .'
					</ul>';
                }
                $html .= '</li>';
                unset($categories[$key]);
            }
        }
        return $html;
    }

    public static function menuCategoriesMobile($categories, $parent_id=0) {
        $html = '';
        foreach($categories as $key => $category) {
            if ($category->parent_id == $parent_id) {
                $html .= '
                <li>
                    <a href="/categories/'. $category->id .'-'. Str::slug($category->name, '-') .'.html">' . $category->name . '</a>';
                if(self::hasChild($categories, $category->id)) {
                    $html .= '<ul class="sub-menu-m">
                        '. self::menuCategories($categories, $category->id) .'
					</ul>';
                }
                $html .= '
                    <span class="arrow-main-menu-m">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
					</span>
                </li>';
                unset($categories[$key]);
            }
        }
        return $html;
    }

    public static function hasChild($categories, $id) : bool {
        foreach($categories as $category) {
            if($category->parent_id == $id) {
                return true;
            }
        }
        return false;
    }
    
}