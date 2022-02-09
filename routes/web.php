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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/form', [App\Http\Controllers\DynamicForm::class, 'index'])->name('form');
Route::group(['middleware' => ['admin']], function () {
    Route::get('/form-create', [App\Http\Controllers\DynamicForm::class, 'create'])->name('formCreate');
    Route::post('/form-create', [App\Http\Controllers\DynamicForm::class, 'Store'])->name('formStore');
    Route::get('/form/{id}/edit', [App\Http\Controllers\DynamicForm::class, 'edit'])->name('formEdit');
    Route::put('/form/{id}/update', [App\Http\Controllers\DynamicForm::class, 'update'])->name('formUpdate');
    Route::get('/form/{id}/delete', [App\Http\Controllers\DynamicForm::class, 'destroy'])->name('formDelete');
    Route::get('/form/{id}/show', [App\Http\Controllers\DynamicForm::class, 'show'])->name('formShow');
});
Route::get('/form', [App\Http\Controllers\DynamicForm::class, 'index'])->name('formindex');
