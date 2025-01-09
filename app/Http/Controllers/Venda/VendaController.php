<?php

namespace App\Http\Controllers\Venda;

use App\Http\Controllers\Controller;
use App\Http\Requests\Venda\FaturarVendaRequest;
use App\Http\Requests\Venda\StoreVendaRequest;
use App\Http\Requests\Venda\UpdateVendaRequest;
use App\Models\Configuracao\Sistema\Emitente;
use App\Models\Venda\Venda;
use App\Services\Venda\VendaService;
use Barryvdh\DomPDF\Facade\Pdf;
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
        $emitente = Emitente::getHtmlEmitente(id: 1, venda_id: $venda->id);

        return view('venda.show', compact('venda', 'emitente'));
    }

    /**
     * Tela de impressão da Venda.
     */
    public function print(Venda $venda)
    {
        $emitente = Emitente::getHtmlEmitente(id: 1, venda_id: $venda->id);

        return view('venda.screen.print', compact('venda', 'emitente'));
    }

    /**
     * Tela de impressão da OS em PDF.
     */
    public function printPdf(Venda $venda)
    {
        $emitente = Emitente::getHtmlEmitente(id: 1, venda_id: $venda->id, pdf: true );
        // return view('venda.pdf.print', compact('os', 'emitente'));

        $pdf = Pdf::loadView('venda.pdf.print', compact('venda', 'emitente'));
        // $pdf->setWarnings(true);
        $pdf->setPaper('a4');
        // $css = asset('vendor/adminlte/dist/css/adminlte.min.css');

        return $pdf->stream('OSLab_Venda_'.$venda->id.'_'.$venda->cliente->titleName().'.pdf');
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
        try {
            if ($venda->conta_id) {
                return redirect()->route('venda.index')
                ->with('warning', 'Essa Venda já está faturada, cancele a fatura antes de exclui-la!');
            }
            $this->vendaService->destroy($venda);

            return redirect()->route('venda.index')
            ->with('success', 'Venda Excluida com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function faturar(FaturarVendaRequest $request, Venda $venda)
    {
        if (! getConfig('default_os_faturar_produto_despesa')) {
            return redirect()->route('venda.edit', $venda->id)
                    ->with('warning', 'Por favor vejas as configurações do sistema.');
        }

        if ($venda->conta_id) {
            return redirect()->route('venda.edit', $venda->id)
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
