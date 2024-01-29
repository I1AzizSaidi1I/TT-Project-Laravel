<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {

        Role::create([
            'title' => 'Admin',
        ]);

        Role::create([
            'title' => 'Client',
        ]);

        Role::create([
            'title' => 'Employee',
        ]);
    }
}
