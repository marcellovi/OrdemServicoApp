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
        Schema::create('ativo_modelo', function (Blueprint $table) {
            $table->id();
            $table->string('sigla');
            $table->string('nome');
            $table->string('modelo')->nullable(true);
            $table->string('serie')->nullable(true);
            $table->text('descritivo')->nullable(true);
            $table->integer('categoria_id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ativo_modelo');
    }
};
