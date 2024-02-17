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
        Schema::create('application_events', function (Blueprint $table)
        {
            $table->bigInteger('id')->generatedAs()->always()->primary();
            $table->integer('user_id')->nullable();
            $table->timestamp('created_at');
            $table->text('type');
            $table->text('description');

            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_events');
    }
};
