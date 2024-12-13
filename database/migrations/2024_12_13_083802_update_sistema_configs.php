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
        Schema::table('sistema_configs', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('value');
        });

        Schema::table('sistema_configs', function (Blueprint $table) {
            $table->foreign('user_id', 'fk_sistema_configs_users')
            ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sistema_configs', function (Blueprint $table) {
            $table->dropForeign('fk_sistema_configs_users');
            $table->dropColumn('user_id');
        });
    }
};
