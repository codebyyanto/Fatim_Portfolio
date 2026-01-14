@extends('layouts.app')

@section('content')
<div class="mb-6">
    <a href="{{ route('home') }}" 
       class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors duration-200">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Portfolio
    </a>
</div>

<div class="bg-white rounded-xl shadow-lg p-6 mb-6">
    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        <form method="GET" class="relative flex-1 max-w-md">
            <div class="relative">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Cari proyek..." 
                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
            </div>
        </form>
        <button onclick="openAddModal()" 
                class="bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white px-6 py-2 rounded-lg font-semibold flex items-center gap-2 transition-all duration-200 transform hover:-translate-y-1 hover:shadow-lg">
            <i class="fas fa-plus-circle"></i>
            Tambah Proyek
        </button>
    </div>
</div>

<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full min-w-full">
            <thead>
                <tr class="bg-gradient-to-r from-blue-600 to-blue-500 text-white">
                    <th class="px-6 py-4 text-left font-semibold uppercase tracking-wider">Nama Proyek</th>
                    <th class="px-6 py-4 text-left font-semibold uppercase tracking-wider">Tahun</th>
                    <th class="px-6 py-4 text-left font-semibold uppercase tracking-wider">Jenis</th>
                    <th class="px-6 py-4 text-left font-semibold uppercase tracking-wider">Tim</th>
                    <th class="px-6 py-4 text-left font-semibold uppercase tracking-wider">Durasi</th>
                    <th class="px-6 py-4 text-left font-semibold uppercase tracking-wider">Gambar</th>
                    <th class="px-6 py-4 text-left font-semibold uppercase tracking-wider">Video</th>
                    <th class="px-6 py-4 text-left font-semibold uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-left font-semibold uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($projects as $project)
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                        {{ $project->nama_proyek }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                        {{ $project->tahun_proyek }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                        {{ $project->jenis_proyek }}
                    </td>
                    <td class="px-4 py-2 text-gray-700">
                         {{ Str::words($project->tim_pengembang, 1, '') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                        {{ $project->durasi }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="w-20 h-16 rounded-lg overflow-hidden border border-gray-200 bg-gray-100 flex items-center justify-center">
                            @if($project->gambar)
                                <img src="{{ asset('storage/' . $project->gambar) }}" 
                                     alt="{{ $project->nama_proyek }}" 
                                     class="w-full h-full object-cover cursor-pointer hover:scale-105 transition-transform duration-200"
                                     onclick="showImageModal('{{ asset('storage/' . $project->gambar) }}')">
                            @else
                                <i class="fas fa-image text-gray-400 text-xl"></i>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="w-20 h-16 rounded-lg overflow-hidden border border-gray-200 bg-gray-100 flex items-center justify-center relative group">
                            @if($project->video_demo)
                                @if(Str::startsWith($project->video_demo, ['http://', 'https://']))
                                    <!-- External Link (YouTube) -->
                                    <a href="{{ $project->video_demo }}" target="_blank" class="w-full h-full flex items-center justify-center bg-red-50 hover:bg-red-100 transition-colors">
                                        <i class="fab fa-youtube text-red-600 text-3xl"></i>
                                    </a>
                                @else
                                    <!-- Local File -->
                                    <video muted class="w-full h-full object-cover cursor-pointer hover:scale-105 transition-transform duration-200"
                                           onclick="showVideoModal('{{ asset('storage/' . $project->video_demo) }}')">
                                        <source src="{{ asset('storage/' . $project->video_demo) }}" type="video/mp4">
                                    </video>
                                @endif
                            @else
                                <i class="fas fa-play-circle text-gray-400 text-xl"></i>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $project->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $project->status == 'active' ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center gap-2">
                            <!-- Edit Button -->
                            <button onclick="editProject(this)"
                                    data-id="{{ $project->id }}"
                                    data-name="{{ $project->nama_proyek }}"
                                    data-year="{{ $project->tahun_proyek }}"
                                    data-type="{{ $project->jenis_proyek }}"
                                    data-team="{{ $project->tim_pengembang }}"
                                    data-description="{{ $project->deskripsi }}"
                                    data-duration="{{ $project->durasi }}"
                                    data-image="{{ $project->gambar }}"
                                    data-video="{{ $project->video_demo }}"
                                    data-status="{{ $project->status }}"
                                    class="bg-green-100 text-green-700 hover:bg-green-200 p-2 rounded-lg transition-colors duration-200">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('Yakin ingin menghapus proyek ini?')"
                                        class="bg-red-100 text-red-700 hover:bg-red-200 p-2 rounded-lg transition-colors duration-200">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            <form action="{{ route('projects.toggle', $project->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="bg-blue-100 text-blue-700 hover:bg-blue-200 p-2 rounded-lg transition-colors duration-200">
                                    <i class="fas fa-eye{{ $project->status == 'inactive' ? '-slash' : '' }}"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                 <tr>
                    <td colspan="9" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-inbox text-4xl mb-4 block text-gray-300"></i>
                        <p class="text-lg">Tidak ada data proyek</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Form -->
<div id="projectModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50 hidden">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
        <div class="bg-gradient-to-r from-blue-600 to-blue-500 text-white p-6 rounded-t-xl">
            <div class="flex justify-between items-center">
                <h2 id="modalTitle" class="text-2xl font-bold">Tambah Daftar Proyek</h2>
                <button onclick="closeModal()" class="text-white hover:bg-white hover:bg-opacity-20 w-8 h-8 rounded-full flex items-center justify-center transition-colors duration-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        
        <form method="POST" id="projectForm" enctype="multipart/form-data" class="p-6">
            @csrf
            <div id="methodField"></div>
            
            <!-- Error Alert Container -->
            <div id="modalErrorContainer" class="hidden mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Error!</strong>
                <ul id="modalErrorList" class="list-disc list-inside mt-1"></ul>
            </div>
            
            <div class="space-y-6">
                <!-- Nama Proyek -->
                <div>
                    <label for="projectName" class="block text-sm font-semibold text-gray-700 mb-2">Nama Proyek</label>
                    <input type="text" id="projectName" name="nama_proyek" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                </div>
                
                <!-- Tahun dan Jenis -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="projectYear" class="block text-sm font-semibold text-gray-700 mb-2">Tahun Proyek</label>
                        <input type="number" id="projectYear" name="tahun_proyek" min="2000" max="2030" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                    </div>
                    <div>
                        <label for="projectType" class="block text-sm font-semibold text-gray-700 mb-2">Jenis Proyek</label>
                        <select id="projectType" name="jenis_proyek" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                            <option value="">Pilih Jenis</option>
                            <option value="Tugas Kuliah">Tugas Kuliah</option>
                            <option value="Lomba">Lomba</option>
                            <option value="Komersil">Komersil</option>
                            <option value="Personal">Personal</option>
                            <option value="Open Source">Open Source</option>
                        </select>
                    </div>
                </div>
                
                <!-- Tim Pengembang -->
                <div>
                    <label for="projectTeam" class="block text-sm font-semibold text-gray-700 mb-2">Tim Pengembang</label>
                    <input type="text" id="projectTeam" name="tim_pengembang" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                </div>
                
                <!-- Deskripsi -->
                <div>
                    <label for="projectDescription" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Proyek</label>
                    <textarea id="projectDescription" name="deskripsi" required rows="4"
                              placeholder="Masukkan deskripsi lengkap proyek..."
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"></textarea>
                </div>
                
                <!-- Durasi dan Status -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="projectDuration" class="block text-sm font-semibold text-gray-700 mb-2">Durasi Pengerjaan</label>
                        <input type="text" id="projectDuration" name="durasi" placeholder="Contoh: 3 bulan" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                    </div>
                    <div>
                        <label for="projectStatus" class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                        <select id="projectStatus" name="status" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                            <option value="active">Aktif</option>
                            <option value="inactive">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                
                <!-- Gambar -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Hasil Proyek</label>
                        <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition-all duration-200">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <i class="fas fa-upload text-2xl text-gray-400 mb-2"></i>
                                <p class="text-sm text-gray-500">Klik untuk upload gambar</p>
                            </div>
                            <input type="file" id="projectImage" name="gambar" accept=".jpg,.jpeg,.png,.gif" 
                                   onchange="previewImage(this)" class="hidden">
                        </label>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Preview Gambar</label>
                        <div id="imagePreviewContainer" class="w-full h-32 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center bg-gray-50">
                            <i class="fas fa-image text-3xl text-gray-400"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Video Hybrid Input -->
                <div class="space-y-4">
                    <label class="block text-sm font-semibold text-gray-700">Video Demo Proyek</label>
                    
                    <!-- Source Selection -->
                    <div class="flex gap-6 mb-2">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="video_source" value="file" checked onchange="toggleVideoSource()" class="w-4 h-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                            <span class="text-gray-700">Upload Video</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="video_source" value="link" onchange="toggleVideoSource()" class="w-4 h-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                            <span class="text-gray-700">Link YouTube</span>
                        </label>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- File Input -->
                        <div id="videoFileSection">
                            <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition-all duration-200">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i class="fas fa-upload text-2xl text-gray-400 mb-2"></i>
                                    <p class="text-sm text-gray-500">Klik untuk upload video</p>
                                </div>
                                <input type="file" id="projectVideo" name="video_demo" accept=".mp4,.avi,.mov,.wmv" 
                                       onchange="previewVideo(this)" class="hidden">
                            </label>
                        </div>

                        <!-- Link Input -->
                        <div id="videoLinkSection" class="hidden">
                            <div class="flex flex-col justify-center h-32">
                                <label for="projectVideoLink" class="sr-only">Link YouTube</label>
                                <input type="url" id="projectVideoLink" name="video_link" placeholder="Masukkan Link YouTube (https://youtu.be/...)"
                                       onchange="previewVideoLink(this)"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                <p class="text-xs text-gray-500 mt-2">Pastikan link valid (YouTube/Google Drive)</p>
                            </div>
                        </div>

                        <!-- Preview -->
                        <div>
                            <div id="videoPreviewContainer" class="w-full h-32 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center bg-gray-50 overflow-hidden relative">
                                <i class="fas fa-play-circle text-3xl text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Modal Footer -->
            <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-gray-200">
                <button type="button" onclick="closeModal()"
                        class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200 font-semibold">
                    Batal
                </button>
                <button type="submit" id="btnSubmit"
                        class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-lg hover:from-blue-700 hover:to-blue-600 transition-all duration-200 font-semibold">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Preview Modal -->
<div id="previewModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50 hidden">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-blue-500 text-white p-4 flex justify-between items-center">
            <h2 class="text-xl font-bold">Preview</h2>
            <button onclick="closePreviewModal()" class="text-white hover:bg-white hover:bg-opacity-20 w-8 h-8 rounded-full flex items-center justify-center">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-4 flex items-center justify-center">
            <img id="modalPreviewImage" class="max-w-full max-h-[70vh] hidden rounded-lg">
            <video id="modalPreviewVideo" controls class="max-w-full max-h-[70vh] hidden rounded-lg"></video>
        </div>
    </div>
</div>

</div>

<script>
    // AJAX Form Handling
    document.getElementById('projectForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const form = this;
        const submitBtn = document.getElementById('btnSubmit');
        const errorContainer = document.getElementById('modalErrorContainer');
        const errorList = document.getElementById('modalErrorList');
        
        // Reset errors
        errorContainer.classList.add('hidden');
        errorList.innerHTML = '';
        
        // Loading state
        const originalText = submitBtn.innerText;
        submitBtn.disabled = true;
        submitBtn.innerText = 'Menyimpan...';
        
        try {
            const formData = new FormData(form);
            const response = await fetch(form.action, {
                method: 'POST', // Method spoofing via _method handled by Laravel
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: formData
            });
            
            const data = await response.json();
            
            if (!response.ok) {
                if (response.status === 422) {
                    // Validation Errors
                    errorContainer.classList.remove('hidden');
                    Object.values(data.errors).flat().forEach(error => {
                        const li = document.createElement('li');
                        li.textContent = error;
                        errorList.appendChild(li);
                    });
                    // Scroll to top of form to see error
                    document.querySelector('#projectModal > div').scrollTo({ top: 0, behavior: 'smooth' });
                } else {
                    throw new Error(data.message || 'Terjadi kesalahan sistem');
                }
            } else {
                // Success
                window.location.reload();
            }
        } catch (error) {
            console.error('Error:', error);
            errorContainer.classList.remove('hidden');
            const li = document.createElement('li');
            li.textContent = error.message || 'Gagal menyimpan data. Silakan coba lagi.';
            errorList.appendChild(li);
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerText = originalText;
        }
    });

    function toggleVideoSource() {
        const source = document.querySelector('input[name="video_source"]:checked').value;
        const fileSection = document.getElementById('videoFileSection');
        const linkSection = document.getElementById('videoLinkSection');
        
        if (source === 'file') {
            fileSection.classList.remove('hidden');
            linkSection.classList.add('hidden');
        } else {
            fileSection.classList.add('hidden');
            linkSection.classList.remove('hidden');
        }
        
        // Reset preview when switching source if needed, or keep it smart.
        // For now, let's clear it to avoid confusion
        resetPreviews();
        updateImagePreview(document.getElementById('imagePreviewContainer').dataset.currentImage || '');
    }

    function previewVideoLink(input) {
        const url = input.value;
        if (url) {
            let embedUrl = url;
            // Simple logic to convert youtube watch to embed for preview
            if (url.includes('youtube.com/watch?v=')) {
                const videoId = url.split('v=')[1].split('&')[0];
                embedUrl = `https://www.youtube.com/embed/${videoId}`;
            } else if (url.includes('youtu.be/')) {
                const videoId = url.split('youtu.be/')[1];
                embedUrl = `https://www.youtube.com/embed/${videoId}`;
            }
            
            document.getElementById('videoPreviewContainer').innerHTML = `
                <iframe src="${embedUrl}" class="w-full h-full rounded-lg" frameborder="0" allowfullscreen></iframe>
            `;
        }
    }

    function openAddModal() {
        document.getElementById('modalTitle').textContent = 'Tambah Daftar Proyek';
        const form = document.getElementById('projectForm');
        form.action = "{{ route('projects.store') }}";
        form.reset();
        document.getElementById('methodField').innerHTML = '';
        
        // Default to file
        document.querySelector('input[name="video_source"][value="file"]').checked = true;
        toggleVideoSource();
        
        resetPreviews();
        
        document.getElementById('projectModal').classList.remove('hidden');
    }

    function editProject(button) {
        const id = button.getAttribute('data-id');
        const nama = button.getAttribute('data-name');
        const tahun = button.getAttribute('data-year');
        const jenis = button.getAttribute('data-type');
        const tim = button.getAttribute('data-team');
        const deskripsi = button.getAttribute('data-description');
        const durasi = button.getAttribute('data-duration');
        const gambar = button.getAttribute('data-image');
        const video = button.getAttribute('data-video'); // This could be path or URL
        const status = button.getAttribute('data-status');

        document.getElementById('modalTitle').textContent = 'Edit Data Proyek';
        const form = document.getElementById('projectForm');
        form.action = "{{ route('projects.index') }}/" + id;
        document.getElementById('methodField').innerHTML = '<input type="hidden" name="_method" value="PUT">';
        
        document.getElementById('projectName').value = nama;
        document.getElementById('projectYear').value = tahun;
        document.getElementById('projectType').value = jenis;
        document.getElementById('projectTeam').value = tim;
        document.getElementById('projectDescription').value = deskripsi;
        document.getElementById('projectDuration').value = durasi;
        document.getElementById('projectStatus').value = status;
        
        // Handle Video Source Logic
        const isUrl = video && (video.startsWith('http://') || video.startsWith('https://'));
        if (isUrl) {
            document.querySelector('input[name="video_source"][value="link"]').checked = true;
            document.getElementById('projectVideoLink').value = video;
        } else {
            document.querySelector('input[name="video_source"][value="file"]').checked = true;
        }
        toggleVideoSource(); // Show correct input

        resetPreviews();

        if (gambar) {
             const imgUrl = "{{ asset('storage') }}/" + gambar;
             updateImagePreview(imgUrl);
             document.getElementById('imagePreviewContainer').dataset.currentImage = imgUrl; // Store for toggle restore
        }
        
        if (video) {
            if (isUrl) {
                previewVideoLink({value: video});
            } else {
                updateVideoPreview("{{ asset('storage') }}/" + video);
            }
        }

        document.getElementById('projectModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('projectModal').classList.add('hidden');
        document.getElementById('imagePreviewContainer').dataset.currentImage = ''; 
    }

    function resetPreviews() {
        document.getElementById('imagePreviewContainer').innerHTML = '<i class="fas fa-image text-3xl text-gray-400"></i>';
        document.getElementById('videoPreviewContainer').innerHTML = '<i class="fas fa-play-circle text-3xl text-gray-400"></i>';
    }

    function previewImage(input) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                updateImagePreview(e.target.result);
                document.getElementById('imagePreviewContainer').dataset.currentImage = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }

    function updateImagePreview(src) {
        if (!src) return;
        document.getElementById('imagePreviewContainer').innerHTML = `<img src="${src}" class="w-full h-full object-cover rounded-lg">`;
    }

    function previewVideo(input) {
        const file = input.files[0];
        if (file) {
             // Create blob URL for video preview
            const blobURL = URL.createObjectURL(file);
            updateVideoPreview(blobURL);
        }
    }

    function updateVideoPreview(src) {
        document.getElementById('videoPreviewContainer').innerHTML = `
            <video controls class="w-full h-full object-cover rounded-lg">
                <source src="${src}" type="video/mp4">
            </video>`;
    }

    // Modal Preview Logic
    function showImageModal(src) {
        const modal = document.getElementById('previewModal');
        const img = document.getElementById('modalPreviewImage');
        const video = document.getElementById('modalPreviewVideo');
        
        img.src = src;
        img.classList.remove('hidden');
        video.classList.add('hidden');
        video.pause();
        
        modal.classList.remove('hidden');
    }

    function showVideoModal(src) {
        // Only for local files, links open in new tab directly from table
        const modal = document.getElementById('previewModal');
        const img = document.getElementById('modalPreviewImage');
        const video = document.getElementById('modalPreviewVideo');
        
        video.src = src;
        video.classList.remove('hidden');
        img.classList.add('hidden');
        
        modal.classList.remove('hidden');
    }

    // Close on click outside
    window.onclick = function(event) {
        const modal = document.getElementById('projectModal');
        const previewModal = document.getElementById('previewModal');
        if (event.target == modal) {
            closeModal();
        }
        if (event.target == previewModal) {
            closePreviewModal();
        }
    }
</script>
@endsection
