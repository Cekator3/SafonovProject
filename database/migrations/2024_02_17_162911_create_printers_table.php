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
        Schema::create('printers', function (Blueprint $table) 
        {
            $table->integer('id')->generatedAs()->always()->primary();
            $table->text('name')->unique();
            $table->text('preview_image');
            $table->boolean('is_broken')->default(false);
            $table->smallInteger('max_filament_amount');
            $table->integer('height');
            $table->integer('width');
            $table->integer('length');
        });

        Schema::create('printer_printing_characteristics', function (Blueprint $table) 
        {
            $table->integer('id')->generatedAs()->always()->primary();
            $table->integer('printer_id');
            $table->integer('printing_characteristic_id');
            $table->integer('value');

            $table->unique(['printer_id', 'printing_characteristic_id']);
            $table->foreign('printer_id')
                  ->references('id')->on('printers')
                  ->onDelete('cascade');
            $table->foreign('printing_characteristic_id')
                  ->references('id')->on('printing_characteristics')
                  ->onDelete('cascade');
        });


        Schema::create('printer_printing_technologies', function (Blueprint $table) 
        {
            $table->integer('id')->generatedAs()->always()->primary();
            $table->integer('printer_id');
            $table->integer('printing_technology_id');

            $table->unique(['printer_id', 'printing_technology_id']);
            $table->foreign('printer_id')
                  ->references('id')->on('printers')
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
        Schema::dropIfExists('printers');
        Schema::dropIfExists('printer_printing_characteristics');
        Schema::dropIfExists('printer_printing_technologies');
    }
};
