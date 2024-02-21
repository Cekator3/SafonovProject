<?php

use App\Enums\AdditionalServiceType;
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
        Schema::create('additional_services', function (Blueprint $table) 
        {
            $table->smallInteger('id')->generatedAs()->always()->primary();
            $table->text('name')->unique();
            $table->enum('additional_service_type', AdditionalServiceType::GetAllValues());
            $table->text('preview_image');
            $table->text('description');
        });

        Schema::create('printing_technologies_of_postprocessing_additional_service', function (Blueprint $table)
        {
            $table->smallInteger('id')->generatedAs()->always()->primary();
            $table->smallInteger('additional_service_id');
            $table->smallInteger('printing_technology_id');

            $table->unique(['additional_service_id', 'printing_technology_id'], 'unique_printing_technologies_of_postprocessing_additional_service');
            $table->foreign('additional_service_id')
                  ->references('id')->on('additional_services')
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
        Schema::dropIfExists('additional_services');
        Schema::dropIfExists('printing_technologies_of_postprocessing_additional_service');
    }
};
