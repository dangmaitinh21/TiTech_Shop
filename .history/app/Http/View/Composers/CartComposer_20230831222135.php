<?php
 
namespace App\Http\View\Composers;

use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
 
class CartComposer
{
    public function __construct() {}
 
    /**
     * Bind data to the view.
     */
    public function compose(View $view)
    {
        $carts = Session::get('carts');
        if(is_null($carts)) {
           $products = [];
        } else {
            $productId = array_keys($carts);
            $products =  Product::select('id', 'name', 'price', 'price_sale', 'image')
            ->where('active', 1)
            ->whereIn('id', $productId)
            ->get();
        }
        $view->with('products', $products);
    }
}