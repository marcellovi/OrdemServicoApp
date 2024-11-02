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
        Schema::create('ativos', function (Blueprint $table) {
            $table->id();
            $table->string('tags');
            $table->string('name');
            $table->integer('category_id');
            $table->string('model')->nullable(true);
            $table->string('serie')->nullable(true);
            $table->integer('bloco_id');
            $table->integer('andar_id');
            $table->integer('sala_area_id');
            $table->integer('fase_id');
            $table->text('descritivo')->nullable(true);
            $table->integer('status')->default(1);
            $table->boolean('active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ativos');
    }
};
