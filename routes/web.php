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
    return redirect(route('employes.index'));
});

Route::prefix('employes')->group(function (){
    Route::get('/', ['as' => 'employes.index', 'uses' => '\App\Http\Controllers\EmployesController@index']);
    Route::get('/{department}', ['as' => 'employes.department', 'uses' => '\App\Http\Controllers\EmployesController@department']);
    Route::post('/import', ['as' => 'employes.import', 'uses' => '\App\Http\Controllers\EmployesController@import']);
});
