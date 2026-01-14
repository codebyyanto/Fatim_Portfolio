<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $project->name }} - Detail Proyek</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">
    <!-- Header -->
    <header class="bg-gradient-to-r from-blue-700 to-indigo-600 text-white py-16 shadow-lg">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-3">{{ $project->name }}</h1>
            <p class="text-lg opacity-90">{{ $project->type }} • {{ $project->year }}</p>
        </div>
    </header>

    <main class="container mx-auto px-4 py-10 space-y-10">
        <!-- Tombol Kembali -->
        <div>
            <a href="{{ route('home') }}#riwayat-proyek"
               class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-200 shadow-md hover:shadow-xl">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Daftar Proyek
            </a>
        </div>

        <!-- Informasi Proyek -->
        <section class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            <h2 class="text-2xl font-bold text-blue-700 mb-6 flex items-center gap-3 border-b pb-3">
                <i class="fas fa-info-circle"></i> Informasi Proyek
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @php
                $infoFields = [
                    'Nama Proyek' => $project->name,
                    'Jenis Proyek' => $project->type,
                    'Tahun Proyek' => $project->year,
                    'Durasi Proyek' => $project->duration,
                    'Tim Pengembang' => $project->team
                ];
                @endphp
                @foreach ($infoFields as $label => $value)
                    <div class="p-5 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                        <div class="text-sm text-gray-600 font-semibold mb-1">{{ $label }}</div>
                        <div class="text-lg font-semibold text-gray-900">{{ $value }}</div>
                    </div>
                @endforeach

                <div class="p-5 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                    <div class="text-sm text-gray-600 font-semibold mb-1">Status</div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $project->status == 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $project->status == 'active' ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                </div>
            </div>
        </section>

        <!-- Deskripsi -->
        <section class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            <h2 class="text-2xl font-bold text-blue-700 mb-6 flex items-center gap-3 border-b pb-3">
                <i class="fas fa-file-alt"></i> Deskripsi Lengkap
            </h2>
            <div class="prose max-w-none leading-relaxed text-gray-700">
                @if(!empty($project->description) && $project->description !== '0')
                    {!! nl2br(e($project->description)) !!}
                @else
                    <p class='text-gray-500 italic'><i>Deskripsi proyek tidak tersedia.</i></p>
                @endif
            </div>
        </section>

        <!-- Gambar -->
        @if($project->image)
        <section class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            <h2 class="text-2xl font-bold text-blue-700 mb-6 flex items-center gap-3 border-b pb-3">
                <i class="fas fa-image"></i> Tampilan Proyek
            </h2>
            <div class="w-full bg-gray-100 rounded-xl overflow-hidden shadow-lg flex items-center justify-center group">
                <img src="{{ asset('storage/' . $project->image) }}"
                     alt="Gambar {{ $project->name }}"
                     class="max-h-96 w-auto object-contain transition-transform duration-300 group-hover:scale-105 bg-white">
            </div>
        </section>
        @endif

        <!-- Video Demo -->
        @if($project->video)
        <section class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            <h2 class="text-2xl font-bold text-blue-700 mb-6 flex items-center gap-3 border-b pb-3">
                <i class="fas fa-video"></i> Video Demo
            </h2>
            <div class="relative w-full h-0 pb-[56.25%] bg-black rounded-xl overflow-hidden shadow-lg">
                <video class="absolute top-0 left-0 w-full h-full" controls>
                    <source src="{{ asset('storage/' . $project->video) }}" type="video/mp4">
                    Browser Anda tidak mendukung pemutaran video.
                </video>
            </div>
        </section>
        @endif
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-gray-900 to-blue-900 text-white py-8 mt-10">
        <div class="container mx-auto px-4 text-center">
            <p class="text-lg font-semibold">{{ $project->name }} • {{ $project->year }}</p>
            <p class="text-gray-400 mt-2">&copy; {{ date('Y') }} Semua hak dilindungi.</p>
        </div>
    </footer>
</body>
</html>
