@extends('layouts.app')

@section('content')
<div class="flex flex-col lg:flex-row gap-8">
    <!-- Sidebar -->
    <aside id="sidebar" class="lg:w-1/4 bg-white rounded-2xl shadow-lg p-6 lg:sticky lg:top-8 transform lg:translate-x-0 transition-transform duration-300 fixed left-0 top-0 h-full w-80 z-50 -translate-x-full lg:relative">
        <h3 class="text-xl font-bold text-blue-600 mb-6 pb-4 border-b-2 border-blue-200">Menu</h3>
        <nav class="space-y-2">
            <a href="#data-diri" class="flex items-center gap-3 p-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-all duration-200 menu-link">
                <i class="fas fa-user w-6 text-center"></i>
                <span>Data Diri</span>
            </a>
            <a href="#riwayat-sekolah" class="flex items-center gap-3 p-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-all duration-200 menu-link">
                <i class="fas fa-graduation-cap w-6 text-center"></i>
                <span>Riwayat Sekolah</span>
            </a>
            <a href="#riwayat-organisasi" class="flex items-center gap-3 p-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-all duration-200 menu-link">
                <i class="fas fa-users w-6 text-center"></i>
                <span>Riwayat Organisasi</span>
            </a>
            <a href="#riwayat-kegiatan" class="flex items-center gap-3 p-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-all duration-200 menu-link">
                <i class="fas fa-trophy w-6 text-center"></i>
                <span>Riwayat Kegiatan</span>
            </a>
            <a href="#riwayat-proyek" class="flex items-center gap-3 p-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-all duration-200 menu-link">
                <i class="fas fa-folder w-6 text-center"></i>
                <span>Riwayat Proyek</span>
            </a>
            <a href="#daftar-keahlian" class="flex items-center gap-3 p-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-all duration-200 menu-link">
                <i class="fas fa-star w-6 text-center"></i>
                <span>Daftar Keahlian</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="lg:w-3/4 space-y-8">
        <!-- Data Diri -->
        <section id="data-diri" class="bg-white rounded-2xl shadow-lg p-8 scroll-mt-8">
            <h2 class="text-3xl font-bold text-blue-600 mb-6 pb-4 border-b-2 border-blue-200 flex items-center gap-3">
                <i class="fas fa-id-badge"></i>
                Data Diri
            </h2>
            
            <div class="flex flex-col md:flex-row items-center gap-8 mb-8 p-6 bg-blue-50 rounded-xl">
                <div class="w-32 h-32 bg-gradient-to-r from-blue-600 to-blue-500 rounded-full flex items-center justify-center text-white text-5xl font-bold shadow-lg overflow-hidden">
                    <!-- Update asset path -->
                    <img src="{{ asset('assets/img/profil.png') }}" alt="Foto Profil" class="w-full h-full rounded-full object-cover">
                </div>
                <div class="text-center md:text-left">
                    <h2 class="text-2xl font-bold text-gray-800">Fatimah Lailatul Azzahra</h2>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-4 bg-gray-50 rounded-xl border-l-4 border-blue-500">
                    <div class="text-sm text-gray-600 font-semibold mb-2">Nama Lengkap</div>
                    <div class="font-semibold text-gray-800">Fatimah Lailatul Azzahra</div>
                </div>
                <div class="p-4 bg-gray-50 rounded-xl border-l-4 border-blue-500">
                    <div class="text-sm text-gray-600 font-semibold mb-2">Jenis Kelamin</div>
                    <div class="font-semibold text-gray-800">Perempuan</div>
                </div>
                <div class="p-4 bg-gray-50 rounded-xl border-l-4 border-blue-500">
                    <div class="text-sm text-gray-600 font-semibold mb-2">Tempat, Tanggal Lahir</div>
                    <div class="font-semibold text-gray-800">Kota Agung, 04 Maret 2005</div>
                </div>
                <div class="p-4 bg-gray-50 rounded-xl border-l-4 border-blue-500">
                    <div class="text-sm text-gray-600 font-semibold mb-2">No. Telp/WA</div>
                    <div class="font-semibold text-gray-800">+62 895-0611-3401</div>
                </div>
                <div class="p-4 bg-gray-50 rounded-xl border-l-4 border-blue-500">
                    <div class="text-sm text-gray-600 font-semibold mb-2">Email</div>
                    <div class="font-semibold text-gray-800">fatimah_lailatul_azzahara@teknokrat.ac.id</div>
                </div>
                <div class="p-4 bg-gray-50 rounded-xl border-l-4 border-blue-500">
                    <div class="text-sm text-gray-600 font-semibold mb-2">Alamat</div>
                    <div class="font-semibold text-gray-800">Labuhan Ratu, Bandar Lampung, Indonesia</div>
                </div>
            </div>
        </section>

        <!-- Riwayat Sekolah -->
        <section id="riwayat-sekolah" class="bg-white rounded-2xl shadow-lg p-8 scroll-mt-8">
            <h2 class="text-3xl font-bold text-blue-600 mb-6 pb-4 border-b-2 border-blue-200 flex items-center gap-3">
                <i class="fas fa-graduation-cap"></i>
                Riwayat Pendidikan
            </h2>
            
            <div class="space-y-6">
                <div class="p-6 bg-gray-50 rounded-xl border-l-4 border-blue-500 hover:translate-x-2 transition-transform duration-200">
                    <h4 class="text-xl font-bold text-blue-600 mb-2">Universitas Teknokrat Indonesia</h4>
                    <p class="text-gray-600 font-semibold mb-2">2023 - Sekarang</p>
                    <p class="text-gray-800">Program Studi Informatika - S1</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-xl border-l-4 border-blue-500 hover:translate-x-2 transition-transform duration-200">
                    <h4 class="text-xl font-bold text-blue-600 mb-2">SMA Negeri 1 Kota Agung</h4>
                    <p class="text-gray-600 font-semibold mb-2">2020 - 2023</p>
                    <p class="text-gray-800">Jurusan IPA</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-xl border-l-4 border-blue-500 hover:translate-x-2 transition-transform duration-200">
                    <h4 class="text-xl font-bold text-blue-600 mb-2">MTS Negeri 1 Tanggamus</h4>
                    <p class="text-gray-600 font-semibold mb-2">2017 - 2020</p>
                    <p class="text-gray-800">Madrasah Tsanawiyah Negeri</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-xl border-l-4 border-blue-500 hover:translate-x-2 transition-transform duration-200">
                    <h4 class="text-xl font-bold text-blue-600 mb-2">SD Negeri 3 Kota Agung</h4>
                    <p class="text-gray-600 font-semibold mb-2">2011 - 2017</p>
                    <p class="text-gray-800">Sekolah Dasar</p>
                </div>
            </div>
        </section>

        <!-- Riwayat Organisasi -->
        <section id="riwayat-organisasi" class="bg-white rounded-2xl shadow-lg p-8 scroll-mt-8">
            <h2 class="text-3xl font-bold text-blue-600 mb-6 pb-4 border-b-2 border-blue-200 flex items-center gap-3">
                <i class="fas fa-users"></i>
                Riwayat Organisasi
            </h2>
            
            <div class="space-y-6">
                <div class="p-6 bg-gray-50 rounded-xl border-l-4 border-blue-500 hover:translate-x-2 transition-transform duration-200">
                    <h4 class="text-xl font-bold text-blue-600 mb-2">Anggota Ikatan Beasiswa Teknokrat (IBATEK)</h4>
                    <p class="text-gray-600 font-semibold mb-2">Universitas Teknokrat Indonesia | 2023 - Sekarang</p>
                    <p class="text-gray-800">Anggota Aktif Tetap</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-xl border-l-4 border-blue-500 hover:translate-x-2 transition-transform duration-200">
                    <h4 class="text-xl font-bold text-blue-600 mb-2">OSIS MTS Negeri 1 Tanggamus</h4>
                    <p class="text-gray-600 font-semibold mb-2">SMA | 2018 - 2019</p>
                    <p class="text-gray-800">Bidang Kerja Sama</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-xl border-l-4 border-blue-500 hover:translate-x-2 transition-transform duration-200">
                    <h4 class="text-xl font-bold text-blue-600 mb-2">Pramuka SMA Negeri 1 Kota Agung</h4>
                    <p class="text-gray-600 font-semibold mb-2">SMA | 2020 - 2022</p>
                    <p class="text-gray-800">Anggota Aktif</p>
                </div>
            </div>
        </section>

        <!-- Riwayat Kegiatan -->
        <section id="riwayat-kegiatan" class="bg-white rounded-2xl shadow-lg p-8 scroll-mt-8">
            <h2 class="text-3xl font-bold text-blue-600 mb-6 pb-4 border-b-2 border-blue-200 flex items-center gap-3">
                <i class="fas fa-trophy"></i>
                Riwayat Kegiatan
            </h2>
            
            <div class="space-y-6">
                <div class="p-6 bg-gray-50 rounded-xl border-l-4 border-blue-500 hover:translate-x-2 transition-transform duration-200">
                    <h4 class="text-xl font-bold text-blue-600 mb-2">Tari Wisuda Teknokrat Indonesia</h4>
                    <p class="text-gray-600 font-semibold mb-2">2023</p>
                    <p class="text-gray-800">Penari Khas Batak</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-xl border-l-4 border-blue-500 hover:translate-x-2 transition-transform duration-200">
                    <h4 class="text-xl font-bold text-blue-600 mb-2">Tari di Acara L2DIKTI</h4>
                    <p class="text-gray-600 font-semibold mb-2">2023</p>
                    <p class="text-gray-800">Penari Khas Batak</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-xl border-l-4 border-blue-500 hover:translate-x-2 transition-transform duration-200">
                    <h4 class="text-xl font-bold text-blue-600 mb-2">Seminar AI KOMDIGI</h4>
                    <p class="text-gray-600 font-semibold mb-2">2024</p>
                    <p class="text-gray-800">Peserta</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-xl border-l-4 border-blue-500 hover:translate-x-2 transition-transform duration-200">
                    <h4 class="text-xl font-bold text-blue-600 mb-2">Pelatihan Junior Web Development</h4>
                    <p class="text-gray-600 font-semibold mb-2">2024</p>
                    <p class="text-gray-800">Peserta</p>
                </div>
            </div>
        </section>

        <!-- Riwayat Proyek -->
        <section id="riwayat-proyek" class="bg-white rounded-2xl shadow-lg p-8 scroll-mt-8">
            <h2 class="text-3xl font-bold text-blue-600 mb-6 pb-4 border-b-2 border-blue-200 flex items-center gap-3">
                <i class="fas fa-folder"></i>
                Riwayat Proyek
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($projects as $project)
                <div class="bg-gray-50 rounded-xl p-6 border-t-4 border-blue-500 hover:-translate-y-2 transition-all duration-200 shadow-md">
                    <h4 class="text-xl font-bold text-blue-600 mb-3">{{ $project->nama_proyek }}</h4>
                    <p class="text-gray-600 line-clamp-4 mb-4">
                        {{ $project->deskripsi }}
                    </p>
                    <div class="space-y-2 text-sm mb-4">
                        <p><strong class="text-gray-700">Tahun:</strong> {{ $project->tahun_proyek }}</p>
                        <p><strong class="text-gray-700">Jenis:</strong> {{ $project->jenis_proyek }}</p>
                    </div>
                    <a href="{{ route('projects.show', $project->id) }}" class="inline-block w-full text-center bg-blue-100 text-blue-700 hover:bg-blue-600 hover:text-white py-2 rounded-lg transition-colors duration-200 font-semibold">
                        Lihat Detail
                    </a>
                </div>
                @empty
                <div class="col-span-3 text-center py-8">
                    <i class="fas fa-folder-open text-4xl text-gray-400 mb-4"></i>
                    <p class="text-gray-500">Belum ada proyek yang ditampilkan</p>
                </div>
                @endforelse
            </div>
            
        </section>

        <!-- Daftar Keahlian -->
        <section id="daftar-keahlian" class="bg-white rounded-2xl shadow-lg p-8 scroll-mt-8">
            <h2 class="text-3xl font-bold text-blue-600 mb-6 pb-4 border-b-2 border-blue-200 flex items-center gap-3">
                <i class="fas fa-star"></i>
                Daftar Keahlian
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
                @forelse($skills as $skill)
                <div class="bg-gradient-to-r from-blue-600 to-blue-500 text-white p-4 rounded-xl text-center font-semibold hover:scale-105 transition-transform duration-200 shadow-md">
                    @if(!empty($skill->icon) && str_starts_with($skill->icon, 'fa-'))
                        <i class="{{ $skill->icon }} mr-2"></i>
                    @elseif(!empty($skill->icon))
                        @if(Str::endsWith($skill->icon, '.svg'))
                            <img src="{{ asset('storage/' . $skill->icon) }}" class="w-8 h-8 inline-block mr-2" style="filter: brightness(0) invert(1);">
                        @else
                            <img src="{{ asset('storage/' . $skill->icon) }}" class="w-8 h-8 inline-block mr-2 rounded-full">
                        @endif
                    @else
                        <i class="fas fa-star mr-2"></i>
                    @endif
                    {{ $skill->nama_keahlian }}
                </div>
                @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-8">
                    <i class="fas fa-star text-4xl text-gray-400 mb-4"></i>
                    <p class="text-gray-500">Belum ada keahlian yang ditampilkan</p>
                </div>
                @endforelse
            </div>

            <div class="text-center space-x-4">
                <a href="{{ route('skills.index') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors duration-200 inline-flex items-center gap-2">
                    <i class="fas fa-cog"></i> Kelola Keahlian
                </a>
                <a href="{{ route('projects.index') }}" 
                   class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors duration-200 inline-flex items-center gap-2">
                    <i class="fas fa-project-diagram"></i> Kelola Proyek
                </a>
            </div>
        </section>
    </main>
