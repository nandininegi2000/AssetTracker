<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Myadmin;
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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/dashboard',[Myadmin::class,'dashboard']);
Route::get('list',[Myadmin::class,'show'])->middleware('sample');
Route::get('delete/{id}',[Myadmin::class,'delete']);
Route::get('edit/{id}',[Myadmin::class,'showData']);
Route::post('edit/',[Myadmin::class,'update']);
Route::view('add','admin.createtype');
Route::post('insert',[Myadmin::class,'insert']);
Route::view('add','admin.createtype');
Route::get('assetlist',[Myadmin::class,'showasset']);
Route::get('addasset',[Myadmin::class,'addasset']);
Route::post('insertasset',[Myadmin::class,'insertasset']);
Route::get('deleteasset/{id}',[Myadmin::class,'deleteasset']);
Route::get('editasset/{id}',[Myadmin::class,'showassetData']);
Route::get('images/{id}',[Myadmin::class,'showimg']);
Route::post('editasset/',[Myadmin::class,'updateasset']);
Route::get('download', [Myadmin::class,'exportCsv']);
Route::get('piechart', [Myadmin::class,'piechart']);
Route::get('barchart', [Myadmin::class,'barchart']);
Route::view('nodata','admin.nodata');