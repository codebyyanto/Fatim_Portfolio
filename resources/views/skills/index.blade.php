@extends('layouts.app')

@section('content')
<div class="mb-6">
    <a href="{{ route('home') }}" 
       class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors duration-200">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Portfolio
    </a>
</div>

<div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        <form method="GET" class="relative flex-1 max-w-md">
            <div class="relative">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Cari keahlian..." 
                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
            </div>
        </form>
        <button onclick="openAddModal()" 
                class="bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white px-6 py-2 rounded-lg font-semibold flex items-center gap-2 transition-all duration-200 transform hover:-translate-y-1 hover:shadow-lg">
            <i class="fas fa-plus-circle"></i>
            Tambah Keahlian
        </button>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full min-w-full">
            <thead>
                <tr class="bg-gradient-to-r from-blue-600 to-blue-500 text-white">
                    <th class="px-6 py-4 text-left font-semibold uppercase tracking-wider">Nama Keahlian</th>
                    <th class="px-6 py-4 text-left font-semibold uppercase tracking-wider">Kategori</th>
                    <th class="px-6 py-4 text-left font-semibold uppercase tracking-wider">Deskripsi</th>
                    <th class="px-6 py-4 text-left font-semibold uppercase tracking-wider">Icon</th>
                    <th class="px-6 py-4 text-left font-semibold uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-left font-semibold uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($skills as $skill)
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                        {{ $skill->nama_keahlian }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                        @php
                            $colors = [
                                'Programming Language' => 'bg-blue-100 text-blue-800',
                                'Web Development' => 'bg-green-100 text-green-800',
                                'Mobile Development' => 'bg-indigo-100 text-indigo-800',
                                'Database' => 'bg-yellow-100 text-yellow-800',
                                'UI/UX Design' => 'bg-pink-100 text-pink-800',
                                'Desain Grafis dan Multimedia' => 'bg-purple-100 text-purple-800',
                                'Jaringan' => 'bg-red-100 text-red-800',
                                'Data Analis' => 'bg-teal-100 text-teal-800',
                            ];
                            $category = $skill->kategori_23312241;
                            $colorClass = $colors[$category] ?? 'bg-gray-100 text-gray-800';
                        @endphp
                        @if($category)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $colorClass }}">
                                {{ $category }}
                            </span>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-700 max-w-md">
                        {{ $skill->deskripsi }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center overflow-hidden">
                            @if(!empty($skill->icon) && str_starts_with($skill->icon, 'fa-'))
                                <i class="{{ $skill->icon }} text-blue-600 text-lg"></i>
                            @elseif(!empty($skill->icon))
                                @if(Str::endsWith($skill->icon, '.svg'))
                                    <img src="{{ asset('storage/' . $skill->icon) }}" alt="{{ $skill->nama_keahlian }}" class="w-10 h-10 object-contain">
                                @else
                                    <img src="{{ asset('storage/' . $skill->icon) }}" alt="{{ $skill->nama_keahlian }}" class="w-full h-full object-cover">
                                @endif
                            @else
                                <i class="fas fa-image text-gray-400 text-lg"></i>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $skill->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $skill->status == 'active' ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center gap-2">
                            <button onclick="editSkill({{ $skill->id }}, '{{ addslashes($skill->nama_keahlian) }}', '{{ addslashes($skill->kategori_23312241) }}', '{{ addslashes($skill->deskripsi) }}', '{{ addslashes($skill->icon) }}', '{{ $skill->status }}')"
                                    class="bg-green-100 text-green-700 hover:bg-green-200 p-2 rounded-lg transition-colors duration-200">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('skills.destroy', $skill->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('Yakin ingin menghapus keahlian ini?')"
                                        class="bg-red-100 text-red-700 hover:bg-red-200 p-2 rounded-lg transition-colors duration-200">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            <form action="{{ route('skills.toggle', $skill->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="bg-blue-100 text-blue-700 hover:bg-blue-200 p-2 rounded-lg transition-colors duration-200">
                                    <i class="fas fa-eye{{ $skill->status == 'inactive' ? '-slash' : '' }}"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-inbox text-4xl mb-4 block text-gray-300"></i>
                        <p class="text-lg">Tidak ada data keahlian</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Form -->
<div id="skillModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50 hidden">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div class="bg-gradient-to-r from-blue-600 to-blue-500 text-white p-6 rounded-t-xl">
            <div class="flex justify-between items-center">
                <h2 id="modalTitle" class="text-2xl font-bold">Tambah Keahlian Baru</h2>
                <button onclick="closeSkillModal()" class="text-white hover:bg-white hover:bg-opacity-20 w-8 h-8 rounded-full flex items-center justify-center transition-colors duration-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        
        <form method="POST" id="skillForm" enctype="multipart/form-data" class="p-6">
            @csrf
            <div id="methodField"></div>

            <!-- Error Alert Container -->
            <div id="modalErrorContainer" class="hidden mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Error!</strong>
                <ul id="modalErrorList" class="list-disc list-inside mt-1"></ul>
            </div>
            
            <div class="space-y-6">
                <div>
                    <label for="skillName" class="block text-sm font-semibold text-gray-700 mb-2">Nama Keahlian *</label>
                    <input type="text" id="skillName" name="nama_keahlian" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                           placeholder="Contoh: PHP, JavaScript, UI/UX Design">
                </div>

                <div>
                    <label for="skillCategory" class="block text-sm font-semibold text-gray-700 mb-2">Kategori (23312241)</label>
                    <select id="skillCategory" name="kategori_23312241"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                        <option value="">Pilih Kategori</option>
                        <option value="Programming Language">Programming Language</option>
                        <option value="Web Development">Web Development</option>
                        <option value="Mobile Development">Mobile Development</option>
                        <option value="Database">Database</option>
                        <option value="UI/UX Design">UI/UX Design</option>
                        <option value="Desain Grafis dan Multimedia">Desain Grafis dan Multimedia</option>
                        <option value="Jaringan">Jaringan</option>
                        <option value="Data Analis">Data Analis</option>
                    </select>
                </div>
                
                <div>
                    <label for="skillDescription" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi *</label>
                    <textarea id="skillDescription" name="deskripsi" required rows="4"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                              placeholder="Jelaskan kemampuan dan pengalaman Anda dalam keahlian ini..."></textarea>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Icon Keahlian</label>
                        <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition-all duration-200">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <i class="fas fa-upload text-2xl text-gray-400 mb-2"></i>
                                <p class="text-sm text-gray-500">Klik untuk upload icon</p>
                                <p class="text-xs text-gray-400 mt-1">SVG, PNG, JPG, GIF</p>
                            </div>
                            <input type="file" id="skillIcon" name="icon" accept=".jpg,.jpeg,.png,.gif,.svg,.ico" 
                                   onchange="previewSkillIcon(this)" class="hidden">
                        </label>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Preview Icon</label>
                        <div id="iconPreview" class="w-32 h-32 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center bg-gray-50 mx-auto">
                            <i class="fas fa-image text-3xl text-gray-400"></i>
                        </div>
                    </div>
                </div>
                
                <div>
                    <label for="skillStatus" class="block text-sm font-semibold text-gray-700 mb-2">Status *</label>
                    <select id="skillStatus" name="status" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                        <option value="active">Aktif</option>
                        <option value="inactive">Tidak Aktif</option>
                    </select>
                </div>
            </div>
            
            <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-gray-200">
                <button type="button" onclick="closeSkillModal()"
                        class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200 font-semibold">
                    Batal
                </button>
                <button type="submit"
                        class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-lg hover:from-blue-700 hover:to-blue-600 transition-all duration-200 font-semibold">
                    Simpan Keahlian
                </button>
            </div>
        </form>
    </div>
</div>

</div>

<script>
    // AJAX Form Handling
    document.getElementById('skillForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const form = this;
        // Find submit button (last button in form)
        const submitBtn = form.querySelector('button[type="submit"]');
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
                method: 'POST',
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
                     // Scroll to top of modal
                     document.querySelector('#skillModal > div').scrollTo({ top: 0, behavior: 'smooth' });
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

    function openAddModal() {
        document.getElementById('modalTitle').textContent = 'Tambah Keahlian Baru';
        const form = document.getElementById('skillForm');
        form.action = "{{ route('skills.store') }}";
        form.reset();
        document.getElementById('methodField').innerHTML = '';
        updateIconPreview('');
        document.getElementById('skillModal').classList.remove('hidden');
    }

    function editSkill(id, nama, kategori, deskripsi, icon, status) {
        document.getElementById('modalTitle').textContent = 'Edit Data Keahlian';
        const form = document.getElementById('skillForm');
        // Construct update route slightly hacky but works for JS
        form.action = "{{ route('skills.index') }}/" + id;
        document.getElementById('methodField').innerHTML = '<input type="hidden" name="_method" value="PUT">';
        
        document.getElementById('skillName').value = nama;
        document.getElementById('skillCategory').value = kategori;
        document.getElementById('skillDescription').value = deskripsi;
        document.getElementById('skillStatus').value = status;
        
        // Handle icon preview
        let iconSrc = '';
        if (icon) {
            if (icon.startsWith('fa-')) {
                iconSrc = icon;
            } else {
                iconSrc = "{{ asset('storage') }}/" + icon;
            }
        }
        updateIconPreview(iconSrc);
        
        document.getElementById('skillModal').classList.remove('hidden');
    }

    function closeSkillModal() {
        document.getElementById('skillModal').classList.add('hidden');
    }

    function previewSkillIcon(input) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                updateIconPreview(e.target.result);
            }
            reader.readAsDataURL(file);
        } else {
            updateIconPreview('');
        }
    }

    function updateIconPreview(iconSrc) {
        const iconPreview = document.getElementById('iconPreview');
        iconPreview.innerHTML = '';
        iconPreview.className = 'w-32 h-32 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center bg-gray-50 mx-auto';
        
        if (iconSrc) {
            if (iconSrc.startsWith('data:') || iconSrc.includes('/')) {
                if (iconSrc.includes('.svg') || iconSrc.toLowerCase().endsWith('.svg')) {
                    iconPreview.innerHTML = `<img src="${iconSrc}" alt="Preview" class="w-full h-full object-contain rounded-lg p-2">`;
                } else {
                    iconPreview.innerHTML = `<img src="${iconSrc}" alt="Preview" class="w-full h-full object-cover rounded-lg">`;
                }
            } else if (iconSrc.startsWith('fa-')) {
                iconPreview.innerHTML = `<i class="${iconSrc} text-3xl text-blue-600"></i>`;
            }
        } else {
            iconPreview.innerHTML = '<i class="fas fa-image text-3xl text-gray-400"></i>';
        }
    }

    // Close modal when clicking outside
    document.getElementById('skillModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeSkillModal();
        }
    });

    // Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeSkillModal();
        }
    });
</script>
@endsection
