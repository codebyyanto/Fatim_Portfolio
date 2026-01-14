<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Portfolio - Fatimah Lailatul Azzahra')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800 font-sans min-h-screen flex flex-col">
    <!-- Mobile Menu Toggle -->
    <button id="mobileMenuToggle" class="lg:hidden fixed top-4 left-4 z-50 bg-blue-600 text-white p-3 rounded-lg shadow-lg">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Overlay -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>

    <!-- Header -->
    <header class="bg-gradient-to-r from-blue-600 to-blue-500 text-white py-12 shadow-xl">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">@yield('header_title', 'Fatimah Lailatul Azzahra')</h1>
            <p class="text-xl opacity-90">@yield('header_subtitle', 'Portfolio & Biodata')</p>
        </div>
    </header>

    @if(session('success'))
    <div class="container mx-auto px-4 mt-6">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Sukses!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    </div>
    @endif

    @if($errors->any())
    <div class="container mx-auto px-4 mt-6">
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Error!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <!-- Main Container -->
    <div class="container mx-auto px-4 py-8 flex-grow">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-gray-900 to-blue-900 text-white py-12 mt-auto">
        <div class="container mx-auto px-4">
            @yield('footer_content')
            
            <div class="text-center pt-8 border-t border-gray-700">
                <p class="text-gray-400">@Pweb2-Lat8-23312241-Fatimah Lailatul Azzahra</p>
                <p class="text-gray-400 mt-2">&copy; {{ date('Y') }} All Rights Reserved</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu functionality
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        
        if (mobileMenuToggle && sidebar && sidebarOverlay) {
            function toggleSidebar() {
                sidebar.classList.toggle('-translate-x-full');
                sidebarOverlay.classList.toggle('hidden');
            }
            
            mobileMenuToggle.addEventListener('click', toggleSidebar);
            sidebarOverlay.addEventListener('click', toggleSidebar);
        }
    </script>
    @stack('scripts')
</body>
</html>
