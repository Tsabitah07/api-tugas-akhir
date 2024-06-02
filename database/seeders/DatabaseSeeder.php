<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\CounselingStatus;
use App\Models\Grade;
use App\Models\User;
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

        CounselingStatus::create([
            'status' => 'Pending'
        ]);

        CounselingStatus::create([
            'status' => 'Success'
        ]);

        CounselingStatus::create([
            'status' => 'Failed'
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@ruscarestudent.com',
            'password' => bcrypt('admin123'),
            'role_id' => 1
        ]);

        User::create([
            'name' => 'bk_anim3D',
            'email' => 'bk_anim3d@ruscarestudent.com',
            'password' => bcrypt('anim3d'),
            'role_id' => 2
        ]);

        User::create([
            'name' => 'bk_anim2D',
            'email' => 'bk_anim2d@ruscarestudent.com',
            'password' => bcrypt('anim2d'),
            'role_id' => 2
        ]);

        User::create([
            'name' => 'bk_pplg',
            'email' => 'bk_pplg@ruscarestudent.com',
            'password' => bcrypt('pplg'),
            'role_id' => 2
        ]);

        User::create([
            'name' => 'bk_designGrafis',
            'email' => 'bk_dg@ruscarestudent.com',
            'password' => bcrypt('dg'),
            'role_id' => 2
        ]);

        User::create([
            'name' => 'bk_teknikGrafika',
            'email' => 'bk_tg@ruscarestudent.com',
            'password' => bcrypt('tg'),
            'role_id' => 2
        ]);
    }
}
