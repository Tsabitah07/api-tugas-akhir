<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ArticleCategory;
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
            'grade_name' => 'Animasi 2D'
        ]);

        Grade::create([
            'grade_name' => 'Design Grafis'
        ]);

        Grade::create([
            'grade_name' => 'Teknik Grafika'
        ]);

        CounselingStatus::create([
            'status' => 'Menunggu Konfirmasi'
        ]);

        CounselingStatus::create([
            'status' => 'Akan Datang'
        ]);

        CounselingStatus::create([
            'status' => 'Jadwal Ulang'
        ]);

        CounselingStatus::create([
            'status' => 'Selesai'
        ]);

        CounselingStatus::create([
            'status' => 'Dibatalkan'
        ]);

        CounselingStatus::create([
            'status' => 'Tidak Hadir'
        ]);

        DataService::create([
            'name' => 'Konseling Individu',
            'description' => 'Konseling individu adalah konsultasi yang dilakukan oleh satu individu dengan seorang konselor dan membahas masalah yang dihadapi oleh individu tersebut.'
        ]);

        DataService::create([
            'name' => 'Konseling Kelompok',
            'description' => 'Konseling kelompok adalah konsultasi yang dilakukan oleh beberapa individu dengan seorang konselor dan membahas masalah yang dihadapi oleh individu tersebut.'
        ]);

        DataService::create([
            'name' => 'Bimbingan Kelompok',
            'description' => 'Bimbingan kelompok adalah konsultasi yang dilakukan oleh beberapa individu dengan konselor dan membahas masalah yang umum yang terjadi di dunia.'
        ]);

        DataService::create([
            'name' => 'Bimbingan Individu',
            'description' => 'Bimbingan individu adalah konsultasi yang dilakukan oleh satu individu dengan seorang konselor dan membahas masalah yang umum yang terjadi di dunia.'
        ]);

        DataService::create([
            'name' => 'Layanan Klasikal',
            'description' => 'Layanan klasikal adalah layanan yang dilakukan oleh seorang konselor dengan seorang klien. Layanan klasikal adalah layanan yang dilakukan oleh seorang konselor dengan seorang klien.'
        ]);

        DataCategory::create([
            'name' => 'Konseling Pribadi',
            'description' => 'Konseling pribadi adalah konsultasi yang membahas masalah pribadi seseorang, seperti masalah keluarga, masalah kesehatan, dan lain-lain.'
        ]);

        DataCategory::create([
            'name' => 'Konseling Karir',
            'description' => 'Konseling karir adalah konsultasi yang membahas masalah karir seseorang, seperti masalah pekerjaan.'
        ]);

        DataCategory::create([
            'name' => 'Konseling Belajar',
            'description' => 'Konseling belajar adalah konsultasi yang membahas masalah terkait pembelajaran seseorang, seperti masalah belajar di sekolah maupun diluar sekolah.'
        ]);

        DataCategory::create([
            'name' => 'Konseling Sosial',
            'description' => 'Konseling sosial adalah konsultasi yang membahas masalah kehidupan sosial seseorang, seperti masalah pertemanan dan masalah dengan masyarakat sekitar.'
        ]);

        ArticleCategory::create([
            'category_name' => 'Kesehatan Mental'
        ]);

        ArticleCategory::create([
            'category_name' => 'Teknik Terapi'
        ]);

        ArticleCategory::create([
            'category_name' => 'Psikologi Anak'
        ]);

        ArticleCategory::create([
            'category_name' => 'Psikologi Klinis'
        ]);

        ArticleCategory::create([
            'category_name' => 'Strategi Konseling'
        ]);

        ArticleCategory::create([
            'category_name' => 'Kesejahteraan Emosional'
        ]);

        ArticleCategory::create([
            'category_name' => 'Terapi Perilaku'
        ]);

        ArticleCategory::create([
            'category_name' => 'Manajemen Stres'
        ]);

        ArticleCategory::create([
            'category_name' => 'Psikologi Kognitif'
        ]);

        ArticleCategory::create([
            'category_name' => 'Terapi Keluarga'
        ]);

        ArticleCategory::create([
            'category_name' => 'Gangguan Psikologis'
        ]);

        ArticleCategory::create([
            'category_name' => 'Pengembangan Diri'
        ]);

        ArticleCategory::create([
            'category_name' => 'Mindfulness'
        ]);

        ArticleCategory::create([
            'category_name' => 'Trauma dan PTSD'
        ]);

        ArticleCategory::create([
            'category_name' => 'Terapi Kelompok'
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
