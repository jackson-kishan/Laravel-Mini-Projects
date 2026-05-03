<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    //    $this->call([
    //     DefaultUserSeeder::class,
    //    ]);
       User::create([
        'name' => 'super admin',
        'email' => 'admin@admin.com',
        'password' => 'admin1234',
        'is_admin' => 1,
       ]);
    }
}
