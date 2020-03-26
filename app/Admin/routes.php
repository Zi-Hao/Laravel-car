<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->resource('users', UsersController::class);
    $router->resource('coaches', CoachesController::class);
    $router->resource('bookings', BookingsController::class);
    $router->resource('students', StudentsController::class);
    $router->resource('contacts', ContactsController::class);
    $router->resource('articles', ArticlesController::class);
    $router->resource('images', ImagesController::class);
    $router->resource('links', LinksController::class);
});
