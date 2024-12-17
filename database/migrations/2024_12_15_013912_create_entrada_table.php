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
        Schema::create('entrada', function (Blueprint $table) {
            $table->id();
            $table->string('num_nf')->default('N/A');
            $table->double('imposto')->default(0);
            $table->double('frete')->default(0);
            $table->double('total');
            $table->text('nota_fiscal_doc')->nullable();
            $table->date('data_entrada');
            $table->integer('responsavel_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrada');
    }
};
