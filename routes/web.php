<?php

use App\Http\Middleware\VerifyCaptcha;
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

Route::middleware([VerifyCaptcha::class])->group(function () {
    Route::post('/form/init/', 'App\Http\Controllers\FormController@init')->name('form.init');
});

Route::post('/form/company/', 'App\Http\Controllers\FormController@company')->name('form.company');
Route::post('/form/belgianCompany/', 'App\Http\Controllers\FormController@belgianCompany')->name('form.belgian_company');
Route::post('/form/register/', 'App\Http\Controllers\FormController@register')->name('form.register');
