<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Inter font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body>
    <div class="bg-gradient-to-r from-blue-200 to-cyan-200 pb-6 sm:pb-8 lg:pb-12">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
            @include('layouts.navbar')
            <main data-aos="fade-up" data-aos-duration="900">
                @yield('content')
            </main>
            @include('layouts.footer')
        </div>
    </div>
    <a href="https://wa.me/6285591305808" target="_blank"
        class="fixed bottom-4 right-4 z-50 bg-green-500 rounded-full shadow-lg p-3 hover:bg-green-600 transition"
        aria-label="Chat via WhatsApp">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" class="w-10 h-10">
    </a>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- script - start -->
    <script>
        const openBtn = document.getElementById('open-menu');
        const closeBtn = document.getElementById('close-menu');
        const mobileNav = document.getElementById('mobile-nav');

        openBtn.addEventListener('click', () => {
            mobileNav.classList.remove('hidden');
            // Refresh AOS in case mobile menu is opened
            if (window.AOS) AOS.refresh();
        });

        closeBtn.addEventListener('click', () => {
            mobileNav.classList.add('hidden');
        });

        // Hide menu when a link is clicked
        mobileNav.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                mobileNav.classList.add('hidden');
            });
        });
    </script>
    <script>
        AOS.init();
    </script>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif
</body>

</html>