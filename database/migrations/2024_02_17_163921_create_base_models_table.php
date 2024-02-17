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
        Schema::create('base_models', function (Blueprint $table) 
        {
            $table->integer('id')->generatedAs()->always()->primary();
            $table->text('name')->nullable()->unique();
            $table->text('preview_image')->nullable();
            $table->text('description')->nullable();
            $table->text('file_3d_preview')->nullable();
            $table->text('file_model');
            $table->boolean('is_in_catalog');
            $table->integer('sales_count');
        });

        Schema::create('base_model_sizes', function (Blueprint $table) 
        {
            $table->integer('id')->generatedAs()->always()->primary();
            $table->integer('base_model_id');
            $table->double('size_multiplier', 6, 2);
            $table->integer('length');
            $table->integer('width');
            $table->integer('height');

            $table->unique(['base_model_id', 'size_multiplier']);
            $table->unique(['base_model_id', 'length', 'width', 'height']);
            $table->foreign('base_model_id')
                  ->references('id')->on('base_models')
                  ->onDelete('cascade');
        });

        Schema::create('base_model_search_tags', function (Blueprint $table) 
        {
            $table->integer('id')->generatedAs()->always()->primary();
            $table->integer('base_model_id');
            $table->text('name');

            $table->unique(['base_model_id', 'name']);
            $table->foreign('base_model_id')
                  ->references('id')->on('base_models')
                  ->onDelete('cascade');
        });

        Schema::create('base_model_gallery_images', function (Blueprint $table) 
        {
            $table->integer('id')->generatedAs()->always()->primary();
            $table->integer('base_model_id');
            $table->text('image');

            $table->unique(['base_model_id', 'image']);
            $table->foreign('base_model_id')
                  ->references('id')->on('base_models')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('base_models');
        Schema::dropIfExists('base_model_sizes');
        Schema::dropIfExists('base_model_search_tags');
        Schema::dropIfExists('base_model_gallery_images');
    }
};
