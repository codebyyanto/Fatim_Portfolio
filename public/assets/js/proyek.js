// JavaScript untuk manajemen proyek dengan Tailwind
let currentEditId = null;

// Modal Functions
function openAddModal() {
    document.getElementById('modalTitle').textContent = 'Tambah Daftar Proyek';
    document.getElementById('formAction').value = 'tambah';
    document.getElementById('projectForm').reset();
    document.getElementById('projectDescription').value = '';
    updateImagePreview('');
    updateVideoPreview('');
    document.getElementById('projectModal').classList.remove('hidden');
    resetButtonState();
}

function closeModal() {
    document.getElementById('projectModal').classList.add('hidden');
    currentEditId = null;
}

function resetButtonState() {
    const btnSubmit = document.getElementById('btnSubmit');
    btnSubmit.innerHTML = 'Simpan';
    btnSubmit.disabled = false;
}

// Edit Project Function
function editProject(id, nama, tahun, jenis, tim, deskripsi, durasi, gambar, video, status) {
    document.getElementById('modalTitle').textContent = 'Ubah Data Proyek';
    document.getElementById('formAction').value = 'ubah';
    document.getElementById('formId').value = id;
    document.getElementById('existingGambar').value = gambar;
    document.getElementById('existingVideo').value = video;
    
    document.getElementById('projectName').value = nama;
    document.getElementById('projectYear').value = tahun;
    document.getElementById('projectType').value = jenis;
    document.getElementById('projectTeam').value = tim;
    
    // Handle deskripsi
    if (deskripsi === '0' || deskripsi === 0 || deskripsi === null || deskripsi === undefined || deskripsi.trim() === '') {
        document.getElementById('projectDescription').value = 'Deskripsi proyek belum diisi.';
    } else {
        document.getElementById('projectDescription').value = deskripsi;
    }
    
    document.getElementById('projectDuration').value = durasi;
    document.getElementById('projectStatus').value = status;
    updateImagePreview(gambar);
    updateVideoPreview(video);
    document.getElementById('projectModal').classList.remove('hidden');
    
    // Update button text
    const btnSubmit = document.getElementById('btnSubmit');
    btnSubmit.innerHTML = 'Simpan Perubahan';
    btnSubmit.disabled = false;
    
    currentEditId = id;
}

// Preview Functions
function previewImage(input) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            updateImagePreview(e.target.result);
        }
        reader.readAsDataURL(file);
    } else {
        updateImagePreview('');
    }
}

function previewVideo(input) {
    const file = input.files[0];
    if (file) {
        const url = URL.createObjectURL(file);
        updateVideoPreview(url);
    } else {
        updateVideoPreview('');
    }
}

function updateImagePreview(imageSrc) {
    const imagePreview = document.getElementById('imagePreview');
    if (imageSrc && (imageSrc.startsWith('data:') || imageSrc.startsWith('uploads/'))) {
        imagePreview.innerHTML = `<img src="${imageSrc}" alt="Preview" class="w-full h-full object-cover rounded-lg">`;
    } else if (imageSrc) {
        imagePreview.innerHTML = `<img src="${imageSrc}" alt="Preview" class="w-full h-full object-cover rounded-lg">`;
    } else {
        imagePreview.innerHTML = '<i class="fas fa-image text-3xl text-gray-400"></i>';
    }
}

function updateVideoPreview(videoSrc) {
    const videoPreview = document.getElementById('videoPreview');
    if (videoSrc && (videoSrc.startsWith('blob:') || videoSrc.startsWith('uploads/'))) {
        videoPreview.innerHTML = `<video muted class="w-full h-full object-cover rounded-lg"><source src="${videoSrc}" type="video/mp4"></video>`;
    } else if (videoSrc) {
        videoPreview.innerHTML = `<video muted class="w-full h-full object-cover rounded-lg"><source src="${videoSrc}" type="video/mp4"></video>`;
    } else {
        videoPreview.innerHTML = '<i class="fas fa-play-circle text-3xl text-gray-400"></i>';
    }
}

// Modal Preview Functions
function showImageModal(imageSrc) {
    const previewModal = document.getElementById('previewModal');
    const previewImage = document.getElementById('previewImage');
    const previewVideo = document.getElementById('previewVideo');
    
    previewImage.src = imageSrc;
    previewImage.classList.remove('hidden');
    previewVideo.classList.add('hidden');
    previewModal.classList.remove('hidden');
}

function showVideoModal(videoSrc) {
    const previewModal = document.getElementById('previewModal');
    const previewImage = document.getElementById('previewImage');
    const previewVideo = document.getElementById('previewVideo');
    
    previewVideo.innerHTML = `<source src="${videoSrc}" type="video/mp4">`;
    previewImage.classList.add('hidden');
    previewVideo.classList.remove('hidden');
    previewVideo.load();
    previewModal.classList.remove('hidden');
}

function closePreviewModal() {
    const previewModal = document.getElementById('previewModal');
    const previewVideo = document.getElementById('previewVideo');
    
    previewVideo.pause();
    previewModal.classList.add('hidden');
}

