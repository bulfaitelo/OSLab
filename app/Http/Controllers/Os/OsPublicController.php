<?php

namespace App\Http\Controllers\Os;

use App\Http\Controllers\Controller;
use App\Models\Os\Os;
use App\Models\Os\OsInformacao;
use Illuminate\Http\Request;

class OsPublicController extends Controller
{
    public function edit($uuid){
        $informacao = OsInformacao::where("uuid",$uuid)->firstOrfail();

        return view("os.public.edit",compact("informacao"));
    }
}
