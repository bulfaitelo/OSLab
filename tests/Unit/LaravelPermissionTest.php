<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class LaravelPermissionTest extends TestCase
{

    use RefreshDatabase;
    protected $user;

    protected function setUp(): void
    {
        // first include all the normal setUp operations
        parent::setUp();
        // now de-register all the roles and permissions by clearing the permission cache
        $this->app->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        $this->createUser();
        $this->createRole();
        $this->createPermission();
        $this->user = User::find(1);



    }


    /**
     * A basic unit test example.
     */
    public function test_user_sync_roles(): void
    {
        // // Testando erro após update
        // try {
        //     $this->user->assignRole('1');
        // } catch (\Throwable $th) {
        //     //throw $th;
        // }
        // $this->assertTrue($user->hasRole(1));
        // dd($user->getRoleNames());



        // $user->syncRoles(array_map(fn($val)=>(int)$val, $request->role));

        // $this->assertFalse(false);

    }




    /**
     * Cria um usuário para realização dos testes
     *
     * @return void
     */
    private function createUser() : void  {
        $user = new User();
        $user->id = '1';
        $user->ativo = '1';
        $user->name = 'test';
        $user->email = 'teste@test.com';
        $user->password = 'none12345';
        $user->save();

    }

    /**
     * Cria um perfil para realização dos testes
     *
     * @return void
     */
    private function createRole() : void  {
        $role = new Role();
        $role->id = '1';
        $role->name = 'role_test_1';
        $role->guard_name = 'web';
        $role->save();

        $role = new Role();
        $role->id = '2';
        $role->name = 'role_test_2';
        $role->guard_name = 'web';
        $role->save();

    }

    /**
     * Cria uma permissão para realização dos testes
     *
     * @return void
     */
    private function createPermission() : void  {
        $role = new Permission();
        $role->id = '1';
        $role->name = 'permission_test_1';
        $role->guard_name = 'web';
        $role->save();

        $role = new Permission();
        $role->id = '2';
        $role->name = 'permission_test_2';
        $role->guard_name = 'web';
        $role->save();

    }
}
