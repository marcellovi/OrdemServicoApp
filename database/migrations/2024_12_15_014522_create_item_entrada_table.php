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
        Schema::create('item_entrada', function (Blueprint $table) {
            $table->id();
            $table->string('lote')->default('N/A');
            $table->integer('quantidade');
            $table->double('valor');
            $table->integer('entrada_id');
            $table->integer('produto_id');
            $table->integer('solicitacao_compra_id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_entrada');
    }
};
