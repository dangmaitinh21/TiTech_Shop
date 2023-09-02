<?php
 
namespace App\Http\View\Composers;

use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
 
class CategoriesComposer
{
    public function __construct() {}
 
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $carts = Session::get('carts');
        $view->with('carts', $carts);
    }
}