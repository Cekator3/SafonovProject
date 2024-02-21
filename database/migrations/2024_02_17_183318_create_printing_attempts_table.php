<?php

use App\Enums\PrintingCompletionStatus;
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
        Schema::create('printing_attempts', function (Blueprint $table) 
        {
            $table->bigInteger('id')->generatedAs()->always()->primary();
            $table->integer('printer_id');
            $table->enum('status', PrintingCompletionStatus::GetAllValues());
            $table->timestamp('finished_at')->nullable();

            $table->foreign('printer_id')
                  ->references('id')->on('printers')
                  ->onDelete('cascade');
        });

        Schema::create('printing_attempt_models', function (Blueprint $table) 
        {
            $table->bigInteger('id')->generatedAs()->always()->primary();
            $table->bigInteger('printing_attempt_id');
            $table->integer('ordered_model_id');
            $table->boolean('is_printed_successfully')->nullable();

            $table->unique(['printing_attempt_id', 'ordered_model_id']);
            $table->foreign('printing_attempt_id')
                  ->references('id')->on('printing_attempts')
                  ->onDelete('cascade');
            $table->foreign('ordered_model_id')
                  ->references('id')->on('ordered_models')
                  ->onDelete('cascade');
        });

        Schema::create('printing_attempt_filaments', function (Blueprint $table) 
        {
            $table->bigInteger('id')->generatedAs()->always()->primary();
            $table->bigInteger('printing_attempt_id');
            $table->integer('filament_id');

            $table->unique(['printing_attempt_id', 'filament_id']);
            $table->foreign('printing_attempt_id')
                  ->references('id')->on('printing_attempts')
                  ->onDelete('cascade');
            $table->foreign('filament_id')
                  ->references('id')->on('filaments')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('printing_attempts');
        Schema::dropIfExists('printing_attempt_models');
        Schema::dropIfExists('printing_attempt_filaments');
    }
};
