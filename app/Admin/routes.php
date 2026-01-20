<?php

use App\Admin\Controllers\AuthController;
use App\Admin\Controllers\ProductController;
use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('products', ProductController::class);

});

/**
 *  CUSTOM ROUTE LOGIN
 */
Route::group([
    'prefix'     => config('admin.route.prefix'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {
    Route::get('auth/login', [AuthController::class, 'getLogin'])->name('admin.login');
    Route::post('auth/login', [AuthController::class, 'postLogin']);
});

