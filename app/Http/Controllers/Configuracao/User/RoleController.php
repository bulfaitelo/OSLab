<?php

namespace App\Http\Controllers\Configuracao\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Configuracao\User\PermissionsGroup;

class RoleController extends Controller
{

    function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:config_roles', ['only'=> 'index']);
        $this->middleware('permission:config_roles_create', ['only'=> ['create', 'store']]);
        $this->middleware('permission:config_roles_show', ['only'=> 'show']);
        $this->middleware('permission:config_roles_edit', ['only'=> ['edit', 'update']]);
        $this->middleware('permission:config_roles_assign', ['only'=> ['assign', 'assign_update']]);
        $this->middleware('permission:config_roles_destroy', ['only'=> 'destroy']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('name', 'ASC')
        ->get();
        return view('configuracao.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('configuracao.roles.create');

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
            'name' => 'required|alpha_dash|unique:roles'
        ]);
        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description
            ]);
        if($role) {
            return redirect()->route('configuracao.roles.index')->with('success', 'Perfil cadastrado com Sucesso!'); ;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('configuracao.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $request->validate ([
            'name' => 'required|alpha_dash|unique:permissions,name,'.$role->id,
        ]);
        $role->name = $request->name;
        $role->description = $request->description;
        if($role->save()){
            return redirect()->route('configuracao.roles.edit', [$id])->with('success', 'Perfil atualizada!'); ;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        if($role) {
            return redirect()->route('configuracao.roles.index')->with('success', 'Perfil Excluida com Sucesso!'); ;
        }
    }

    /**
     * update permissions on role;
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function assign($id) {

        $role = Role::findOrFail($id);
        $group = PermissionsGroup::class;
        $permissions = Permission::class;
        $array_temp = $role->permissions;
        foreach ($array_temp as $key => $value) {
            $array_permissions[] = $value['id'];
        }
        // Gambi pratica!
        if (!is_array($array_temp)) {
            $array_permissions[] = 0;
        }
        $groups = Permission::select('permissions.group_id', 'permissions_group.name')
            ->orderby('permissions_group.name')
            ->join('permissions_group', 'permissions_group.id', '=', 'permissions.group_id')
            ->distinct()
            ->get();
        return view('configuracao.roles.assign', compact('role', 'array_permissions', 'permissions', 'group', 'groups'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function assign_update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $request->validate ([
            'assign_id' => 'required|array'
            ]);

        $role->syncPermissions($request->assign_id);
        return redirect()->route('configuracao.roles.assign', [$id])->with('success', 'Permissões Atualizadas!');

    }



}
