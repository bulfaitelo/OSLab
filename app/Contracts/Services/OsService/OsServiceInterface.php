<?php

namespace App\Contracts\Services\OsService;

use App\Models\Os\Os;
use Illuminate\Http\Request;

interface OsServiceInterface {

    public function create(Request $request) : Os ;

}
