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
        Schema::table('os_solicita_produto', function (Blueprint $table) {
            $table->text('comentario_estoque')->after('descritivo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comentario_estoque', function (Blueprint $table) {
            //
        });
    }
};
