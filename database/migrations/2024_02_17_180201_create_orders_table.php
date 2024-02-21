<?php

use App\Enums\OrderStatus;
use App\Enums\OrderDeliveryMethod;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) 
        {
            $table->integer('id')->generatedAs()->always()->primary();
            $table->integer('customer_id')->unique();
            $table->enum('status', OrderStatus::GetAllValues());
            $table->timestamp('payed_at');

            $table->text('receiver_phone_number');
            $table->text('receiver_email');
            $table->text('receiver_name');
            $table->text('receiver_surname')->nullable();
            $table->text('receiver_patronymic')->nullable();

            $table->enum('delivery_method', OrderDeliveryMethod::GetAllValues());
            $table->text('delivery_address_city')->nullable();
            $table->text('delivery_address_street')->nullable();
            $table->text('delivery_address_building_number')->nullable();
            $table->text('delivery_address_house_number')->nullable();
            $table->text('delivery_address_apartment_number')->nullable();
            $table->integer('delivery_address_postal_code')->nullable();

            $table->foreign('customer_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
        });

        Schema::create('customer_acquired_models', function (Blueprint $table) 
        {
            $table->integer('id')->generatedAs()->always()->primary();
            $table->integer('customer_id');
            $table->integer('base_model_id');

            $table->unique(['customer_id', 'base_model_id']);
            $table->foreign('customer_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            $table->foreign('base_model_id')
                  ->references('id')->on('base_models')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('customer_acquired_models');
    }
};
