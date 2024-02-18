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
        Schema::create('filament_types', function (Blueprint $table) {
            $table->smallInteger('id')->generatedAs()->always()->primary();
            $table->text('name')->unique();
            $table->text('description');
            $table->smallInteger('strength');
            $table->smallInteger('hardness');
            $table->smallInteger('impact_resistance');
            $table->smallInteger('durability');
            $table->smallInteger('min_work_temperature');
            $table->smallInteger('max_work_temperature');
            $table->boolean('food_contact_allowed');
        });

        Schema::create('printing_technologies_of_filament_type', function (Blueprint $table)
        {
            $table->smallInteger('id')->generatedAs()->always()->primary();
            $table->smallInteger('filament_type_id');
            $table->smallInteger('printing_technology_id');

            $table->unique(['filament_type_id', 'printing_technology_id']);
            $table->foreign('filament_type_id')
                  ->references('id')->on('filament_types')
                  ->onDelete('cascade');
            $table->foreign('printing_technology_id')
                  ->references('id')->on('printing_technologies')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filament_types');
        Schema::dropIfExists('printing_technologies_of_filament_type');
    }
};
