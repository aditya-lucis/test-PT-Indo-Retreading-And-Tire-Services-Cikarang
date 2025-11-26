<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Administrator',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admintest123'),
                'role' => 'adm'
            ],
            [
                'name' => 'Customer',
                'email' => 'cus@cus.com',
                'password' => Hash::make('custest123'),
                'role' => 'cus'
            ]
        ]);
    }
}
