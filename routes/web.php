<?php

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
    return view('panel.home.index');
});


$panelUploadPeople = '\App\Http\Controllers\Panel\PeoplesUploadController';
Route::get('upload-peoples', ['uses' => $panelUploadPeople .'@index'])->name('panel.upload-peoples.index'); 
Route::get('upload-peoples/create', ['uses' => $panelUploadPeople .'@create'])->name('panel.upload-peoples.create'); 
Route::post('upload-peoples/store', ['uses' => $panelUploadPeople .'@store'])->name('panel.upload-peoples.store'); 
Route::get('upload-peoples/destroy/{id}', ['uses' => $panelUploadPeople .'@destroy'])->name('panel.upload-peoples.destroy'); 


$panelUploadShiporder = '\App\Http\Controllers\Panel\ShipordersUploadController';
Route::get('upload-shiporders', ['uses' => $panelUploadShiporder .'@index'])->name('panel.upload-shiporders.index'); 
Route::get('upload-shiporders/create', ['uses' => $panelUploadShiporder .'@create'])->name('panel.upload-shiporders.create'); 
Route::post('upload-shiporders/store', ['uses' => $panelUploadShiporder .'@store'])->name('panel.upload-shiporders.store'); 
Route::get('upload-shiporders/destroy/{id}', ['uses' => $panelUploadShiporder .'@destroy'])->name('panel.upload-shiporders.destroy'); 