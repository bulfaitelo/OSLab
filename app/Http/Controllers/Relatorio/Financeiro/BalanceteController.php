<?php

namespace App\Http\Controllers\Relatorio\Financeiro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BalanceteController extends Controller
{
    function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:relatorio_financeiro_balancete', ['only'=> ['index']]);

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('relatorio.financeiro.balancete.index');
    }

}
