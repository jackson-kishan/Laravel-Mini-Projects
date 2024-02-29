<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        //Creating Super Admin User
        $superAdmin = User::create([
            'name' => 'kishan',
            'email' => 'kishan@gmail.com',
            'password' => Hash::make('kishan123')
        ]);
        $superAdmin->assignRole('Super Admin');

        $admin = User::create([
          'name' => 'admin',
          'email' => 'admin@gmail.com',
          'password' => Hash::make('admin123')
        ]);
        $admin->assignRole('Admin');

        $productManager = User::create([
            'name' => 'productManager',
            'email' => 'productManager@gmail.com',
            'password' => Hash::make('product123')
        ]);
        $productManager->assignRole('Product Manager');
    }
}
