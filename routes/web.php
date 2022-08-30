<?php

use Illuminate\Support\Facades\Route;

//use app\Http\Controllers\CategoryController;

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

Route::get('/admin', 'AdminController@loginAdmin');
Route::post('/admin', 'AdminController@postloginAdmin');

Route::get('user/{id}/{name}', function ($id, $name) {
    echo $id. "<br>";
    echo $name; exit;
})-> whereNumber('id')->whereAlpha('name');

Route::get('/home', function () {
    return view('home');
});






