<?php

namespace App\Http\Controllers\Os;

use App\Http\Controllers\Controller;
use App\Http\Requests\Os\StoreOsRequest;
use App\Http\Requests\Os\UpdateOsRequest;
use App\Models\Os\Os;

class OsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('os.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Os $os)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Os $os)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOsRequest $request, Os $os)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Os $os)
    {
        //
    }
}
