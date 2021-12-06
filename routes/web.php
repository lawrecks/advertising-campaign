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

$CampaignController = App\Http\Controllers\CampaignController::class;

Route::get('/', [$CampaignController, 'fetch'])->name('home');

Auth::routes();

Route::get('/home', [$CampaignController, 'fetch'])->name('home');
Route::get('/create', [$CampaignController, 'show_create'])->name('show_create');
Route::post('/create', [$CampaignController, 'store'])->name('create');
Route::get('/edit/{id}', [$CampaignController, 'show_edit'])->name('show_edit');
Route::post('/edit/{id}', [$CampaignController, 'edit'])->name('edit');
