<?php

use App\Http\Controllers\Checklist\ChecklistController;
use App\Http\Controllers\Cliente\ClienteController;
use App\Http\Controllers\Configuracao\Backup\BackupController;
use App\Http\Controllers\Configuracao\Emitente\EmitenteController;
use App\Http\Controllers\Configuracao\Financeiro\CentroCustoController;
use App\Http\Controllers\Configuracao\Financeiro\FormaPagamentoController;
use App\Http\Controllers\Configuracao\Garantia\GarantiaController;
use App\Http\Controllers\Configuracao\Parametro\CategoriaController;
use App\Http\Controllers\Configuracao\Parametro\StatusController;
use App\Http\Controllers\Configuracao\Sistema\SistemaConfigController;
use App\Http\Controllers\Configuracao\User\PerfilController;
use App\Http\Controllers\Configuracao\User\PermissionsController;
use App\Http\Controllers\Configuracao\User\RoleController;
use App\Http\Controllers\Configuracao\User\SetorController;
use App\Http\Controllers\Configuracao\User\UserController;
use App\Http\Controllers\Configuracao\Wiki\FabricanteController;
use App\Http\Controllers\Configuracao\Wiki\ModeloController;
use App\Http\Controllers\Financeiro\DespesaController;
use App\Http\Controllers\Financeiro\DespesaPagamentoController;
use App\Http\Controllers\Financeiro\MetaContabilController;
use App\Http\Controllers\Financeiro\ReceitaController;
use App\Http\Controllers\Financeiro\ReceitaPagamentoController;
use App\Http\Controllers\Os\OsController;
use App\Http\Controllers\Os\OsPublicController;
use App\Http\Controllers\OsLab\FavoriteController;
use App\Http\Controllers\Produto\MovimentacaoController;
use App\Http\Controllers\Produto\ProdutoController;
use App\Http\Controllers\Relatorio\Financeiro\BalanceteController;
use App\Http\Controllers\Relatorio\Financeiro\ContaAbertaController;
use App\Http\Controllers\Relatorio\Financeiro\ReceitaDespesaController;
use App\Http\Controllers\Servico\ServicoController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Venda\VendaController;
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
    if (! Auth::guest()) {
        return redirect('/home');
    } else {
        return redirect()->route('login');
    }
});

Route::get('/live-test', function () {
    return view('teste');
})->name('teste');

