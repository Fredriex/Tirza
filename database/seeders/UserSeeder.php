<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat satu user
        User::create([
            'name' => 'tirza',
            'email' => 'tirza@gmail.com',
            'password' => Hash::make('1234'), 
            'role' => 'admin'
        ]);


    }
}

