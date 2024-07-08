<?php

use App\Http\Controllers\Cliente\ClienteController;
use App\Http\Controllers\Configuracao\User\UserController;
use App\Http\Controllers\Configuracao\Wiki\ModeloController;
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

Route::group(['middleware' => 'auth'], function () {
    Route::put('/wiki/text/{wiki}', [WikiController::class, 'textUpdate'])->name('wiki.text.update');
    Route::get('select_clientes', [ClienteController::class, 'apiClientSelect'])->name('cliente.select');
    Route::get('select_users', [UserController::class, 'apiUserSelect'])->name('user.select');
    Route::get('select_modelos', [ModeloController::class, 'apiModeloSelect'])->name('modelo.select');
    Route::get('select_produtos', [ProdutoController::class, 'apiProdutoSelect'])->name('produto.select');
    Route::get('select_servicos', [ServicoController::class, 'apiServicoSelect'])->name('servico.select');
});
