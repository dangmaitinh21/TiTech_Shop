<?php

use App\Http\Controllers\Admin\CategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Login\MainController;

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
        Route::prefix('categories')->group(function() {
            Route::get('add', [CategoriesController::class, 'renderFormCategory']);
            Route::post('add', [CategoriesController::class, 'createCategory']);
            Route::get('list', [CategoriesController::class, 'getCategories']);
            Route::get('edit/{category}', [CategoriesController::class, 'editFormCategory']);
            Route::put('edit/{category}', [CategoriesController::class, 'updateCategory']);
            Route::delete('delete', [CategoriesController::class, 'delCategory']);
        });
    });
});


