<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\Users\LoginController;
use \App\Http\Controllers\Admin\MainController;
use \App\Http\Controllers\Admin\MenuController;


Route::get('admin/users/login', [LoginController::class,'index'])->name('login');
Route::post('admin/users/login/store', [LoginController::class,'store']);

//Check phan quyen Admin va Customer
Route::middleware(['auth'])->group(function (){

    Route::prefix('admin')->group(function (){
        Route::get('admin',[MainController::class,'index'])->name('admin') ;
        Route::get('admin/main',[MainController::class,'index']);

    #Menu
    Route::prefix('menus')->group(function (){
        Route::get('add',[MenuController::class, 'create']);
        Route::post('add',[MenuController::class, 'store']);

       });
    });
});













