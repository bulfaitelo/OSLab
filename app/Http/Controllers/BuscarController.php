<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BuscarController extends Controller
{
    public function index(Request $request) {
        // dd($request->all());
        return view('buscar');
    }
}
