<?php

namespace App\Http\Controllers;

use App\Models\Cliente\Cliente;
use App\Models\Produto\Produto;
use App\Models\Wiki\Wiki;
use App\Services\Os\OsService;
use App\Services\Venda\VendaService;
use Illuminate\Http\Request;

class BuscarController extends Controller
{
    public function index(Request $request)
    {
        $rowLimit = 5;

        $os = OsService::getDataTable($request, $rowLimit);
        $venda = VendaService::getDataTable($request, $rowLimit);
        $produtos = Produto::getDataTable($request, $rowLimit);
        $clientes = Cliente::getDataTable($request, $rowLimit);
        $wikis = Wiki::getDataTable($request, $rowLimit);

        return view('buscar', [
            'request' => $request,
            'os' => $os,
            'venda' => $venda,
            'produtos' => $produtos,
            'clientes' => $clientes,
            'wikis' => $wikis,
        ]);
    }
}
