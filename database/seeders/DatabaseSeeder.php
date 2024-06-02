<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\CounselingStatus;
use App\Models\DataCategory;
use App\Models\DataService;
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

        DataService::create([
            'name' => 'Konseling Individu',
            'description' => 'Konseling individu adalah konseling yang dilakukan oleh seorang konselor dengan seorang klien. Konseling individu adalah konseling yang dilakukan oleh seorang konselor dengan seorang klien.'
        ]);

        DataService::create([
            'name' => 'Konseling Kelompok',
            'description' => 'Konseling kelompok adalah konseling yang dilakukan oleh seorang konselor dengan beberapa klien sekaligus. Konseling kelompok adalah konseling yang dilakukan oleh seorang konselor dengan beberapa klien sekaligus.'
        ]);

        DataService::create([
            'name' => 'Bimbingan Kelompok',
            'description' => 'Bimbingan kelompok adalah bimbingan yang dilakukan oleh seorang bimbingan konselor dengan beberapa klien sekaligus. Bimbingan kelompok adalah bimbingan yang dilakukan oleh seorang bimbingan konselor dengan beberapa klien sekaligus.'
        ]);

        DataService::create([
            'name' => 'Bimbingan Individu',
            'description' => 'Bimbingan individu adalah bimbingan yang dilakukan oleh seorang bimbingan konselor dengan seorang klien. Bimbingan individu adalah bimbingan yang dilakukan oleh seorang bimbingan konselor dengan seorang klien.'
        ]);

        DataService::create([
            'name' => 'Layanan Kalsikal',
            'description' => 'Layanan kalsikal adalah layanan yang dilakukan oleh seorang konselor dengan seorang klien. Layanan kalsikal adalah layanan yang dilakukan oleh seorang konselor dengan seorang klien.'
        ]);

        DataCategory::create([
            'name' => 'Konseling Pribadi',
            'description' => 'Konseling pribadi adalah konseling yang dilakukan oleh seorang konselor dengan seorang klien. Konseling pribadi adalah konseling yang dilakukan oleh seorang konselor dengan seorang klien.'
        ]);

        DataCategory::create([
            'name' => 'Konseling Karir',
            'description' => 'Konseling karir adalah konseling yang dilakukan oleh seorang konselor dengan seorang klien. Konseling karir adalah konseling yang dilakukan oleh seorang konselor dengan seorang klien.'
        ]);

        DataCategory::create([
            'name' => 'Konseling Belajar',
            'description' => 'Konseling belajar adalah konseling yang dilakukan oleh seorang konselor dengan seorang klien. Konseling belajar adalah konseling yang dilakukan oleh seorang konselor dengan seorang klien.'
        ]);

        DataCategory::create([
            'name' => 'Konseling Social',
            'description' => 'Konseling social adalah konseling yang dilakukan oleh seorang konselor dengan seorang klien. Konseling social adalah konseling yang dilakukan oleh seorang konselor dengan seorang klien.'
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@ruscarestudent.com',
            'password' => bcrypt('admin123'),
            'role_id' => 1
        ]);

//        User::create([
//            'name' => 'bk_anim3D',
//            'email' => 'bk_anim3d@ruscarestudent.com',
//            'password' => bcrypt('anim3d'),
//            'role_id' => 2
//        ]);
//
//        User::create([
//            'name' => 'bk_anim2D',
//            'email' => 'bk_anim2d@ruscarestudent.com',
//            'password' => bcrypt('anim2d'),
//            'role_id' => 2
//        ]);
//
//        User::create([
//            'name' => 'bk_pplg',
//            'email' => 'bk_pplg@ruscarestudent.com',
//            'password' => bcrypt('pplg'),
//            'role_id' => 2
//        ]);
//
//        User::create([
//            'name' => 'bk_designGrafis',
//            'email' => 'bk_dg@ruscarestudent.com',
//            'password' => bcrypt('dg'),
//            'role_id' => 2
//        ]);
//
//        User::create([
//            'name' => 'bk_teknikGrafika',
//            'email' => 'bk_tg@ruscarestudent.com',
//            'password' => bcrypt('tg'),
//            'role_id' => 2
//        ]);
    }
}
