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
            'name' => 'Procurement'
        ]);
        Division::create([
            'name' => 'Finance'
        ]);
        Division::create([
            'name' => 'IT'
        ]);


        for ($i = 1; $i <= 40; $i++) {
            User::create([
                'username' => 'user' . $i,
                'password' => bcrypt('user' . $i),
                'role' => 'user',
                'division_id' => ceil($i / 10)
            ]);
        }

        User::create([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'role' => 'admin',
            'division_id' => 4
        ]);
    }
}
