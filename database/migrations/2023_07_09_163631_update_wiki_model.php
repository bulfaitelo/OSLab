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
        Schema::table('wiki_models', function (Blueprint $table) {
            $table->foreign('wiki_id', 'fk_wiki_models_wikis')
            ->references('id')->on('wikis')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wiki_models', function (Blueprint $table) {
            $table->dropForeign('fk_wiki_models_wikis');
        });
    }
};
