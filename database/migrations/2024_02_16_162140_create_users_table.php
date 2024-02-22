<?php

use App\Enums\UserRole;
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
            $table->rememberToken();
            $table->text('login');
            $table->enum('role', UserRole::GetAllValues());
            $table->text('password');
            $table->text('phone_number')->nullable()->unique();
            $table->text('email')->nullable()->unique();
            $table->text('profile_picture')->nullable();
            $table->text('name')->nullable();
            $table->text('surname')->nullable();
            $table->text('patronymic')->nullable();

            $table->unique(['login', 'role']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
