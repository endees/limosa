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

Route::get('/', 'App\Http\Controllers\FormController@welcome')->name('form.welcome');

Route::middleware([VerifyCaptcha::class])->group(function () {
    Route::post('/form/init/', 'App\Http\Controllers\FormController@init')->name('form.init');
});

Route::post('/form/company/', 'App\Http\Controllers\FormController@company')->name('form.company');
Route::post('/form/belgianCompany/', 'App\Http\Controllers\FormController@belgianCompany')->name('form.belgian_company');
Route::post('/form/worksites/', 'App\Http\Controllers\FormController@workSite')->name('form.work_site');
Route::post('/form/register/', 'App\Http\Controllers\FormController@register')->name('form.register');
Route::get('/form/success/', 'App\Http\Controllers\FormController@success')->name('form.success');
