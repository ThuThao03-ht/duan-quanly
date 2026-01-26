<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $dept = \App\Models\Department::create([
            'code' => 'KHTTH',
            'name' => 'Kế hoạch tổng hợp',
        ]);

        User::create([
            'name' => 'admin',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'department',
            'password' => bcrypt('password'),
            'role' => 'department',
            'department_id' => $dept->id,
        ]);
    }
}
