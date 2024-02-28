<?php

use App\Enums\ModelMistakeType;
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
        Schema::create('model_mistakes', function (Blueprint $table) 
        {
            $table->integer('id')->generatedAs()->always()->primary();
            $table->integer('user_id')->nullable();
            $table->text('image');
            $table->text('description');
            $table->enum('type', ModelMistakeType::GetAllValues());
            $table->timestampTz('created_at');
            $table->integer('base_model_id');
            $table->bigInteger('unprepared_model_id')->nullable();
            $table->bigInteger('unprepared_composite_model_part_id')->nullable();
            $table->bigInteger('prepared_model_id')->nullable();

            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->nullOnDelete();
            $table->foreign('base_model_id')
                  ->references('id')->on('base_models')
                  ->onDelete('cascade');
            $table->foreign('unprepared_model_id')
                  ->references('id')->on('unprepared_models')
                  ->onDelete('cascade');
            $table->foreign('unprepared_composite_model_part_id')
                  ->references('id')->on('unprepared_composite_model_parts')
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
        Schema::dropIfExists('model_mistakes');
    }
};
