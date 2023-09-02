<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\MainController;

use App\Http\Controllers\Admin\AdminController;
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
        Route::get('/', [AdminController::class, 'index'])->name('adminLogin');

        // Categories
        Route::prefix('categories')->group(function() {
            Route::get('/', [CategoriesController::class, 'getCategories']);
            Route::get('list', [CategoriesController::class, 'getCategories']);
            Route::get('add', [CategoriesController::class, 'renderFormCategory']);
            Route::post('add', [CategoriesController::class, 'createCategory']);
            Route::get('edit/{category}', [CategoriesController::class, 'editFormCategory']);
            Route::post('edit/{category}', [CategoriesController::class, 'updateCategory']);
            Route::delete('delete', [CategoriesController::class, 'delCategory']);
        });

        // Products
        Route::prefix('products')->group(function() {
            Route::get('/', [ProductsController::class, 'getProducts']);
            Route::get('list', [ProductsController::class, 'getProducts']);
            Route::get('add', [ProductsController::class, 'renderFormProduct']);
            Route::post('add', [ProductsController::class, 'createProduct']);
            Route::get('edit/{product}', [ProductsController::class, 'editFormProduct']);
            Route::post('edit/{product}', [ProductsController::class, 'updateProduct']);
            Route::delete('delete', [ProductsController::class, 'delProduct']);
        });

        // Carousel/Slider/Banner
        Route::prefix('sliders')->group(function() {
            Route::get('add', [SlidersController::class, 'renderFormSlider']);
            Route::post('add', [SlidersController::class, 'createSlider']);
            Route::get('list', [SlidersController::class, 'getSliders']);
            Route::get('edit/{slider}', [SlidersController::class, 'editFormSlider']);
            Route::post('edit/{slider}', [SlidersController::class, 'updateSlider']);
            Route::delete('delete', [SlidersController::class, 'delSlider']);
        });

        Route::post('upload/services', [UploadController::class, 'store']);
    });
});

Route::get('/', [MainController::class, 'index']);


