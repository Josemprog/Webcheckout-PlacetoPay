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

Route::get('/', 'PaymentController@index')->name('payment.index');
Route::post('payment', 'PaymentController@pay')->name('payment.pay');

 Route::post('payment/{payment}', 'PaymentController@retry')->name('payment.retry');
