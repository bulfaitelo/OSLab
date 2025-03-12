<?php

namespace App\Http\Controllers\Configuracao\User;

use App\Http\Controllers\Controller;
use App\Models\Configuracao\User\PermissionsGroup;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:config_roles', ['only' => 'index']);
        $this->middleware('permission:config_roles_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:config_roles_show', ['only' => 'show']);
        $this->middleware('permission:config_roles_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:config_roles_assign', ['only' => ['assign', 'assign_update']]);
        $this->middleware('permission:config_roles_destroy', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::orderBy('name', 'ASC')
            ->get();

        return view('configuracao.users.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('configuracao.users.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|alpha_dash|unique:roles',
        ]);
        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        if ($role) {
            return redirect()->route('configuracao.roles.index')->with('success', 'Perfil cadastrado com Sucesso!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show(Role $role)
    {
        return view('configuracao.users.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit(Role $role)
    {
        return view('configuracao.users.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $request->validate([
            'name' => 'required|alpha_dash|unique:permissions,name,'.$role->id,
        ]);
        $role->name = $request->name;
        $role->description = $request->description;
        if ($role->save()) {
            return redirect()->route('configuracao.roles.edit', [$id])->with('success', 'Perfil atualizado!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy(Role $role)
    {
        $role->delete();
        if ($role) {
            return redirect()->route('configuracao.roles.index')->with('success', 'Perfil Excluído com Sucesso!');
        }
    }

    /**
     * Update permissions on role.
     *
     * @param  int  $id
     */
    public function assign(Role $role)
    {
        $group = PermissionsGroup::class;
        $permissions = Permission::class;
        $array_temp = $role->permissions;
        foreach ($array_temp as $key => $value) {
            $array_permissions[] = $value['id'];
        }
        // Gambi pratica!
        if (! is_array($array_temp)) {
            $array_permissions[] = 0;
        }
        $groups = Permission::select('permissions.group_id', 'permissions_group.name')
            ->orderby('permissions_group.name')
            ->join('permissions_group', 'permissions_group.id', '=', 'permissions.group_id')
            ->distinct()
            ->get();

        return view('configuracao.users.roles.assign', compact('role', 'array_permissions', 'permissions', 'group', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     */
    public function assign_update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $request->validate([
            'assign_id' => 'required|array',
        ]);
        $role->syncPermissions(array_map(fn ($val) => (int) $val, $request->assign_id));

        return redirect()->route('configuracao.roles.assign', [$id])->with('success', 'Permissões Atualizadas!');
    }
}
