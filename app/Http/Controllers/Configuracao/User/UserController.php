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
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;


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
            'email' => 'required|email|unique:users',
            'setor_id' => 'required|integer',
            'password' => 'nullable|confirmed|min:8',
            'expire_at'=> 'date|nullable',
            'img_perfil' => 'nullable|image|max:2048',
            'estado'=> 'nullable|max:2',
        ]);
        if ($request->ativo) {
            $ativo = true;
        } else {
            $ativo = false;
        }

        $user = new User;
        $user->ativo = $ativo;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->celular = $request->celular;
        $user->telefone = $request->telefone;
        $user->setor_id = $request->setor_id;
        $user->password = $request->password;
        $user->cep = $request->cep;
        $user->logradouro = $request->logradouro;
        $user->numero = $request->numero;
        $user->bairro = $request->bairro;
        $user->cidade = $request->cidade;
        $user->estado = $request->estado;
        $user->complemento = $request->complemento;
        $user->expire_at = $request->expire_at;
        if ($request->img_perfil) {
            $resizedImage = Image::make($request->img_perfil)->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            // Gerar um nome único para a imagem
            $imageName = Str::uuid() . '.' . $request->img_perfil->getClientOriginalExtension();
            // Salvar a imagem no diretório destinado a imagens de perfil
            $resizedImage->save(storage_path('app/public/img_perfil/' . $imageName));
            $user->img_url = $imageName;
        }
        if ($user->save()) {
            return redirect()->route('configuracoes.users.index')->with('success', 'Usuário cadastrado com sucesso!'); ;
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
    public function edit(User $user)
    {
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
    public function update(Request $request, User $user)
    {
        // dd($request->input());

        $request->validate ([
            'name' => 'required|',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'setor_id' => 'required|integer',
            'password' => 'nullable|confirmed|min:8',
            'expire_at'=> 'date|nullable',
            'img_perfil' => 'nullable|image|max:2048',
            'estado'=> 'nullable|max:2',
        ]);
        if ($request->ativo) {
            $ativo = true;
        } else {
            $ativo = false;
        }
        $user->ativo = $ativo;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->celular = $request->celular;
        $user->telefone = $request->telefone;
        $user->setor_id = $request->setor_id;
        if ($request->password) {
            $user->password = $request->password;
        }
        $user->cep = $request->cep;
        $user->logradouro = $request->logradouro;
        $user->numero = $request->numero;
        $user->bairro = $request->bairro;
        $user->cidade = $request->cidade;
        $user->estado = $request->estado;
        $user->complemento = $request->complemento;
        $user->expire_at = $request->expire_at;
        if ($request->img_perfil) {
            $resizedImage = Image::make($request->img_perfil)->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            // Gerar um nome único para a imagem
            $imageName = Str::uuid() . '.' . $request->img_perfil->getClientOriginalExtension();
            // Salvar a imagem no diretório destinado a imagens de perfil
            $resizedImage->save(storage_path('app/public/img_perfil/' . $imageName));
            $user->img_url = $imageName;
        }
        $user->syncRoles($request->role);

        if($user->save()){
            return redirect()->route('configuracoes.users.index', [$user->id])->with('success', 'Permissão atualizada!'); ;
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
