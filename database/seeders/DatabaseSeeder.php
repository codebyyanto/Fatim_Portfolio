<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;
use App\Models\Project;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed Skills
        Skill::updateOrCreate(['name' => 'Graphic Design'], [
            'name' => 'Graphic Design',
            'description' => 'Desain grafis untuk berbagai media digital dan cetak menggunakan tools profesional',
            'icon' => 'uploads/icons/68ff7c58ae26d_1761573976.svg', // Will need to ensure file exists or map to new path
            'status' => 'active',
        ]);
        
        Skill::updateOrCreate(['name' => 'Database Management'], [
            'name' => 'Database Management',
            'description' => 'Manajemen dan administrasi database menggunakan MySQL, PostgreSQL',
            'icon' => 'uploads/icons/6903bb7f471d1_1761852287.svg',
            'status' => 'active',
        ]);

        Skill::updateOrCreate(['name' => 'Mobile Development'], [
            'name' => 'Mobile Development',
            'description' => 'Pengembangan aplikasi mobile untuk platform Android dan iOS',
            'icon' => 'bi-phone', // This was a class name IIRC
            'status' => 'active',
        ]);

        Skill::updateOrCreate(['name' => 'Fotografi'], [
            'name' => 'Fotografi',
            'description' => 'Mengambil gambar atau video',
            'icon' => 'uploads/icons/6903b8d4d873c_1761851604.svg',
            'status' => 'active',
        ]);

        // Seed Projects
        Project::updateOrCreate(['name' => 'Game MAM SEHAT'], [
            'name' => 'Game MAM SEHAT',
            'year' => '2024',
            'type' => 'Tugas Kuliah',
            'team' => 'Yanto, Fatimah Lailatul Azzahra, Sabrina Az-Zahra, Vercha Nandita Putri',
            'description' => 'Game Mam Sehat adalah permainan edukatif yang dibuat menggunakan Construct 2, dirancang untuk anak usia 6–10 tahun agar belajar mengenali dan memilih makanan sehat dengan cara yang menyenangkan. Dalam game ini, pemain berperan sebagai seorang ibu yang harus menangkap berbagai jenis makanan bergizi sambil menghindari makanan tidak sehat untuk mendapatkan skor tertinggi. Melalui visual yang cerah, karakter lucu, dan gameplay sederhana, Mam Sehat membantu anak memahami pentingnya pola makan seimbang serta menumbuhkan kebiasaan hidup sehat sejak dini.',
            'duration' => '3',
            'image' => 'uploads/projects/68ff71bfb1448_1761571263.png',
            'video' => 'uploads/videos/68ff7ffc62e38_1761574908.mp4',
            'status' => 'active',
        ]);

        Project::updateOrCreate(['name' => 'PINTAR MATH'], [
            'name' => 'PINTAR MATH',
            'year' => '2024',
            'type' => 'Tugas Kuliah',
            'team' => 'Yanto, Fatimah Lailatul Azzahra, Sabrina Az-Zahra',
            'description' => "Pintar Math adalah aplikasi edukasi berbasis Android yang dikembangkan menggunakan Kotlin untuk membantu siswa belajar matematika secara interaktif dan menyenangkan. Aplikasi ini dirancang dengan antarmuka yang sederhana dan intuitif, dilengkapi dengan fitur latihan soal, kuis otomatis, pembahasan langkah demi langkah, serta permainan edukatif yang melatih logika dan kecepatan berpikir. Setiap pengguna dapat memilih tingkat kesulitan sesuai kemampuan, sehingga aplikasi ini cocok digunakan oleh siswa dari tingkat dasar hingga menengah.\n\nDibangun dengan Android Studio dan memanfaatkan Material Design Components, Pintar Math menghadirkan tampilan modern dan responsif. Aplikasi ini juga menggunakan Room Database untuk menyimpan data hasil belajar secara lokal serta sistem notifikasi cerdas untuk mengingatkan pengguna agar berlatih secara rutin. Dengan kombinasi teknologi dan pendekatan pembelajaran adaptif, Pintar Math menjadikan proses belajar matematika lebih menarik, efisien, dan relevan bagi pelajar di era digital.",
            'duration' => '3',
            'image' => 'uploads/projects/68ff83f9cae5e_1761575929.png',
            'video' => '',
            'status' => 'active',
        ]);
    }
}
