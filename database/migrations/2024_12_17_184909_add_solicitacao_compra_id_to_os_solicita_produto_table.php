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
        Schema::table('os_solicita_produto', function (Blueprint $table) {
            $table->integer('solicitacao_compra_id')->after('ordem_servico_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('solicitacao_compra_id', function (Blueprint $table) {
            //
        });
    }
};
