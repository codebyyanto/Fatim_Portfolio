# 🚀 Portfolio Website - Fatimah Lailatul Azzahra

Website Portfolio modern yang dibangun menggunakan Framework **Laravel**, dirancang untuk menampilkan profil profesional, keahlian, dan portofolio proyek secara dinamis dan elegan.

Proyek ini merupakan hasil migrasi dan pengembangan lanjut dari website PHP Native, kini dilengkapi dengan fitur manajemen konten (admin), desain responsif berbasis Tailwind CSS, dan optimasi performa menggunakan Vite.

## ✨ Fitur Unggulan

### 1. 🎨 Dynamic Portfolio & Profile
- **Hero Section**: Menampilkan perkenalan diri dengan animasi halus.
- **Section Skills**: Menampilkan daftar keahlian dengan badge kategori berwarna warni.
- **Section Projects**: Galeri proyek dengan layout grid responsif.
- **Footer Cerdas**: Link sosial media yang terintegrasi (WhatsApp, LinkedIn, GitHub, dll).

### 2. 🛠️ Manajemen Keahlian (Skills Management)
Fitur lengkap untuk mengelola skill yang ditampilkan di halaman depan:
- **CRUD Lengkap**: Tambah, Edit, Hapus, dan Lihat daftar keahlian.
- **Kategori Bervariasi**: Skill dikelompokkan (Programming Language, Web Dev, Tools, dll) dengan badge warna otomatis.
- **Icon Support**: Mendukung upload logo/icon untuk setiap skill.
- **Validasi Data**: Memastikan nama skill unik dan data lengkap sebelum disimpan.

### 3. 🎬 Manajemen Proyek (Advanced Project Management)
Sistem pengelolaan portofolio proyek yang canggih:
- **Hybrid Video System (Baru!)**:
    - **Upload Video**: Mendukung upload file video langsung ke server (Max 200MB).
    - **Link YouTube**: Hemat penyimpanan server dengan menautkan link YouTube.
    - **Smart Detection**: Sistem otomatis mendeteksi sumber dan menampilkan Player yang sesuai.
- **Rich Media**: Upload thumbnail gambar resolusi tinggi.
- **Detail Lengkap**: Mencakup nama tim, durasi, jenis proyek, dan deskripsi detail.
- **Status Toggle**: Sembunyikan proyek sementara tanpa menghapusnya.

### 4. ⚡ Teknologi & Performa
- **Tailwind CSS v3**: Styling modern menggunakan utility-first framework.
- **Vite Integration**: Asset bundling super cepat untuk CSS dan JS.
- **Responsive Design**: Tampilan optimal di Desktop, Tablet, dan Mobile.
- **Font Awesome 6**: Ikon vektor berkualitas tinggi.

---

## 🛠 Teknologi Utama

| Komponen | Teknologi |
|----------|-----------|
| **Framework** | Laravel 11.x |
| **Language** | PHP 8.2+ |
| **Database** | MySQL |
| **Styling** | Tailwind CSS |
| **Asset Bundler** | Vite |
| **Icons** | Font Awesome 6 |

---

## 🚀 Panduan Instalasi (Local)

Ikuti langkah ini untuk menjalankan project di komputer Anda:

1.  **Clone Repository**
    ```bash
    git clone https://github.com/username/laravel_portfolio.git
    cd laravel_portfolio
    ```

2.  **Instal Dependencies**
    ```bash
    composer install
    npm install
    ```

3.  **Konfigurasi Environment**
    - Copy file `.env.example` menjadi `.env`.
    - Sesuaikan koneksi database Anda:
    ```env
    DB_DATABASE= **nama database yang sudah dibuat di phpmyadmin**
    DB_USERNAME= **username database**
    DB_PASSWORD= **password database**
    ```

4.  **Siapkan Database**
    ```bash
    php artisan key:generate
    php artisan migrate
    php artisan db:seed
    php artisan storage:link
    ```
    > **Note**: Perintah `db:seed` akan mengisi database dengan data contoh (Proyek & Keahlian) agar website tidak kosong saat pertama kali dijalankan.

5.  **Jalankan Aplikasi**
    Buka 2 terminal terpisah:
    - Terminal 1 (Backend):
      ```bash
      php artisan serve
      ```
    - Terminal 2 (Frontend Build/Watch):
      ```bash
      npm run dev
      ```

6.  **Selesai!**
    Buka `http://localhost:8000` di browser.

---

<center>
    <p>Dibuat dengan ❤️ oleh <b>Fatimah Lailatul Azzahra</b> (23312241)</p>
    <p>&copy; 2026 All Rights Reserved.</p>
</center>
