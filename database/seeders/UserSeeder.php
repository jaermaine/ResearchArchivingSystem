<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $default_jane_password = 'janeDoe@1';
    protected $default_john_password = 'johnDoe@1';
    protected $default_steve_password = 'steveSmith@1';

    public function run(): void
    {
        User::create([
            'email' => 'john.doe@uni.edu.com',
            'password' => $this->default_john_password,
            'role' => 'student',
        ]);
        User::create([
            'email' => 'jane.doe@uni.edu.com',
            'password' => $this->default_jane_password,
            'role' => 'faculty',
        ]);

        User::create([
            'email' => 'steve.smith@uni.edu.com',
            'password' => $this->default_steve_password,
            'role' => 'faculty',
        ]);
    }
}
