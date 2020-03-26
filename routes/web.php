<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PagesController@root')->name('root');
Route::get('coach', 'CoachsController@index')->name('coach.index');
Route::get('coach', 'CoachsController@index')
    ->name('coach.index');
Route::get('articles', 'ArticlesController@index')
    ->name('articles.index');
Route::get('cars', 'ArticlesController@car')
    ->name('articles.car');
Route::get('articles/{articles}', 'ArticlesController@show')
    ->name('articles.show');
Auth::routes();
Route::group(['middleware' => ['auth', 'verified']], function() {
    Route::get('welcome', 'PagesController@welcome')->name('pages.welcome');
    Route::get('bookings', 'BookingsController@index')
        ->name('bookings.index');
    Route::get('bookings/create','BookingsController@create')
        ->name('bookings.create');
    Route::post('bookings', 'BookingsController@store')
        ->name('bookings.store');
    Route::get('bookings/{bookings}', 'BookingsController@edit')
        ->name('bookings.edit');
    Route::put('bookings/{bookings}', 'BookingsController@update')
        ->name('bookings.update');
    Route::delete('bookings/{bookings}', 'BookingsController@destroy')
        ->name('bookings.destroy');
    Route::post('coach', 'coachsController@store')
        ->name('coach.store');
    Route::get('coach/{coach}', 'CoachsController@show')
        ->name('coach.show');
    Route::get('contacts', 'ContactsController@index')
        ->name('contact.index');
    Route::get('contacts/create','ContactsController@create')
        ->name('contact.create');
    Route::post('contacts', 'ContactsController@store')
        ->name('contact.store');
    Route::get('contacts/{contacts}', 'ContactsController@edit')
        ->name('contact.edit');
    Route::get('owns', 'OwnsController@index')
        ->name('own.index');
});
