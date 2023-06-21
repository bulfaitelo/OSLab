<?php

use App\Http\Controllers\Configuracao\Financeiro\CentroCustoController;
use App\Http\Controllers\Configuracao\Os\GarantiaController;
use App\Http\Controllers\Configuracao\User\PerfilController;
use App\Http\Controllers\Configuracao\User\PermissionsController;
use App\Http\Controllers\Configuracao\User\RoleController;
use App\Http\Controllers\Configuracao\User\SetorController;
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
    if(!Auth::guest()){
		return redirect('/home');
	} else {
		return redirect()->route('login');
	}
});

Auth::routes();

Route::group(['middleware'=> 'auth'], function() {
    // Agrupamento de rotas de Configuração
    Route::name('configuracao.')->prefix('configuracoes')->group(function (){
        Route::resource('/users', UserController::class);
        Route::resource('/roles', RoleController::class);
        Route::get('/roles/assign/{id}', [RoleController::class, 'assign'])->name('roles.assign');
        Route::put('/roles/assign/{id}', [RoleController::class, 'assign_update'])->name('roles.assign.update');
        Route::get('/users/permissions/{id}', [UserController::class, 'permissions_edit'])->name('users.permissions_edit');
        Route::put('/users/permissions/{id}', [UserController::class, 'permissions_update'])->name('users.permissions.update');
        Route::resource('/permissions', PermissionsController::class);
        // Configurações de usuário
        Route::name('user.')->prefix('user')->group(function (){
            Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil.index');
            Route::get('/perfil/edit', [PerfilController::class, 'edit'])->name('perfil.edit');
            Route::put('/perfil/update', [PerfilController::class, 'update'])->name('perfil.update');
            Route::resource('/setor', SetorController::class);
        });
        // Financeiro
        Route::name('financeiro.')->prefix('financeiro')->group(function (){
            Route::resource('/centro_custo', CentroCustoController::class);
        });
        // OS
        Route::name('os.')->prefix('os')->group(function (){
            Route::resource('/garantia', GarantiaController::class)
                 ->parameters(['garantia' => 'garantia']);
        });


    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
