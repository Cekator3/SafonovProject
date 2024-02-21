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
        Schema::create('additional_services_of_ordered_model', function (Blueprint $table) 
        {
            $table->integer('id')->generatedAs()->always()->primary();
            $table->integer('ordered_model_id');
            $table->integer('additional_service_id');
            $table->integer('user_id');

            $table->unique(['ordered_model_id', 'additional_service_id']);
            $table->foreign('ordered_model_id')
                  ->references('id')->on('ordered_models')
                  ->onDelete('cascade');
            $table->foreign('additional_service_id')
                  ->references('id')->on('additional_services')
                  ->onDelete('restrict');
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('additional_services_of_ordered_model');
    }
};
