<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/form/register', 'App\Http\Controllers\LimosaController@register')->name('form.register');

Route::post('/mail/create/', 'App\Http\Controllers\TestMailController@create')->name('mail.create');
