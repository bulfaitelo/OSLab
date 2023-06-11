<?php

use App\Http\Controllers\Configuracao\User\PerfilController;
use App\Http\Controllers\Configuracao\User\PermissionsController;
use App\Http\Controllers\Configuracao\User\RoleController;
use App\Http\Controllers\Configuracao\User\UserController;
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

Auth::routes();

Route::group(['middleware'=> 'auth'], function() {
    // Agrupamento de rotas de Configuração
    Route::name('configuracoes.')->prefix('configuracoes')->group(function (){
        Route::resource('/roles', RoleController::class);
        Route::get('/roles/assign/{id}', [RoleController::class, 'assign'])->name('roles.assign');
        Route::put('/roles/assign/{id}', [RoleController::class, 'assign_update'])->name('roles.assign.update');
        Route::resource('/users', UserController::class);
        Route::get('/users/permissions/{id}', [UserController::class, 'permissions'])->name('users.permissions');
        Route::put('/users/permissions/{id}', [UserController::class, 'permissions_update'])->name('users.permissions.update');
        Route::resource('/permissions', PermissionsController::class);
        // Configurações de usuario
        Route::name('user.')->prefix('user')->group(function (){
            Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil.index');
            Route::get('/perfil/edit', [PerfilController::class, 'edit'])->name('perfil.edit');
            Route::put('/perfil/update', [PerfilController::class, 'update'])->name('perfil.update');


        });


    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
