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
        Skill::updateOrCreate(['nama_keahlian' => 'Graphic Design'], [
            'nama_keahlian' => 'Graphic Design',
            'deskripsi' => 'Desain grafis untuk berbagai media digital dan cetak menggunakan tools profesional',
            'icon' => 'uploads/icons/68ff7c58ae26d_1761573976.svg',
            'status' => 'active',
            // 'kategori_23312241' => 'Design', // Uncomment if you want to seed categories
        ]);
        
        Skill::updateOrCreate(['nama_keahlian' => 'Database Management'], [
            'nama_keahlian' => 'Database Management',
            'deskripsi' => 'Manajemen dan administrasi database menggunakan MySQL, PostgreSQL',
            'icon' => 'uploads/icons/6903bb7f471d1_1761852287.svg',
            'status' => 'active',
        ]);

        Skill::updateOrCreate(['nama_keahlian' => 'Mobile Development'], [
            'nama_keahlian' => 'Mobile Development',
            'deskripsi' => 'Pengembangan aplikasi mobile untuk platform Android dan iOS',
            'icon' => 'bi-phone',
            'status' => 'active',
        ]);

        Skill::updateOrCreate(['nama_keahlian' => 'Fotografi'], [
            'nama_keahlian' => 'Fotografi',
            'deskripsi' => 'Mengambil gambar atau video',
            'icon' => 'uploads/icons/6903b8d4d873c_1761851604.svg',
            'status' => 'active',
        ]);

        // Seed Projects
        Project::updateOrCreate(['nama_proyek' => 'Game MAM SEHAT'], [
            'nama_proyek' => 'Game MAM SEHAT',
            'tahun_proyek' => '2024',
            'jenis_proyek' => 'Tugas Kuliah',
            'tim_pengembang' => 'Yanto, Fatimah Lailatul Azzahra, Sabrina Az-Zahra, Vercha Nandita Putri',
            'deskripsi' => 'Game Mam Sehat adalah permainan edukatif yang dibuat menggunakan Construct 2, dirancang untuk anak usia 6–10 tahun agar belajar mengenali dan memilih makanan sehat dengan cara yang menyenangkan.',
            'durasi' => '3 Bulan',
            'gambar' => 'uploads/projects/68ff71bfb1448_1761571263.png',
            'video_demo' => 'uploads/videos/68ff7ffc62e38_1761574908.mp4',
            'status' => 'active',
        ]);

        Project::updateOrCreate(['nama_proyek' => 'PINTAR MATH'], [
            'nama_proyek' => 'PINTAR MATH',
            'tahun_proyek' => '2024',
            'jenis_proyek' => 'Tugas Kuliah',
            'tim_pengembang' => 'Yanto, Fatimah Lailatul Azzahra, Sabrina Az-Zahra',
            'deskripsi' => "Pintar Math adalah aplikasi edukasi berbasis Android yang dikembangkan menggunakan Kotlin untuk membantu siswa belajar matematika secara interaktif dan menyenangkan.",
            'durasi' => '3 Bulan',
            'gambar' => 'uploads/projects/68ff83f9cae5e_1761575929.png',
            'video_demo' => '',
            'status' => 'active',
        ]);
    }
}