</div>
@endsection

@section('footer_content')
<h3 class="text-2xl font-bold text-center mb-8">Hubungi Saya</h3>
            
<div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
    <div class="text-center">
        <i class="fab fa-whatsapp text-4xl text-green-400 mb-4"></i>
        <h4 class="text-xl font-semibold mb-2">WhatsApp</h4>
        <a href="https://wa.me/6289506113401" target="_blank" class="text-blue-200 hover:text-white transition-colors duration-200">
            +62 895-0611-3401
        </a>
    </div>
    <div class="text-center">
        <i class="fas fa-envelope text-4xl text-red-400 mb-4"></i>
        <h4 class="text-xl font-semibold mb-2">Email</h4>
        <a href="mailto:fatimah_lailatul_azzahara@teknokrat.ac.id" class="text-blue-200 hover:text-white transition-colors duration-200">
            fatimah_lailatul_azzahara@teknokrat.ac.id
        </a>
    </div>
    <div class="text-center">
        <i class="fas fa-map-marker-alt text-4xl text-yellow-400 mb-4"></i>
        <h4 class="text-xl font-semibold mb-2">Lokasi</h4>
        <p class="text-blue-200">Bandar Lampung, Indonesia</p>
    </div>
</div>

<div class="flex justify-center gap-6 mb-8 pt-8 border-t border-gray-700">
    <a href="https://instagram.com" target="_blank" 
       class="w-12 h-12 bg-gray-700 rounded-full flex items-center justify-center hover:bg-pink-600 transition-colors duration-200">
        <i class="fab fa-instagram"></i>
    </a>
    <a href="https://linkedin.com" target="_blank" 
       class="w-12 h-12 bg-gray-700 rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors duration-200">
        <i class="fab fa-linkedin-in"></i>
    </a>
    <a href="https://github.com" target="_blank" 
       class="w-12 h-12 bg-gray-700 rounded-full flex items-center justify-center hover:bg-gray-600 transition-colors duration-200">
        <i class="fab fa-github"></i>
    </a>
    <a href="https://twitter.com" target="_blank" 
       class="w-12 h-12 bg-gray-700 rounded-full flex items-center justify-center hover:bg-blue-400 transition-colors duration-200">
        <i class="fab fa-twitter"></i>
    </a>
</div>
@endsection

@push('scripts')
<script>
    // Smooth scrolling untuk menu
    document.querySelectorAll('.menu-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all links
            document.querySelectorAll('.menu-link').forEach(l => {
                l.classList.remove('bg-blue-50', 'text-blue-600');
                l.classList.add('text-gray-600', 'hover:bg-blue-50', 'hover:text-blue-600');
            });
            
            // Add active class to clicked link
            this.classList.remove('text-gray-600', 'hover:bg-blue-50', 'hover:text-blue-600');
            this.classList.add('bg-blue-50', 'text-blue-600');
            
            // Smooth scroll to section
            const targetId = this.getAttribute('href');
            // If we are not on home, redirect to home
            if (!document.querySelector(targetId)) {
                window.location.href = "{{ route('home') }}" + targetId;
                return;
            }

            const targetSection = document.querySelector(targetId);
            
            if (targetSection) {
                targetSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>
@endpush
