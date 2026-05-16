<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasColumn('pagina_favoritas', 'id')) {
            $driver = Schema::getConnection()->getDriverName();

            if ($driver === 'mysql') {
                DB::statement('ALTER TABLE pagina_favoritas ADD COLUMN id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST');
            } elseif ($driver === 'pgsql') {
                DB::statement('ALTER TABLE pagina_favoritas ADD COLUMN id BIGSERIAL PRIMARY KEY');
            } else {
                Schema::table('pagina_favoritas', function (Blueprint $table) {
                    $table->bigIncrements('id')->first();
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('pagina_favoritas', 'id')) {
            Schema::table('pagina_favoritas', function (Blueprint $table) {
                $table->dropColumn('id');
            });
        }
    }
};
