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
        Schema::create('printing_technologies', function (Blueprint $table)
        {
            $table->smallInteger('id')->generatedAs()->always()->primary();
            $table->text('full_name')->unique();
            $table->text('short_name')->unique();
            $table->text('description');
        });

        Schema::create('printing_technology_advantages', function (Blueprint $table)
        {
            $table->smallInteger('id')->generatedAs()->always()->primary();
            $table->smallInteger('printing_technology_id')->unique();
            $table->text('description');

            $table->foreign('printing_technology_id')
                  ->references('id')->on('printing_technologies')
                  ->onDelete('cascade');
        });

        Schema::create('printing_technology_disadvantages', function (Blueprint $table)
        {
            $table->smallInteger('id')->generatedAs()->always()->primary();
            $table->smallInteger('printing_technology_id')->unique();
            $table->text('description');

            $table->foreign('printing_technology_id')
                ->references('id')->on('printing_technologies')
                ->onDelete('cascade');
        });

        Schema::create('printing_characteristics', function (Blueprint $table)
        {
            $table->smallInteger('id')->generatedAs()->always()->primary();
            $table->smallInteger('printing_technology_id');
            $table->text('name');
            $table->enum('printing_characteristic_type', ['boolean', 'number']);

            $table->unique(['printing_technology_id', 'name']);
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
        Schema::dropIfExists('printing_technologies');
        Schema::dropIfExists('printing_technology_advantages');
        Schema::dropIfExists('printing_technology_disadvantages');
        Schema::dropIfExists('printing_characteristics');
    }
};
