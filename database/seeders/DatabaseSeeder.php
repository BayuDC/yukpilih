<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Division;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        Division::create([
            'name' => 'Payment'
        ]);
        Division::create([
            'name' => 'Design'
        ]);
        Division::create([
            'name' => 'Developer'
        ]);

        User::create([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'role' => 'admin',
            'division_id' => 3
        ]);
        User::create([
            'username' => 'user',
            'password' => bcrypt('user'),
            'role' => 'user',
            'division_id' => 3
        ]);
    }
}
