<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\SlidersController;

use App\Http\Controllers\ProductController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/register', [AuthController::class, 'index'])->name('register')->defaults('title', 'register');
Route::post('/register/add', [AuthController::class, 'addUser']);
Route::get('/login', [AuthController::class, 'index'])->name('login')->defaults('title', 'login');
Route::post('/login/authentication', [AuthController::class, 'loginAuth']);

// when there isn't any corresponding url then fallback will be executed 
Route::fallback(function() {
    return '<b>404 Page Not Found!</b>';
})->name('error404');

// grouping routes and integrating middleware for those routes (including authentication and authorization)
Route::middleware(['web', 'auth'])->group(function() {
    Route::prefix('admin')->middleware(['admin'])->group(function() {
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

        #upload images
        Route::post('upload/services', [UploadController::class, 'store']);

        #cart
        Route::prefix('customers')->group(function() {
            Route::get('/', [\App\Http\Controllers\Admin\CartController::class, 'index']);
            Route::get('/view/{customer}', [\App\Http\Controllers\Admin\CartController::class, 'getOrders']);
            
        });
    });
});

Route::get('/', [MainController::class, 'index']);
Route::post('/services/load-products', [MainController::class, 'loadMoreProducts']);

Route::get('categories/{id}-{slug}.html', [CategoryController::class, 'index']);
Route::get('products/{id}-{slug}.html', [ProductController::class, 'index']);

Route::prefix('carts')->group(function() {
    Route::get('/', [CartController::class, 'show']);
    Route::post('add-product', [CartController::class, 'addProduct']);
    Route::post('add-cart', [CartController::class, 'addCart']);
    Route::post('update-cart', [CartController::class, 'updateCart']);
    Route::get('delete-product/{id}', [CartController::class, 'deleteProduct']);
});