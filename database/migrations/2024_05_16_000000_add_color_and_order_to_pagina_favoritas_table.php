<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pagina_favoritas', function (Blueprint $table) {
            $table->string('color')->default('btn-primary')->after('icon');
            $table->unsignedInteger('order')->default(0)->after('color');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pagina_favoritas', function (Blueprint $table) {
            $table->dropColumn(['color', 'order']);
        });
    }
};
