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
        Schema::table('pagamentos', function (Blueprint $table) {
            $table->foreign('conta_id', 'fk_pagamentos_contas')
            ->references('id')->on('contas')
            ->onDelete('cascade');

            $table->foreign('forma_pagamento_id', 'fk_pagamentos_forma_pagamentos')
            ->references('id')->on('forma_pagamentos');

            $table->foreign('user_id', 'fk_pagamentos_users')
            ->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pagamentos', function (Blueprint $table) {
            $table->dropForeign('fk_pagamentos_contas');
            $table->dropForeign('fk_pagamentos_forma_pagamentos');
            $table->dropForeign('fk_pagamentos_users');

        });
    }
};
