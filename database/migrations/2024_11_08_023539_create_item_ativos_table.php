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
        Schema::create('item_ativos', function (Blueprint $table) {
            $table->id();
            $table->string('sigla')->nullable();
            $table->string('nome');
            $table->integer('ativo_id')->nullable();
            $table->string('modelo')->nullable();
            $table->integer('serie')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_ativos');
    }
};
