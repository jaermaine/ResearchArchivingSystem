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
            'role' => 'adviser',
        ]);

        User::create([
            'email' => 'steve.smith@uni.edu.com',
            'password' => $this->default_steve_password,
            'role' => 'adviser',
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

        $default_student_password = 'johnDoe@1';
        User::create([
            'email' => 'john.doe@uni.edu.com',
            'password' => $default_student_password,
            'role' => 'student',
        ]);

        $default_student_password = 'janeSmith@1';
        User::create([
            'email' => 'jane.smith@uni.edu.com',
            'password' => $default_student_password,
            'role' => 'student',
        ]);

        $default_student_password = 'davidLee@1';
        User::create([
            'email' => 'david.lee@uni.edu.com',
            'password' => $default_student_password,
            'role' => 'student',
        ]);

        $default_student_password = 'emilyBrown@1';
        User::create([
            'email' => 'emily.brown@uni.edu.com',
            'password' => $default_student_password,
            'role' => 'student',
        ]);

        $default_student_password = 'michaelWilson@1';
        User::create([
            'email' => 'michael.wilson@uni.edu.com',
            'password' => $default_student_password,
            'role' => 'student',
        ]);

        // Users (Advisers)
        $default_adviser_password = 'robertGarcia@1';
        User::create([
            'email' => 'robert.garcia@uni.edu.com',
            'password' => $default_adviser_password,
            'role' => 'adviser',
        ]);

        $default_adviser_password = 'lindaRodriguez@1';
        User::create([
            'email' => 'linda.rodriguez@uni.edu.com',
            'password' => $default_adviser_password,
            'role' => 'adviser',
        ]);

        $default_adviser_password = 'williamMartinez@1';
        User::create([
            'email' => 'william.martinez@uni.edu.com',
            'password' => $default_adviser_password,
            'role' => 'adviser',
        ]);

        $default_adviser_password = 'barbaraAnderson@1';
        User::create([
            'email' => 'barbara.anderson@uni.edu.com',
            'password' => $default_adviser_password,
            'role' => 'adviser',
        ]);

        $default_adviser_password = 'jamesThomas@1';
        User::create([
            'email' => 'james.thomas@uni.edu.com',
            'password' => $default_adviser_password,
            'role' => 'adviser',
        ]);
    }
}
