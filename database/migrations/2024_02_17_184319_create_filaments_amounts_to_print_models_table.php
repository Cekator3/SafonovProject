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
        Schema::create('filaments_amounts_to_print_models', function (Blueprint $table) 
        {
            $table->bigInteger('id')->generatedAs()->always()->primary();
            $table->smallInteger('filament_type_id');
            $table->bigInteger('prepared_model_id');
            $table->integer('amount');

            $table->unique(['filament_type_id', 'prepared_model_id']);
            $table->foreign('filament_type_id')
                  ->references('id')->on('filament_types')
                  ->onDelete('cascade');
            $table->foreign('prepared_model_id')
                  ->references('id')->on('prepared_models')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filaments_amounts_to_print_models');
    }
};
