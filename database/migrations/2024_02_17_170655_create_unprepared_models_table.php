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
        Schema::create('unprepared_models', function (Blueprint $table) 
        {
            $table->bigInteger('id')->generatedAs()->always()->primary();
            $table->text('name');
            $table->integer('base_model_id');
            $table->integer('base_model_size_id');
            $table->text('preview_image');
            $table->boolean('is_parted');
            $table->smallInteger('part_number')->nullable();
            $table->boolean('is_composite');
            $table->text('file_model');

            $table->unique(['base_model_id', 'base_model_size_id', 'is_parted', 'part_number']);
            $table->foreign('base_model_id')
                  ->references('id')->on('base_models')
                  ->onDelete('cascade');
            $table->foreign('base_model_size_id')
                  ->references('id')->on('base_model_sizes')
                  ->onDelete('restrict');
        });

        Schema::create('unprepared_composite_model_parts', function (Blueprint $table) 
        {
            $table->bigInteger('id')->generatedAs()->always()->primary();
            $table->bigInteger('unprepared_model_id');
            $table->text('name');
            $table->text('preview_image');
            $table->smallInteger('subpart_number');
            $table->text('file_model');

            $table->unique(['unprepared_model_id','subpart_number']);
            $table->foreign('unprepared_model_id')
                  ->references('id')->on('unprepared_models')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unprepared_models');
        Schema::dropIfExists('unprepared_composite_model_parts');
    }
};
