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
        Schema::create('additional_service_prices', function (Blueprint $table) {
            $table->integer('id')->generatedAs()->always()->primary();
            $table->smallInteger('additional_service_id');
            $table->integer('base_model_id');
            $table->smallInteger('printing_technology_id');
            $table->smallInteger('filament_type_id');
            $table->integer('base_model_size_id');
            $table->boolean('is_parted');
            $table->decimal('price', 10, 2);

            $table->unique(['additional_service_id', 'printing_technology_id', 'filament_type_id', 'base_model_size_id', 'is_parted']);
            $table->foreign('base_model_id')
                  ->references('id')->on('base_models')
                  ->onDelete('cascade');
            $table->foreign('additional_service_id')
                  ->references('id')->on('additional_services')
                  ->onDelete('cascade');
            $table->foreign('printing_technology_id')
                  ->references('id')->on('printing_technologies')
                  ->onDelete('cascade');
            $table->foreign('filament_type_id')
                  ->references('id')->on('filament_types')
                  ->onDelete('cascade');
            $table->foreign('base_model_size_id')
                  ->references('id')->on('base_model_sizes')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('additional_service_prices');
    }
};
