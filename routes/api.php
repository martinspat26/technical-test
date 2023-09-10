<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes    
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post(
    '/tokens/create',
    'App\Http\Controllers\TokenController@create'
)->name('login');

Route::middleware('auth:sanctum')->delete(
    '/tokens/delete',
    'App\Http\Controllers\TokenController@delete'
)->name('logout');

Route::middleware('auth:sanctum')->get(
    '/dashboard',
    'App\Http\Controllers\DashboardController@index'
)->name('dashboard.index');
