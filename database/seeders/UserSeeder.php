<?php

namespace Database\Seeders;

use App\Models\Department;
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
        $departments = Department::pluck('id', 'name');

        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'department_id' => null,
            ],
            [
                'name' => 'Student User',
                'email' => 'student@example.com',
                'password' => Hash::make('password'),
                'role' => 'student',
                'department_id' => $departments['IT'] ?? null, 
            ],
            [
                'name' => 'IT Head',
                'email' => 'it@example.com',
                'password' => Hash::make('password'),
                'role' => 'department_head',
                'department_id' => $departments['IT'] ?? null,
            ],
            [
                'name' => 'HR Head',
                'email' => 'hr@example.com',
                'password' => Hash::make('password'),
                'role' => 'department_head',
                'department_id' => $departments['HR'] ?? null,
            ],
            [
    'name' => 'Library Head',
    'email' => 'library@example.com',
    'password' => Hash::make('password'),
    'role' => 'department_head',
    'department_id' => $departments['Library'] ?? null,
],
[
    'name' => 'Accounts Head',
    'email' => 'accounts@example.com',
    'password' => Hash::make('password'),
    'role' => 'department_head',
    'department_id' => $departments['Accounts'] ?? null,
],
[
    'name' => 'Science Dept Head',
    'email' => 'science@example.com',
    'password' => Hash::make('password'),
    'role' => 'department_head',
    'department_id' => $departments['Science'] ?? null,
]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }



}
