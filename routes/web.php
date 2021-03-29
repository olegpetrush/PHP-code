<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register'=>false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('foods', 'FoodController');
Route::resource('effects', 'EffectController');
Route::resource('nutrients', 'NutrientController');
Route::resource('nutrient_limits', 'NutrientLimitController');
Route::resource('nutrient_rdas', 'NutrientRdaController');
Route::resource('products','ProductController');
