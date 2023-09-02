<?php
 
namespace App\Providers;

use App\Http\View\Composers\CartComposer;
use App\Http\View\Composers\CategoriesComposer;
use Illuminate\Support\Facades;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
 
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
        Facades\View::composer('header', CategoriesComposer::class);    
        Facades\View::composer('cart', CartComposer::class);    
    }
}