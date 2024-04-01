<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Grade;
use Illuminate\Database\Seeder;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //ROLE
        Role::create([
            'role_name' => 'admin'
        ]);

        Role::create([
            'role_name' => 'bk'
        ]);

        Role::create([
            'role_name' => 'student'
        ]);

        Role::create([
            'role_name' => 'guest'
        ]);

         //GRADE
        Grade::create([
            'grade_name' => 'PPLG'
        ]);

        Grade::create([
            'grade_name' => 'Animasi 3D'
        ]);

        Grade::create([
            'grade_name' => 'Animmasi 2D'
        ]);

        Grade::create([
            'grade_name' => 'Design Grafis'
        ]);

        Grade::create([
            'grade_name' => 'Teknik Grafika'
        ]);
    }
}
