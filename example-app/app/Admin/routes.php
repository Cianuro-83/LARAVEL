<?php

use App\Admin\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use OpenAdmin\Admin\Facades\Admin;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => array_merge(['auth:sanctum'], config('admin.route.middleware')),
    'as'            => config('admin.route.prefix') . '.',
], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('users', UserController::class);
});