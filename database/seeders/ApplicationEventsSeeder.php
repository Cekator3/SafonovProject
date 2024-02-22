<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicationEventsSeeder extends Seeder
{
    private function insertApplicationEvent(int $amount)
    {
        for ($i = 0; $i < $amount; $i++) 
        {
            try
            {
                DB::table('application_events')->insert([
                    'user_id' => random_int(1, 10),
                    'type' => fake()->text(20),
                    'description' => fake()->text(20),
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
        static::insertApplicationEvent(1000);
    }
}
