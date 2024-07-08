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
        Schema::table('os_status_logs', function (Blueprint $table) {
            $table->foreign('os_id', 'fk_os_status_logs_os')
                    ->references('id')->on('os')
                    ->cascadeOnDelete();

            $table->foreign('user_id', 'fk_os_status_logs_users')
                    ->references('id')->on('users');

            $table->foreign('status_id', 'fk_os_status_logs_os_status')
                    ->references('id')->on('os_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('os_status_logs', function (Blueprint $table) {
            $table->dropForeign('fk_os_status_logs_os');
            $table->dropForeign('fk_os_status_logs_users');
            $table->dropForeign('fk_os_status_logs_os_status');
        });
    }
};
