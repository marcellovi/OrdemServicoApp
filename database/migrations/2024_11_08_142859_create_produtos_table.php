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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('codprod')->unique();
            $table->string('nome');
            $table->string('descricao')->nullable();
            $table->integer('qt_minima');
            $table->integer('qt_reposicao')->nullable();
            $table->integer('unid_medida_id')->nullable();
            $table->integer('fabricante_id')->nullable();
            $table->integer('categoria_id')->nullable();
            //$table->string('marca')->nullable();
            //$table->integer('valor_unitario')->nullable();
            //$table->integer('valor_total')->nullable();
            //$table->integer('tributo')->nullable();
            //$table->integer('quantidade')->nullable();
            //$table->string('nota_fiscal')->nullable();
            //$table->string('setor')->nullable();
            //$table->text('descritivo')->nullable();
            //$table->date('validade_produto')->nullable();
//            $table->date('data_compra')->nullable();
//            $table->string('fornecedor')->nullable();
//            $table->string('especialidade')->nullable();
//            $table->string('contato')->nullable();
//            $table->string('responsavel')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
//        Schema::dropIfExists('produtos');
    }
};
