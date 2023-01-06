<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
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

Route::get('/', function () {

   return view('home');
});




Route::get('/login', [AuthController::class,'login']);
Route::get('/register', [AuthController::class , 'register']);

Route::post('/register',[AuthController::class , 'registerPost'] );
Route::post('/login' ,[AuthController::class , 'loginPost']);





Route::get('/serve',function () {
    dd($_SERVER);
});
