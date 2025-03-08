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
    protected $default_cj_password = 'cjRojo@1';
    protected $default_steve_password = 'steveSmith@1';
    protected $default_jaermaine_password = "jaermaineDomingcil@1";
    protected $default_romuel_password = "romuelBorja@1";
    protected $default_admin_password = 'admin@1';

    public function run(): void
    {
        User::create([
            'email' => 'cj.rojo@uni.edu.com',
            'password' => $this->default_cj_password,
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

        User::create([
            'email' => 'jaermaine.domingcil@uni.edu.com',
            'password' => $this->default_jaermaine_password,
            'role' => 'student',
        ]);

        User::create([
            'email' => 'romuel.borja@uni.edu.com',
            'password' => $this->default_romuel_password,
            'role' => 'student',
        ]);

        User::create([
            'email' => 'admin@secret.email.com',
            'password' => $this->default_admin_password,
            'role' => 'admin',
        ]);
    }
}
