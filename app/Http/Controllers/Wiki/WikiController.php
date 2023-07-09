<?php

namespace App\Http\Controllers\Wiki;

use App\Http\Controllers\Controller;
use App\Http\Requests\Wiki\StoreWikiRequest;
use App\Http\Requests\Wiki\UpdateWikiRequest;
use App\Models\Wiki\Wiki;

class WikiController extends Controller
{
    function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:wiki', ['only'=> 'index']);
        $this->middleware('permission:wiki_create', ['only'=> ['create', 'store']]);
        $this->middleware('permission:wiki_show', ['only'=> 'show']);
        $this->middleware('permission:wiki_edit', ['only'=> ['edit', 'update']]);
        $this->middleware('permission:wiki_destroy', ['only'=> 'destroy']);

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wikis = Wiki::paginate(100);
        return view('wiki.index',compact('wikis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('wiki.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWikiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Wiki $wiki)
    {
        return view('wiki.show', compact('wiki'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wiki $wiki)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWikiRequest $request, Wiki $wiki)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wiki $wiki)
    {
        //
    }
}
