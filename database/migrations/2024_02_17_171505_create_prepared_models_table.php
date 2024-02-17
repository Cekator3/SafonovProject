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
        Schema::create('prepared_models', function (Blueprint $table) {
            $table->bigInteger('id')->generatedAs()->always()->primary();
            $table->bigInteger('unprepared_model_id')->unique();
            $table->text('preview_image');
            $table->integer('length');
            $table->integer('width');
            $table->integer('height');

            $table->foreign('unprepared_model_id')
                  ->references('id')->on('unprepared_models')
                  ->onDelete('cascade');
        });

        Schema::create('prepared_model_files', function (Blueprint $table) 
        {
            $table->bigInteger('id')->generatedAs()->always()->primary();
            $table->bigInteger('prepared_model_id');
            $table->boolean('is_holed');
            $table->text('file_format');
            $table->text('file');

            $table->unique(['prepared_model_id', 'is_holed', 'file_format']);
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
        Schema::dropIfExists('prepared_models');
        Schema::dropIfExists('prepared_model_files');
    }
};
