<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
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



# Home Controller
Route::get('/', [HomeController::class,'root']);
Route::get('/search',[HomeController::class,'search']);

# End Home Controller


# Auth Controller
Route::get('/login', [AuthController::class,'login'])->name('login');
Route::get('/register', [AuthController::class , 'register'])->name('register');

Route::post('/register',[AuthController::class , 'registerPost'] );
Route::post('/login' ,[AuthController::class , 'loginPost']);

# End Auth Controller


Route::middleware('auth')->group(function () {
    Route::get('/panel', function () {
            return view('panel.home');
        }
    )->name('panel');

    Route::get('/logout', [AuthController::class , 'logout'])->name('panel');
    Route::get('/item/{item}', function ($item){
        return view('panel.item',['item'=>$item]);
    })->name('item');
    Route::get('/store', function (){
        return view('panel.store');
    })->name('store');
    Route::get('/pay/{id}', function ($id){
        return view('panel.pay',['id'=>$id]);
    })->name('pay');

});