route::resource('teste', TestController::class);

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/buscar', [App\Http\Controllers\BuscarController::class, 'index'])->name('buscar');

    Route::resource('/cliente', ClienteController::class);
    Route::resource('/servico', ServicoController::class);

    Route::resource('/produto', ProdutoController::class);
    Route::resource('/produto/{produto}/movimentacao', MovimentacaoController::class);

    // Financeiro
    Route::name('financeiro.')->prefix('financeiro')->group(function () {
        Route::resource('/despesa', DespesaController::class);
        Route::put('/despesa/{despesa}/pagamento/{pagamento}', [DespesaPagamentoController::class, 'update'])->name('despesa.pagamento.update');
        Route::post('/despesa/{despesa}/pagamento/', [DespesaPagamentoController::class, 'store'])->name('despesa.pagamento.store');
        Route::delete('/despesa/{despesa}/pagamento/{pagamento}', [DespesaPagamentoController::class, 'destroy'])->name('despesa.pagamento.destroy');

        Route::resource('/receita', ReceitaController::class)
            ->parameters(['receita' => 'receita']);
        Route::put('/receita/{receita}/pagamento/{pagamento}', [ReceitaPagamentoController::class, 'update'])->name('receita.pagamento.update');
        Route::post('/receita/{receita}/pagamento/', [ReceitaPagamentoController::class, 'store'])->name('receita.pagamento.store');
        Route::delete('/receita/{receita}/pagamento/{pagamento}', [ReceitaPagamentoController::class, 'destroy'])->name('receita.pagamento.destroy');

        Route::resource('/meta_contabil', MetaContabilController::class);
    });

    // Ordem de Serviço
    Route::resource('/os', OsController::class)
        ->parameters(['os' => 'os']);
    Route::put('/os/{os}/faturar', [OsController::class, 'faturar'])
        ->name('os.faturar');
    Route::delete('/os/{os}/cancelar-faturar', [OsController::class, 'cancelarFaturamento'])
        ->name('os.cancelar-faturar');
    Route::get('os/{os}/despesa/create/', [DespesaController::class, 'create'])
        ->name('os.despesa.create');
    Route::get('/os/{os}/print', [OsController::class, 'print'])
        ->name('os.print');
    Route::get('/os/{os}/print_pdf', [OsController::class, 'printPdf'])
        ->name('os.print_pdf');

    // Vendas
    Route::resource('/venda', VendaController::class);
    Route::put('/venda/{venda}/faturar', [VendaController::class, 'faturar'])
        ->name('venda.faturar');
    Route::delete('/venda/{venda}/cancelar-faturar', [VendaController::class, 'cancelarFaturamento'])
        ->name('venda.cancelar-faturar');
    Route::get('venda/{venda}/despesa/create/', [DespesaController::class, 'create'])
        ->name('venda.despesa.create');
    Route::get('/venda/{venda}/print', [VendaController::class, 'print'])
        ->name('venda.print');
    Route::get('/venda/{venda}/print_pdf', [VendaController::class, 'printPdf'])
        ->name('venda.print_pdf');

    Route::resource('/wiki', WikiController::class);
    Route::post('/wiki/link/{wiki}', [WikiController::class, 'linkCreate'])->name('wiki.link.create');
    Route::delete('/wiki/link/{wiki}/{link}', [WikiController::class, 'linkDestroy'])->name('wiki.link.destroy');
    Route::post('/wiki/file/{wiki}', [WikiController::class, 'fileCreate'])->name('wiki.file.create');
    Route::delete('/wiki/file/{wiki}/{file}', [WikiController::class, 'fileDestroy'])->name('wiki.file.destroy');

    Route::resource('/checklist', ChecklistController::class);
    // Route::get('/wiki/link/{wiki}', [WikiController::class, 'linkGet'])->name('wiki.link.get');

    // Agrupamento de rotas de Relatório
    Route::name('relatorio.')->prefix('relatorio')->group(function () {
        // Financeiro
        Route::name('financeiro.')->prefix('financeiro')->group(function () {
            Route::get('/balancete', [BalanceteController::class, 'index'])->name('balancete.index');
            Route::get('/despesa', [ReceitaDespesaController::class, 'index'])->name('despesa.index');
            Route::get('/conta_aberta', [ContaAbertaController::class, 'index'])->name('conta_aberta.index');
        });

        // // OS
        // Route::name('os.')->prefix('os')->group( function () {

        // });
        // Route::name('wiki.')->prefix('wiki')->group( function () {

        // });
    });

    // Agrupamento de rotas de Configuração
    Route::name('configuracao.')->prefix('configuracoes')->group(function () {
        Route::resource('/users', UserController::class);
        Route::resource('/roles', RoleController::class);
        Route::resource('/permissions', PermissionsController::class);
        Route::get('/roles/assign/{role}', [RoleController::class, 'assign'])->name('roles.assign');
        Route::put('/roles/assign/{role}', [RoleController::class, 'assign_update'])->name('roles.assign.update');
        Route::get('/users/permissions/{user}', [UserController::class, 'permissions_edit'])->name('users.permissions_edit');
        Route::put('/users/permissions/{user}', [UserController::class, 'permissions_update'])->name('users.permissions.update');

        // Parâmetros
        Route::name('parametro.')->prefix('parametro')->group(function () {
            Route::resource('/categoria', CategoriaController::class)
                ->parameters(['categoria' => 'categoria']);
            Route::resource('/status', StatusController::class);
        });
        // Configurações de usuário
        Route::name('user.')->prefix('user')->group(function () {
            Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil.index');
            Route::get('/perfil/edit', [PerfilController::class, 'edit'])->name('perfil.edit');
            Route::put('/perfil/update', [PerfilController::class, 'update'])->name('perfil.update');
            Route::resource('/setor', SetorController::class);
        });
        // Financeiro
        Route::name('financeiro.')->prefix('financeiro')->group(function () {
            Route::resource('/centro_custo', CentroCustoController::class);
            Route::resource('/forma_pagamento', FormaPagamentoController::class);
        });

        // Wiki
        Route::name('wiki.')->prefix('wiki')->group(function () {
            Route::resource('/fabricante', FabricanteController::class);
            Route::resource('/modelo', ModeloController::class);
        });
        // Garantia
        Route::resource('/garantia', GarantiaController::class)
            ->parameters(['garantia' => 'garantia']);
        // Sistema
        Route::resource('/sistema', SistemaConfigController::class)->only([
            'index', 'store',
        ]);
        // Emitente
        Route::resource('emitente', EmitenteController::class);
        // Backup
        // Route::resource('backup', BackupController::class);
        Route::get('backup', [BackupController::class, 'index'])->name('backup.index');
        Route::post('backup/download', [BackupController::class, 'download'])->name('backup.download');
        Route::post('backup/destroy', [BackupController::class, 'destroy'])->name('backup.delete');
    });

    Route::get('favorite/{routeName}', [FavoriteController::class, 'favoriteToggle'])->name('favorite.toggle');
});

// OS >> informações (publica)
Route::get('public/os/informacao/{uuid}', [OsPublicController::class, 'edit'])->name('os.public.edit');
Route::get('public/os/informacao', [OsPublicController::class, 'updated'])->name('os.public.updated');
Route::put('public/os/informacao/{uuid}', [OsPublicController::class, 'update'])->name('os.public.update');
