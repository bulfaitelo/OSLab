<?php

use App\Http\Controllers\Checklist\ChecklistController;
use App\Http\Controllers\Cliente\ClienteController;
use App\Http\Controllers\Configuracao\Financeiro\CentroCustoController;
use App\Http\Controllers\Configuracao\Os\GarantiaController;
use App\Http\Controllers\Configuracao\Os\CategoriaOsController;
use App\Http\Controllers\Configuracao\Os\StatusOsController;
use App\Http\Controllers\Configuracao\User\PerfilController;
use App\Http\Controllers\Configuracao\User\PermissionsController;
use App\Http\Controllers\Configuracao\User\RoleController;
use App\Http\Controllers\Configuracao\User\SetorController;
use App\Http\Controllers\Configuracao\User\UserController;
use App\Http\Controllers\Configuracao\Wiki\FabricanteController;
use App\Http\Controllers\Configuracao\Wiki\ModeloController;
use App\Http\Controllers\Produto\MovimentacaoController;
use App\Http\Controllers\Produto\ProdutoController;
use App\Http\Controllers\Servico\ServicoController;
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

Route::get('/', function () {
    if(!Auth::guest()){
		return redirect('/home');
	} else {
		return redirect()->route('login');
	}
});

Auth::routes();

Route::group(['middleware'=> 'auth'], function() {
    Route::resource('/cliente', ClienteController::class);
    Route::resource('/servico', ServicoController::class);
    Route::resource('/produto', ProdutoController::class);
    Route::resource('/produto/{produto}/movimentacao', MovimentacaoController::class);

    Route::resource('/wiki', WikiController::class);
    Route::post('/wiki/link/{wiki}', [WikiController::class, 'linkCreate'])->name('wiki.link.create');
    Route::delete('/wiki/link/{wiki}/{link}', [WikiController::class, 'linkDestroy'])->name('wiki.link.destroy');
    Route::post('/wiki/file/{wiki}', [WikiController::class, 'fileCreate'])->name('wiki.file.create');
    Route::delete('/wiki/file/{wiki}/{file}', [WikiController::class, 'fileDestroy'])->name('wiki.file.destroy');

    Route::resource('/checklist', ChecklistController::class);
    // Route::get('/wiki/link/{wiki}', [WikiController::class, 'linkGet'])->name('wiki.link.get');

    // Agrupamento de rotas de Configuração
    Route::name('configuracao.')->prefix('configuracoes')->group( function (){
        Route::resource('/users', UserController::class);
        Route::resource('/roles', RoleController::class);
        Route::resource('/permissions', PermissionsController::class);
        Route::get('/roles/assign/{role}', [RoleController::class, 'assign'])->name('roles.assign');
        Route::put('/roles/assign/{role}', [RoleController::class, 'assign_update'])->name('roles.assign.update');
        Route::get('/users/permissions/{user}', [UserController::class, 'permissions_edit'])->name('users.permissions_edit');
        Route::put('/users/permissions/{user}', [UserController::class, 'permissions_update'])->name('users.permissions.update');
        // Configurações de usuário
        Route::name('user.')->prefix('user')->group( function (){
            Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil.index');
            Route::get('/perfil/edit', [PerfilController::class, 'edit'])->name('perfil.edit');
            Route::put('/perfil/update', [PerfilController::class, 'update'])->name('perfil.update');
            Route::resource('/setor', SetorController::class);
        });
        // Financeiro
        Route::name('financeiro.')->prefix('financeiro')->group( function (){
            Route::resource('/centro_custo', CentroCustoController::class);
        });
        // OS
        Route::name('os.')->prefix('os')->group( function (){
            Route::resource('/garantia', GarantiaController::class)
                ->parameters(['garantia' => 'garantia']);
            Route::resource('/categoria', CategoriaOsController::class)
                ->parameters(['categoria' => 'categoria']);
            Route::resource('/status', StatusOsController::class);
        });
        Route::name('wiki.')->prefix('wiki')->group( function (){
            Route::resource('/fabricante', FabricanteController::class);
            Route::resource('/modelo', ModeloController::class);


        });


    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

