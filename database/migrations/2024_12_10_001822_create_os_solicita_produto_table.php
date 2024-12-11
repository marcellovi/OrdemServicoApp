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
        Schema::create('os_solicita_produto', function (Blueprint $table) {
            $table->id();
            $table->string('codospedido');
            $table->text('itens');
            $table->text('descritivo');
            $table->integer('ordem_servico_id');
            $table->integer('prioridade_id');
            $table->integer('status_id')->default(2); // Aberta
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('os_solicita_produto');
    }
};