// Form validation
document.addEventListener('DOMContentLoaded', function() {
    const projectForm = document.getElementById('projectForm');
    if (projectForm) {
        projectForm.addEventListener('submit', function(e) {
            const deskripsi = document.getElementById('projectDescription').value.trim();
            
            if (deskripsi === '0') {
                e.preventDefault();
                alert('Deskripsi tidak boleh hanya angka 0. Silakan isi deskripsi yang valid.');
                document.getElementById('projectDescription').focus();
                return false;
            }
            
            if (deskripsi === '') {
                document.getElementById('projectDescription').value = 'Deskripsi proyek belum diisi.';
            }
            
            // Loading state
            const btnSubmit = document.getElementById('btnSubmit');
            btnSubmit.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
            btnSubmit.disabled = true;
        });
    }

    // Escape key to close modal
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeModal();
            closePreviewModal();
        }
    });

    // Close modal when clicking outside
    document.getElementById('projectModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    document.getElementById('previewModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closePreviewModal();
        }
    });
});

// Tambahkan fungsi-fungsi ini ke assets/js/proyek.js yang sudah ada

// Modal Functions untuk proyek
function openAddModal() {
    document.getElementById('modalTitle').textContent = 'Tambah Daftar Proyek';
    document.getElementById('formAction').value = 'tambah';
    document.getElementById('projectForm').reset();
    document.getElementById('projectDescription').value = '';
    updateImagePreview('');
    updateVideoPreview('');
    document.getElementById('projectModal').classList.remove('hidden');
    resetButtonState();
}

function closeModal() {
    document.getElementById('projectModal').classList.add('hidden');
    currentEditId = null;
}

function resetButtonState() {
    const btnSubmit = document.getElementById('btnSubmit');
    btnSubmit.innerHTML = 'Simpan';
    btnSubmit.disabled = false;
}

// Edit Project Function
function editProject(id, nama, tahun, jenis, tim, deskripsi, durasi, gambar, video, status) {
    document.getElementById('modalTitle').textContent = 'Ubah Data Proyek';
    document.getElementById('formAction').value = 'ubah';
    document.getElementById('formId').value = id;
    document.getElementById('existingGambar').value = gambar;
    document.getElementById('existingVideo').value = video;
    
    document.getElementById('projectName').value = nama;
    document.getElementById('projectYear').value = tahun;
    document.getElementById('projectType').value = jenis;
    document.getElementById('projectTeam').value = tim;
    
    // Handle deskripsi
    if (deskripsi === '0' || deskripsi === 0 || deskripsi === null || deskripsi === undefined || deskripsi.trim() === '') {
        document.getElementById('projectDescription').value = 'Deskripsi proyek belum diisi.';
    } else {
        document.getElementById('projectDescription').value = deskripsi;
    }
    
    document.getElementById('projectDuration').value = durasi;
    document.getElementById('projectStatus').value = status;
    updateImagePreview(gambar);
    updateVideoPreview(video);
    document.getElementById('projectModal').classList.remove('hidden');
    
    // Update button text
    const btnSubmit = document.getElementById('btnSubmit');
    btnSubmit.innerHTML = 'Simpan Perubahan';
    btnSubmit.disabled = false;
    
    currentEditId = id;
}

// Preview Functions
function previewImage(input) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            updateImagePreview(e.target.result);
        }
        reader.readAsDataURL(file);
    } else {
        updateImagePreview('');
    }
}

function previewVideo(input) {
    const file = input.files[0];
    if (file) {
        const url = URL.createObjectURL(file);
        updateVideoPreview(url);
    } else {
        updateVideoPreview('');
    }
}

function updateImagePreview(imageSrc) {
    const imagePreview = document.getElementById('imagePreview');
    if (imageSrc && (imageSrc.startsWith('data:') || imageSrc.startsWith('uploads/'))) {
        imagePreview.innerHTML = `<img src="${imageSrc}" alt="Preview" class="w-full h-full object-cover rounded-lg">`;
    } else if (imageSrc) {
        imagePreview.innerHTML = `<img src="${imageSrc}" alt="Preview" class="w-full h-full object-cover rounded-lg">`;
    } else {
        imagePreview.innerHTML = '<i class="fas fa-image text-3xl text-gray-400"></i>';
    }
}

function updateVideoPreview(videoSrc) {
    const videoPreview = document.getElementById('videoPreview');
    if (videoSrc && (videoSrc.startsWith('blob:') || videoSrc.startsWith('uploads/'))) {
        videoPreview.innerHTML = `<video muted class="w-full h-full object-cover rounded-lg"><source src="${videoSrc}" type="video/mp4"></video>`;
    } else if (videoSrc) {
        videoPreview.innerHTML = `<video muted class="w-full h-full object-cover rounded-lg"><source src="${videoSrc}" type="video/mp4"></video>`;
    } else {
        videoPreview.innerHTML = '<i class="fas fa-play-circle text-3xl text-gray-400"></i>';
    }
}

// Modal Preview Functions
function showImageModal(imageSrc) {
    const previewModal = document.getElementById('previewModal');
    const previewImage = document.getElementById('previewImage');
    const previewVideo = document.getElementById('previewVideo');
    
    previewImage.src = imageSrc;
    previewImage.classList.remove('hidden');
    previewVideo.classList.add('hidden');
    previewModal.classList.remove('hidden');
}

function showVideoModal(videoSrc) {
    const previewModal = document.getElementById('previewModal');
    const previewImage = document.getElementById('previewImage');
    const previewVideo = document.getElementById('previewVideo');
    
    previewVideo.innerHTML = `<source src="${videoSrc}" type="video/mp4">`;
    previewImage.classList.add('hidden');
    previewVideo.classList.remove('hidden');
    previewVideo.load();
    previewModal.classList.remove('hidden');
}

function closePreviewModal() {
    const previewModal = document.getElementById('previewModal');
    const previewVideo = document.getElementById('previewVideo');
    
    previewVideo.pause();
    previewModal.classList.add('hidden');
}