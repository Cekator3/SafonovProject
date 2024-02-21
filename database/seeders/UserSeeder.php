<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    private function insertUser(int $amount, UserRole $role, string $loginPrefix)
    {
        for ($i = 0; $i < $amount; $i++) 
        {
            try
            {
                DB::table('users')->insert([
                    'login' => $loginPrefix . '_' . $i,
                    'role' => $role->value,
                    'password' => 1,
                    'phone_number' => fake()->phoneNumber(),
                    'email' => fake()->email(),
                ]);
            }
            catch (\Throwable $e) {}
        }
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        static::insertUser(1000000, UserRole::Customer, 'customer');
        static::insertUser(500, UserRole::PrintMaster, 'print_master');
        static::insertUser(500, UserRole::Admin, 'admin');
        static::insertUser(1, UserRole::Superuser, 'superuser');
    }
}
