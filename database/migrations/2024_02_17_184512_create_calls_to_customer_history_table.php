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
        Schema::create('calls_to_customer_history', function (Blueprint $table) {
            $table->integer('id')->generatedAs()->always()->primary();
            $table->integer('order_id');
            $table->integer('customer_id');
            $table->timestamp('called_at');
            $table->boolean('is_success');

            $table->unique(['order_id', 'customer_id', 'called_at']);
            $table->foreign('order_id')
                  ->references('id')->on('orders')
                  ->onDelete('cascade');
            $table->foreign('customer_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calls_to_customer_history');
    }
};
