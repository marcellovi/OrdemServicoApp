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
        Schema::table('order_servicos', function (Blueprint $table) {
            $table->integer('status_id')->default(1);
            $table->text('descritivo')->nullable();
            $table->text('descritivo_executado')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_servicos', function (Blueprint $table) {
            $table->dropColumn('status_id');
            $table->dropColumn('descritivo');
            $table->dropColumn('descritivo_executado');
        });
    }
};
