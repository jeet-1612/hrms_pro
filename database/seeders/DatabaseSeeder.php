<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@hrms.com',
            'password' => Hash::make('Jeet@1234'),
            'role' => 'admin',
            'phone' => '9876543210',
        ]);
        
        // Create departments
        $departments = [
            ['name' => 'Information Technology', 'code' => 'IT'],
            ['name' => 'Human Resources', 'code' => 'HR'],
            ['name' => 'Finance', 'code' => 'FIN'],
            ['name' => 'Marketing', 'code' => 'MKT'],
            ['name' => 'Sales', 'code' => 'SAL'],
        ];

        foreach($departments as $dept){
            Department::create($dept);
        }

        // Create designations
        $designations = [
            ['title' => 'Software Engineer', 'department_id' => 1],
            ['title' => 'Senior Software Engineer', 'department_id' => 1],
            ['title' => 'HR Manager', 'department_id' => 2],
            ['title' => 'Finance Manager', 'department_id' => 3],
            ['title' => 'Marketing Executive', 'department_id' => 4],
        ];

        foreach($designations as $desig){
            Designation::create($desig);
        }

        // Create 50 employees
        Employee::factory()->count(50)->create();
    }
}
