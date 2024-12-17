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
        Schema::create('item_saida', function (Blueprint $table) {
            $table->id();
            $table->integer('solicita_id')->nullable();
            $table->integer('produto_id');
            $table->integer('quantidade');
            $table->text('razao')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_saida');
    }
};
