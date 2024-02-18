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
        Schema::create('colors', function (Blueprint $table) {
            $table->smallInteger('id')->generatedAs()->always()->primary();
            $table->text('name')->unique();
            $table->text('code')->unique();
        });

        Schema::create('filaments', function (Blueprint $table) {
            $table->integer('id')->generatedAs()->always()->primary();
            $table->text('name')->unique();
            $table->smallInteger('filament_type_id');
            $table->smallInteger('color_id');
            $table->integer('amount_reserved');
            $table->integer('amount_total');

            $table->foreign('color_id')
                  ->references('id')->on('colors')
                  ->onDelete('restrict');
            $table->foreign('filament_type_id')
                  ->references('id')->on('filament_types')
                  ->onDelete('cascade');
        });

        Schema::create('filament_printing_characteristics', function (Blueprint $table) 
        {
            $table->integer('id')->generatedAs()->always()->primary();
            $table->integer('printing_characteristic_id');
            $table->integer('filament_id');
            $table->integer('value');

            $table->unique(['printing_characteristic_id', 'filament_id']);
            $table->foreign('printing_characteristic_id')
                  ->references('id')->on('printing_characteristics')
                  ->onDelete('cascade');
            $table->foreign('filament_id')
                  ->references('id')->on('filaments')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colors');
        Schema::dropIfExists('filaments');
        Schema::dropIfExists('filament_printing_characteristics');
    }
};
