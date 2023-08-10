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
        Schema::table('categoria_os', function (Blueprint $table) {
            $table->unsignedBigInteger('checklist_id')->nullable();
            $table->boolean('checklist_required')->nullable()->default(0);
            $table->foreign('checklist_id', 'fk_categoria_os_checklists')
            ->references('id')->on('checklists');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categoria_os', function (Blueprint $table) {
            $table->dropForeign('fk_categoria_os_checklists');
            $table->dropColumn([
                'checklist_id',
                'checklist_required'
            ]);
        });
    }
};
