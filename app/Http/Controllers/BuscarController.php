<?php

namespace App\Http\Controllers;

use App\Models\Os\Os;
use App\Models\Produto\Produto;
use Illuminate\Http\Request;

class BuscarController extends Controller
{
    public function index(Request $request) {

        $rowLimit = 5;

        $os = Os::getDataTable($request, $rowLimit);
        $produtos = Produto::getDataTable($request, $rowLimit);
        return view('buscar', [
            'request' => $request,
            'os' => $os,
            'produtos' => $produtos,
        ]);
    }
}
