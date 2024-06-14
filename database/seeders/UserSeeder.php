<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear the users table
        DB::table('users')->truncate();

        $batchSize = 1000; // Number of users to insert per batch
        $totalUsers = 100000; // Total number of users to insert
        $users = [];

        for ($i = 0; $i < $totalUsers; $i++) {
            $users[] = [
                'name' => 'User ' . ($i + 1),
                'email' => 'user' . ($i + 1) . '@example.com',
                'is_verified' => (bool)random_int(0, 1),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (count($users) >= $batchSize) {
                DB::table('users')->insert($users);
                Log::info('Inserted batch of users, current total: ' . ($i + 1));
                $users = []; // Reset the array for the next batch
                gc_collect_cycles(); // Force garbage collection to free memory
            }
        }

        // Insert any remaining users
        if (count($users) > 0) {
            DB::table('users')->insert($users);
            Log::info('Inserted final batch of users, total: ' . $totalUsers);
        }
    }
}
