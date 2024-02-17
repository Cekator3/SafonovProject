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
        Schema::create('printer_distributing_models', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('ordered_model_id');

            $table->unique(['user_id', 'ordered_model_id']);
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            $table->foreign('ordered_model_id')
                  ->references('id')->on('ordered_models')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('printer_distributing_models');
    }
};
