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
        Schema::create('solicitacao_compra', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_solicitacao_compra')->nullable();
            $table->text('solicitacao')->nullable();
            $table->text('resposta')->nullable();
            $table->string('assinatura')->nullable();
            $table->integer('responsavel_id')->nullable();
            $table->date('data_solicitacao')->nullable();
            $table->integer('status_id');
            $table->integer('prioridade_id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitacao_compra');
    }
};
