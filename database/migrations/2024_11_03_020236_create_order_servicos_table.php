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
        Schema::create('order_servicos', function (Blueprint $table) {
            $table->id();
            $table->string('numero_os')->nullable(true);
            //$table->string('tags');  // remove
            $table->date('data_abertura');
            $table->date('data_programada')->nullable();;
            $table->integer('ativo_id');
            $table->integer('prioridade_id');
            $table->integer('tipo_manutencao_id');
            $table->integer('natureza_servico_id');
            $table->integer('equipe_responsavel_id')->nullable();;
            $table->integer('responsavel_id')->nullable();;
            $table->integer('mantenedor_id')->nullable();;
            $table->integer('auxiliar_id')->nullable();;
            $table->integer('status_id')->default(1);
            $table->text('diagnostico')->nullable();
            $table->text('solucao')->nullable();
            $table->text('pecas_trocadas')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_servicos');
    }
};
