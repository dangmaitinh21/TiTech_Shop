<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Login\MainController;

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\SlidersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login/authentication', [LoginController::class, 'loginAuth']);

// when there isn't any corresponding url then fallback will be executed 
Route::fallback(function() {
    return '<b>404 Page Not Found!</b>';
})->name('error404');

// grouping routes and integrating middleware for those routes
Route::middleware(['web', 'auth'])->group(function() {
    Route::prefix('admin')->group(function() {
        Route::get('/', [MainController::class, 'index'])->name('adminLogin');

        // Categories
        Route::prefix('categories')->group(function() {
            Route::get('add', [CategoriesController::class, 'renderFormCategory']);
            Route::post('add', [CategoriesController::class, 'createCategory']);
            Route::get('list', [CategoriesController::class, 'getCategories']);
            Route::get('edit/{category}', [CategoriesController::class, 'editFormCategory']);
            Route::post('edit/{category}', [CategoriesController::class, 'updateCategory']);
            Route::delete('delete', [CategoriesController::class, 'delCategory']);
        });

        // Products
        Route::prefix('products')->group(function() {
            Route::get('add', [ProductsController::class, 'renderFormProduct']);
            Route::post('add', [ProductsController::class, 'createProduct']);
            Route::get('list', [ProductsController::class, 'getProducts']);
            Route::get('edit/{product}', [ProductsController::class, 'editFormProduct']);
            Route::post('edit/{product}', [ProductsController::class, 'updateProduct']);
            Route::delete('delete', [ProductsController::class, 'delProduct']);
        });

        // Carousel/Slider/Banner
        Route::prefix('sliders')->group(function() {
            Route::get('add', [SlidersController::class, 'renderFormProduct']);
            Route::post('add', [SlidersController::class, 'createProduct']);
            Route::get('list', [SlidersController::class, 'getProducts']);
            Route::get('edit/{slider}', [SlidersController::class, 'editFormProduct']);
            Route::post('edit/{slider}', [SlidersController::class, 'updateProduct']);
            Route::delete('delete', [SlidersController::class, 'delProduct']);
        });

        Route::post('upload/services', [UploadController::class, 'store']);
    });
  
});


