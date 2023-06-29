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
use Illuminate\Support\Facades\Storage;
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
        return view('configuracao.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('configuracao.users.create');
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
        $user->syncRoles($request->role);

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
            return redirect()->route('configuracao.users.index')->with('success', 'Usuário cadastrado com sucesso!'); ;
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user->hasRole = $user->hasAnyRole(Role::all());
        // dd($user->roles);
        return view('configuracao.users.show', compact('user'));
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
        return view('configuracao.users.edit', compact('user'));
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
            // Apagando a imagem antiga antes de definir nova
            $tempImage = $user->img_url;
            if ((file_exists(storage_path('app/public/img_perfil/').$tempImage)) && $tempImage != null ) {
                unlink(storage_path('app/public/img_perfil/').$tempImage);
            }
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
            return redirect()->route('configuracao.users.index', [$user->id])->with('success', 'Permissão atualizada!'); ;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('configuracao.users.index')
                ->with('success', 'Usuário excluído com sucesso.');

        } catch (\Throwable $th) {
            throw $th;
        }
    }


    /**
     *
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function permissions_edit(User $user)
    {
        // $role = Role::findOrFail($id);
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
        return view('configuracao.users.permissions', compact('permissions', 'user', 'roles', 'group', 'groups'));
    }


    /**
     *
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function permissions_update(Request $request, User $user)
    {

        $user->syncPermissions($request->assign_id);
        return redirect()->route('configuracao.users.permissions_edit', [$user->id])->with('success', 'Permissões Atualizadas!'); ;


    }
}
