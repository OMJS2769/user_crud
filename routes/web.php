<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticuloController;

Route::get('/', function () {
    return view('users');
})->name('/');


Auth::routes();

Route::get('articulos',function(){
   return view('articulos');
});
Route::apiresource('articulo',ArticuloController::class);




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('show_user/{id}',[\App\Http\Controllers\UserController::class,'show'])->name('show_user');
//