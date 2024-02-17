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
        Schema::create('customer_model_feedbacks', function (Blueprint $table) {
            $table->integer('id')->generatedAs()->always()->primary();
            $table->integer('user_id');
            $table->integer('base_model_id');

            $table->integer('parent_feedback_id')->nullable();

            $table->integer('rate')->nullable();
            $table->timestampTz('created_at');
            $table->text('content');
        });

        Schema::table('customer_model_feedbacks', function (Blueprint $table) {
            $table->foreign('base_model_id')
                  ->references('id')->on('base_models')
                  ->onDelete('cascade');
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            $table->foreign('parent_feedback_id')
                  ->references('id')->on('customer_model_feedbacks')
                  ->onDelete('cascade');
        });

        Schema::create('model_feedback_photos', function (Blueprint $table) {
            $table->integer('feedback_id');
            $table->text('photo');

            $table->unique(['feedback_id', 'photo']);
            $table->foreign('feedback_id')
                  ->references('id')->on('customer_model_feedbacks')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_model_feedbacks');
        Schema::dropIfExists('feedback_photos');
    }
};
