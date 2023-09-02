<?php
 
namespace App\View\Composers;

use App\Models\Categories;
use Illuminate\View\View;
 
class CategoriesComposer
{
    public function __construct() {}
 
    /**
     * Bind data to the view.
     */
    public function compose(View $view)
    {
        $categories =  Categories::select('id', 'name', 'parent_id')->where('active', 1)->orderByDesc('id')->get();
        $view->with('categories', $categories);
    }
}