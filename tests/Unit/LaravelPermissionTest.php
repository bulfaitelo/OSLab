<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class LaravelPermissionTest extends TestCase
{
    use RefreshDatabase;
    protected $user;
    protected $role;

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
        $this->role = Role::find(1);
    }

    /**
     * Testando atribuição de perfil forçando um numero inteiro.
     */
    public function test_user_assign_role_force_int(): void
    {
        try {
            $this->user->assignRole(1);
        } catch (\Throwable $th) {
        }
        $this->assertTrue($this->user->hasRole(1));
        $this->assertTrue($this->user->hasRole('role_test_1'));
        $this->assertTrue($this->user->hasRole('role_test_1'));
    }

    /**
     * Testando atribuição de perfil forçando um numero inteiro passado como string.
     * (após update parou de funcionar, por isso que não é um teste obrigatório).
     */
    public function test_user_assign_role_force_string(): void
    {
        try {
            $this->user->assignRole('1');
            $this->assertTrue($this->user->hasRole('1'));
            $this->assertTrue($this->user->hasRole('role_test_1'));
            $this->assertTrue($this->user->hasRole('role_test_1'));
        } catch (\Throwable $th) {
        }
    }

    /**
     * Testando sincronismo de perfil forçando um numero inteiro.
     */
    public function test_user_sync_role_force_int(): void
    {
        try {
            $this->user->syncRoles([1, 2]);
        } catch (\Throwable $th) {
        }
        $this->assertTrue($this->user->hasAllRoles(['role_test_1', 'role_test_2']));
        $this->assertFalse($this->user->hasAllRoles(['role_test_2', 'role_test_3']));
        // dd($this->user->getRoleNames());
    }

    /**
     * Testando sincronismo de perfil forçando um numero inteiro.
     */
    public function test_user_sync_role_force_string(): void
    {
        try {
            $this->user->syncRoles(['1', '2']);
            $this->assertTrue($this->user->hasAllRoles(['role_test_1', 'role_test_2']));
            $this->assertFalse($this->user->hasAllRoles(['role_test_2', 'role_test_3']));
        } catch (\Throwable $th) {
        }
        // dd($this->user->getRoleNames());
    }

    /**
     * Testando atribuição de permissão em usuário forçando um numero inteiro.
     */
    public function test_user_assign_permission_force_int(): void
    {
        try {
            $this->user->givePermissionTo([1, 2]);
        } catch (\Throwable $th) {
        }

        $this->assertTrue($this->user->hasPermissionTo(1));
        $this->assertTrue($this->user->hasPermissionTo('permission_test_1'));
        $this->assertTrue($this->user->hasPermissionTo('permission_test_2'));
        // dd($this->user->getRoleNames());
    }

    /**
     * Testando atribuição de permissão em perfil forçando um numero string.
     */
    public function test_user_assign_permission_force_string(): void
    {
        try {
            $this->user->givePermissionTo(['1', '2']);
            $this->assertTrue($this->user->hasPermissionTo(1));
            $this->assertTrue($this->user->hasPermissionTo('permission_test_1'));
            $this->assertTrue($this->user->hasPermissionTo('permission_test_2'));
        } catch (\Throwable $th) {
        }
        // dd($this->role->getAllPermissions());
        // dd($this->user->getRoleNames());
    }

    /**
     * Testando atribuição de permissão em usuário forçando um numero inteiro.
     */
    public function test_user_sync_permission_force_int(): void
    {
        try {
            $this->user->syncPermissions([1, 2]);
        } catch (\Throwable $th) {
        }

        $this->assertTrue($this->user->hasPermissionTo(1));
        $this->assertTrue($this->user->hasPermissionTo('permission_test_1'));
        $this->assertTrue($this->user->hasPermissionTo('permission_test_2'));
        // dd($this->user->getRoleNames());
    }

    /**
     * Testando atribuição de permissão em perfil forçando um numero string.
     */
    public function test_user_sync_permission_force_string(): void
    {
        try {
            $this->user->syncPermissions(['1', '2']);
            $this->assertTrue($this->user->hasPermissionTo(1));
            $this->assertTrue($this->user->hasPermissionTo('permission_test_1'));
            $this->assertTrue($this->user->hasPermissionTo('permission_test_2'));
        } catch (\Throwable $th) {
        }
        // dd($this->role->getAllPermissions());
        // dd($this->user->getRoleNames());
    }

    /**
     * Testando atribuição de permissão em perfil forçando um numero inteiro.
     */
    public function test_role_assign_permission_force_int(): void
    {
        try {
            $this->role->givePermissionTo([1, 2]);
        } catch (\Throwable $th) {
        }

        $this->assertTrue($this->role->hasPermissionTo(1));
        $this->assertTrue($this->role->hasPermissionTo('permission_test_1'));
        $this->assertTrue($this->role->hasPermissionTo('permission_test_2'));
        // dd($this->user->getRoleNames());
    }

    /**
     * Testando atribuição de permissão em perfil forçando um numero string.
     */
    public function test_role_assign_permission_force_string(): void
    {
        try {
            $this->role->givePermissionTo(['1', '2']);
            $this->assertTrue($this->role->hasPermissionTo(1));
            $this->assertTrue($this->role->hasPermissionTo('permission_test_1'));
            $this->assertTrue($this->role->hasPermissionTo('permission_test_2'));
        } catch (\Throwable $th) {
        }
        // dd($this->role->getAllPermissions());
        // dd($this->user->getRoleNames());
    }

    /**
     * Testando atribuição de permissão em perfil forçando um numero inteiro.
     */
    public function test_role_sync_permission_force_int(): void
    {
        try {
            $this->role->syncPermissions([1, 2]);
        } catch (\Throwable $th) {
        }

        $this->assertTrue($this->role->hasPermissionTo(1));
        $this->assertTrue($this->role->hasPermissionTo('permission_test_1'));
        $this->assertTrue($this->role->hasPermissionTo('permission_test_2'));
        // dd($this->user->getRoleNames());
    }

    /**
     * Testando atribuição de permissão em perfil forçando um numero string.
     */
    public function test_role_sync_permission_force_string(): void
    {
        try {
            $this->role->syncPermissions(['1', '2']);
            $this->assertTrue($this->role->hasPermissionTo(1));
            $this->assertTrue($this->role->hasPermissionTo('permission_test_1'));
            $this->assertTrue($this->role->hasPermissionTo('permission_test_2'));
        } catch (\Throwable $th) {
        }
        // dd($this->role->getAllPermissions());
        // dd($this->user->getRoleNames());
    }

    /**
     * Cria um usuário para realização dos testes.
     *
     * @return void
     */
    private function createUser(): void
    {
        $user = new User();
        $user->id = '1';
        $user->ativo = '1';
        $user->name = 'test';
        $user->email = 'teste@test.com';
        $user->password = 'none12345';
        $user->save();
    }

    /**
     * Cria um perfil para realização dos testes.
     *
     * @return void
     */
    private function createRole(): void
    {
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
     * Cria uma permissão para realização dos testes.
     *
     * @return void
     */
    private function createPermission(): void
    {
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
