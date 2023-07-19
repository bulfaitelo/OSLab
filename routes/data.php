<?php

use App\Http\Controllers\Checklist\ChecklistController;
use App\Http\Controllers\Cliente\ClienteController;
use App\Http\Controllers\Wiki\WikiController;
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




Route::group(['middleware'=> 'auth'], function() {

    Route::put('/wiki/text/{wiki}', [WikiController::class, 'textUpdate'])->name('wiki.text.update');
    Route::get('clientes', [ClienteController::class, 'apiClientSelect'])->name('cliente.select');


});
