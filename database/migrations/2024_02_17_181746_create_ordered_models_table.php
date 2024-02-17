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
        Schema::create('ordered_models', function (Blueprint $table) {
            $completion_statuses = [
                'needs_admin_checking',
                'on_admin_checking',
                'needs_to_be_printed',
                'is_in_printer_queue',
                'is_being_printed',
                'is_on_post_processing',
                'is_on_admin_final_check',
                'completed'
            ];

            $table->integer('id')->generatedAs()->always()->primary();
            $table->integer('order_id');
            $table->text('customer_special_wishes');

            $table->integer('base_model_id');
            $table->smallInteger('base_model_size_id');
            $table->boolean('is_parted');
            $table->boolean('is_holed');

            $table->smallInteger('printing_technology_id');
            $table->smallInteger('filament_type_id');
            $table->smallInteger('color_id');

            $table->enum('completion_status', $completion_statuses);

            $table->foreign('order_id')
                  ->references('id')->on('orders')
                  ->onDelete('cascade');
            $table->foreign('base_model_id')
                  ->references('id')->on('base_models')
                  ->onDelete('restrict');
            $table->foreign('base_model_size_id')
                  ->references('id')->on('base_model_sizes')
                  ->onDelete('restrict');
            $table->foreign('printing_technology_id')
                  ->references('id')->on('printing_technologies')
                  ->onDelete('restrict');
            $table->foreign('filament_type_id')
                  ->references('id')->on('filament_types')
                  ->onDelete('restrict');
            $table->foreign('color_id')
                  ->references('id')->on('colors')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordered_models');
    }
};
