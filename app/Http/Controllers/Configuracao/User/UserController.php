<?php

namespace App\Http\Controllers\Configuracao\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Configuracao\Setor;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use App\Models\Configuracao\User\PermissionsGroup;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:config_user', ['only'=> 'index']);
        $this->middleware('permission:config_user_create', ['only'=> ['create', 'store']]);
        $this->middleware('permission:config_user_show', ['only'=> 'show']);
        $this->middleware('permission:config_user_edit', ['only'=> ['edit', 'update']]);
        $this->middleware('permission:config_user_destroy', ['only'=> 'destroy']);

        $this->middleware('permission:config_user_permissions_edit', ['only'=> ['permissions_edit', 'permissions_update']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::orderBy('name', 'ASC')
        ->get();
        return view('configuracoes.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('configuracoes.users.create');
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
            'name' => 'required|',
            'email' => 'required|email',
            'setor' => 'required|integer',
            'password' => 'nullable|confirmed|min:8'

        ]);
        dd($request->input());
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
        $user = User::findOrFail($id);
        $user->hasRole = $user->hasAnyRole(Role::all());
        // dd($user->roles);
        return view('configuracoes.users.edit', compact('user'));
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
        // dd($request->input());
        $user = User::findOrFail($id);
        $request->validate ([
            'name' => 'required|',
            'setor' => 'required|integer',
            'password' => 'nullable|confirmed|min:8'

        ]);
        $user->name = $request->name;
        $user->setor_id = $request->setor;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->syncRoles($request->role);

        if($user->save()){
            return redirect()->route('configuracoes.users.index', [$id])->with('success', 'Permissão atualizada!'); ;
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
        //
    }


    /**
     *
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function permissions_edit($id)
    {
        // $role = Role::findOrFail($id);
        $user = User::findOrFail($id);
        $group = PermissionsGroup::class;
        // Perfil padrão do usuário.
        $roles = Role::find($user->roles->first()->id);
        $permissions = Permission::class;
        $groups = Permission::select('permissions.group_id', 'permissions_group.name')
            ->orderby('permissions_group.name')
            ->join('permissions_group', 'permissions_group.id', '=', 'permissions.group_id')
            ->distinct()
            ->get();
        // dd($permissions);
        return view('configuracoes.users.permissions', compact('permissions', 'user', 'roles', 'group', 'groups'));
    }


    /**
     *
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function permissions_update(Request $request, $id)
    {

        $user = User::findOrFail($id);

        $user->syncPermissions($request->assign_id);
        return redirect()->route('configuracoes.users.permissions_edit', [$id])->with('success', 'Permissões Atualizadas!'); ;


    }
}
