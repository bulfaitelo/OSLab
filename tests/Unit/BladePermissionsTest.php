<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use File;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class BladePermissionsTest extends TestCase
{
    use RefreshDatabase;

    private $permission_blade;

    private $permission_db;

    private $permission_blade_path;

    protected function setUp(): void
    {
        // Preparando Banco de Dados
        parent::setUp();
        $this->artisan('db:seed');

        // BLADES
        $path = resource_path('views');
        $files = File::allFiles($path);
        foreach ($files as $file) {
            $file_path = $file->getPathname();

            $file_string = file_get_contents($file_path);
            preg_match_all('/@can( )?\(\'[\w\s]+\'\)/', $file_string, $itens);

            if (! isset($permission_blade)) {
                $permission_blade = [];
            }
            // dump($file_path, $itens);
            foreach ($itens[0] as $permission_temp) {
                $permission_blade[] = explode("'", $permission_temp)[1];
                $permission_blade_path[explode("'", $permission_temp)[1]] = $file_path;
            }

            // /@canany( )?\(\[([\'\w\s,]+)\]\)/
            // /@canany( )?\(\[([\'\w\s,]+)\]\)/

            $permission_count = preg_match_all('/@canany( )?\(\[([\'\w\s,]+)\]\)/', $file_string, $canany_array);
            if ($permission_count > 0) {
                foreach ($canany_array[2] as $temp_canany) {
                    $canany = $temp_canany;
                    $canany = str_replace("'", '', $canany);
                    $canany = explode(',', $canany);
                    $canany = array_map('trim', $canany);

                    foreach ($canany as $permission_temp) {
                        $permission_blade[] = $permission_temp;
                        // $permission_blade_path[explode("'",$permission_temp)[1]] = $file_path;
                        $permission_blade_path[$permission_temp] = $file_path;
                    }
                }
            }
        }

        // BLADES -

        // MENU AdminLTe
        $path = config_path('');
        $file = $path.'/adminlte.php';
        $file_string = file_get_contents($file);
        preg_match_all('/\'can\'( )+=>( )+([\'])+[\s\w]+\'\,/', $file_string, $itens);
        foreach ($itens[0] as $permission_temp) {
            $permission_blade[] = explode("'", $permission_temp)[3];
            $permission_blade_path[explode("'", $permission_temp)[3]] = $file;
        }

        preg_match_all('/\'can\'( )+=>( )+([\[])()+[\s\w\',]+\],/', $file_string, $itens);
        foreach ($itens[0] as $permission_temp) {
            foreach (explode("'", explode("'can'", $permission_temp)[1]) as $permission_temp_sub) {
                if (preg_match('/[\w]+/', $permission_temp_sub)) {
                    $permission_blade[] = $permission_temp_sub;
                    $permission_blade_path[$permission_temp_sub] = $file;
                }
            }
        }
        // @canany( )?\((\[[\'\w\s,]+\])\)

        // MENU AdminLTe -
        $permission_blade = array_unique($permission_blade);
        $this->permission_blade = $permission_blade;

        $permission_blade_path = array_unique($permission_blade_path);
        $this->permission_blade_path = $permission_blade_path;

        $permission_db = Permission::pluck('name')->toArray();
        $this->permission_db = $permission_db;
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_blade_permission_vs_database_permission()
    {
        $erro = false;
        $output_erro = '';
        $test = array_diff($this->permission_blade, $this->permission_db);
        if (count($test) > 0) {
            $erro = true;
            $output_erro = "\nPermissions divergentes da blade com o banco de dados:\n";
            foreach ($test as $key => $value) {
                $output_erro .= $value."\n";
            }
        }
        $this->assertNotTrue($erro, $output_erro);
    }

    public function test_permision_db_not_used_in_blade()
    {
        $erro = false;
        $output_erro = '';
        $test = array_diff($this->permission_db, $this->permission_blade);
        if (count($test) > 0) {
            $erro = true;
            $output_erro = "\nPermissions criadas e não usadas em nenhuma blade:\n";
            foreach ($test as $key => $value) {
                $output_erro .= $value."\n";
            }
        }
        $this->assertNotTrue($erro, $output_erro);
    }

    public function test_permision_x_blade()
    {
        $permission_db = $this->permission_db;
        $permission_blade = $this->permission_blade;
        sort($permission_blade);
        sort($permission_db);
        $this->assertSame(
            $permission_db,
            $permission_blade
        );
    }
}
