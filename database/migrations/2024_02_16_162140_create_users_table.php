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
        Schema::create('users', function (Blueprint $table)
        {
            $table->integer('id')->generatedAs()->always()->primary();
            $table->text('login');
            $table->enum('role', ['customer', 'print_master', 'admin', 'superuser']);
            $table->text('password');
            $table->text('phone_number')->nullable();

            $table->unique(['login', 'role']);
            $table->comment('A user of the application.');
        });

        Schema::create('customers', function (Blueprint $table)
        {
            $table->integer('user_id')->unique();
            $table->text('profile_picture');
            $table->text('email')->unique();
            $table->text('name');
            $table->text('surname')->nullable();
            $table->text('patronymic')->nullable();

            $table->foreign('user_id', 'customer_user_id_foreign')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('customers');
    }
};
