<?php
 
namespace App\Providers;

use App\Http\View\Composers\CartComposer;
use App\Http\View\Composers\CategoriesComposer;
use App\Http\View\Composers\ModalComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
 
class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // ...
    }
 
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('header', CategoriesComposer::class);    
        View::composer('cart', CartComposer::class);    
        View::composer('products.modal', ModalComposer::class);    
    }
}