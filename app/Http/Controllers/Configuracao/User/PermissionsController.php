<?php

namespace App\Http\Controllers\Configuracao\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Configuracao\User\PermissionsGroup;


class PermissionsController extends Controller
{
    public function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:config_permissions', ['only' => 'index']);
        $this->middleware('permission:config_permissions_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:config_permissions_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:config_permissions_destroy', ['only' => 'destroy']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $permissions = Permission::orderBy('name', 'ASC')
        ->paginate('30');
        $group = PermissionsGroup::class;
        return view('configuracao.users.roles.permissions.index', compact('permissions', 'group'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('configuracao.users.roles.permissions.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate ([
            'name' => 'required|alpha_dash|unique:permissions',
            'group' => 'required|integer',
        ]);
        $permission = Permission::create([
            'name' => $request->name,
            'description' => $request->description,
            'group_id' => $request->group
            ]);
        if($permission) {
            return redirect()->route('configuracao.permissions.index')
            ->with('success', 'Permissão cadastrada com Sucesso!'); ;
        }
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('configuracao.users.roles.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate ([
            'name' => 'required|alpha_dash|unique:permissions,name,'.$permission->id,
            'group' => 'required|integer',
        ]);
        $permission->name = $request->name;
        $permission->description = $request->description;
        $permission->group_id = $request->group;
        if($permission->save()){
            return redirect()->route('configuracao.permissions.edit', $permission->id)
            ->with('success', 'Permissão atualizada!'); ;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        if($permission) {
            return redirect()->route('configuracao.permissions.index')
            ->with('success', 'Permissão Excluida com Sucesso!'); ;
        }

    }
}
