<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

     
    protected $default_admin_password = 'admin@1';

    public function run(): void
    {
        Admin::create([
            'user_id' => 6,
            'first_name' => 'Super',
            'last_name' => 'Admin',
        ]);
    }
}
