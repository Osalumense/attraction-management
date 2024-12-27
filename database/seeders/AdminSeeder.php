<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\SUpport\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            // Admin
            [
                'name' => 'Super Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('AdminP8ssw0rd'),
                'role' => 'admin',
            ],

            // User
            [
                'name' => 'Test user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('AdminP8ssw0rd'),
                'role' => 'user',
            ]
        ]);  
    }
}
