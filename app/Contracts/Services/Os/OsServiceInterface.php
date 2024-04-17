<?php

namespace App\Contracts\Services\Os;

use App\Models\Os\Os;
use Illuminate\Http\Request;

interface OsServiceInterface {

    public function create(Request $request) : Os ;

}
