<?php

namespace App\Http\Controllers\Venda;

use App\Http\Controllers\Controller;
use App\Http\Requests\Venda\FaturarVendaRequest;
use App\Http\Requests\Venda\StoreVendaRequest;
use App\Http\Requests\Venda\UpdateVendaRequest;
use App\Models\Venda\Venda;
use App\Services\Venda\VendaService;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    public function __construct(
        private readonly ?VendaService $vendaService = null
    ) {
        // ACL DE PERMISSÕES
        $this->middleware('permission:venda', ['only' => ['index']]);
        $this->middleware('permission:venda_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:venda_show', ['only' => ['show', 'print', 'printPdf']]);
        $this->middleware('permission:venda_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:venda_destroy', ['only' => 'destroy']);
        $this->middleware('permission:venda_faturar', ['only' => 'faturar']);
        $this->middleware('permission:venda_cancelar_faturar', ['only' => 'cancelarFaturamento']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $vendas = $this->vendaService::getDataTable($request);

        return view('venda.index', compact('vendas', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('venda.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVendaRequest $request)
    {
        $venda = $this->vendaService->store($request);

        return redirect()->route('venda.edit', $venda->id)
                ->with('success', 'Venda cadastrada com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Venda $venda)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function print(Venda $venda)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function printPdf(Venda $venda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venda $venda)
    {
        return view('venda.edit', compact('venda'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVendaRequest $request, Venda $venda)
    {
        $venda = $this->vendaService->update($request, $venda);

        return redirect()->route('venda.edit', $venda->id)
        ->with('success', 'Venda Atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venda $venda)
    {
        //
    }

    public function faturar(FaturarVendaRequest $request, Venda $venda)
    {
        if (! getConfig('default_os_faturar_produto_despesa')) {
            return redirect()->route('os.edit', $venda->id)
                    ->with('warning', 'Por favor vejas as configurações do sistema.');
        }

        if ($venda->conta_id) {
            return redirect()->route('os.edit', $venda->id)
                    ->with('warning', 'Esta Ordem de Serviço já está faturada.');
        }

        $this->vendaService->faturar($request, $venda);

        return redirect()->route('venda.edit', $venda->id)
        ->with('success', 'Venda Faturada com sucesso.');
    }

    /**
     * Cancela o faturamento da venda.
     *
     * @param  Venda  $venda
     */
    public function cancelarFaturamento(Venda $venda)
    {
        $this->vendaService->cancelarFaturamento($venda);

        return redirect()->route('venda.edit', $venda->id)
            ->with('success', 'Fatura cancelada com sucesso.');
    }
}
