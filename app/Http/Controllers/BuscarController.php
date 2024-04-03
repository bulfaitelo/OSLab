<?php

namespace App\Http\Controllers;

use App\Models\Os\Os;
use Illuminate\Http\Request;

class BuscarController extends Controller
{
    public function index(Request $request) {

        $os = Os::indexTable($request, 10);
        return view('buscar', [
            'request' => $request,
            'os' => $os,
        ]);
    }
}
