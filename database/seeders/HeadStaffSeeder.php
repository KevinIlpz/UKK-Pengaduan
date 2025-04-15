<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class HeadStaffSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Head Staff',
            'email' => 'headstaff@example.com',
            'password' => Hash::make('password'),
            'role' => 'head_staff',
        ]);
    }
}
