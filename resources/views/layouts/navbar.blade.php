<header
    class="mb-8 mt-2 flex items-center justify-between py-2 md:mb-12 md:py-4 xl:mb-16 shadow-xl/30 p-6 rounded-xl bg-white">
    <!-- logo - start -->
    <a href="/" class="inline-flex items-center gap-2.5 text-2xl font-bold text-black md:text-3xl" aria-label="logo">
        <svg width="95" height="94" viewBox="0 0 95 94" class="h-auto w-6 text-sky-500" fill="currentColor"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M96 0V47L48 94H0V47L48 0H96Z" />
        </svg>
        Santun
    </a>
    <!-- logo - end -->

    <!-- nav - start -->
    <nav class="hidden gap-12 lg:flex items-center">
        <a href="{{ route('home') }}"
            class="text-lg font-semibold {{ request()->routeIs('home') ? 'text-sky-500' : 'text-gray-600 hover:text-sky-500 active:text-sky-700' }}">Home</a>
        <a href="{{ route('kegiatan') }}"
            class="text-lg font-semibold {{ request()->routeIs('kegiatan') ? 'text-sky-500' : 'text-gray-600 hover:text-sky-500 active:text-sky-700' }}">Kegiatan
            Sosial</a>
        <a href="{{ route('layanan') }}"
            class="text-lg font-semibold {{ request()->routeIs('layanan') ? 'text-sky-500' : 'text-gray-600 hover:text-sky-500 active:text-sky-700' }}">Pendaftaran Layanan</a>
        <a href="{{ route('donasi') }}"
            class="text-lg font-semibold {{ request()->routeIs('donasi') ? 'text-sky-500' : 'text-gray-600 hover:text-sky-500 active:text-sky-700' }}">Penggalangan Donasi</a>
        <a href="{{ route('about') }}"
            class="text-lg font-semibold {{ request()->routeIs('about') ? 'text-sky-500' : 'text-gray-600 hover:text-sky-500 active:text-sky-700' }}">Tentang
            Kami</a>
        @guest
            <a href="{{ route('login') }}"
                class="text-lg font-semibold text-gray-600 hover:text-sky-500 active:text-sky-700">Login</a>
        @else
            @auth
                <a href="{{ route('profile.show') }}" class="text-lg font-semibold text-sky-500 hover:text-sky-700 mr-2">My
                    Profile</a>
                @if (request()->routeIs('profile.show'))
                    <form method="POST" action="{{ route('filament.admin.auth.logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                            class="text-lg font-semibold text-gray-600 hover:text-red-500 active:text-red-700 bg-transparent border-0 cursor-pointer">
                            Logout
                        </button>
                    </form>
                @endif
            @endauth
        @endguest
    </nav>


    <!-- nav - end -->

    <!-- mobile menu button - start -->
    <button id="open-menu" type="button"
        class="inline-flex items-center gap-2 rounded-lg bg-gray-200 px-2.5 py-2 text-sm font-semibold text-gray-500 ring-indigo-300 hover:bg-gray-300 focus-visible:ring active:text-gray-700 md:text-base lg:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                clip-rule="evenodd" />
        </svg>
        Menu
    </button>
    <!-- mobile menu button - end -->
</header>

<!-- mobile menu - start -->
<nav id="mobile-nav" data-aos="fade-left" data-aos-duration="800"
    class="fixed inset-0 z-40 flex flex-col items-center justify-center gap-8 bg-white p-8 text-center text-xl font-semibold text-gray-700 transition-all duration-300 lg:hidden hidden">
    <a href="{{ route('home') }}"
        class="{{ request()->routeIs('home') ? 'text-sky-500' : 'hover:text-sky-500' }}">Home</a>
    <a href="{{ route('kegiatan') }}"
        class="{{ request()->routeIs('kegiatan') ? 'text-sky-500' : 'hover:text-sky-500' }}">Kegiatan Sosial</a>
    <a href="{{ route('layanan') }}"
        class="{{ request()->routeIs('layanan') ? 'text-sky-500' : 'hover:text-sky-500' }}">Pendaftaran Layanan</a>
    <a href="{{ route('donasi') }}"
        class="{{ request()->routeIs('donasi') ? 'text-sky-500' : 'hover:text-sky-500' }}">Penggalangan Donasi</a>
    <a href="{{ route('about') }}"
        class="{{ request()->routeIs('about') ? 'text-sky-500' : 'hover:text-sky-500' }}">Tentang Kami</a>
    @guest
        <a href="{{ route('login') }}" class="hover:text-sky-500">Login</a>
    @else
        @auth
            <a href="{{ route('profile.show') }}" class="text-lg font-semibold text-sky-500 hover:text-sky-700 mr-2">My
                Profile</a>
            @if (request()->routeIs('profile.show'))
                <form method="POST" action="{{ route('filament.admin.auth.logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                        class="text-lg font-semibold text-gray-600 hover:text-red-500 active:text-red-700 bg-transparent border-0 cursor-pointer">
                        Logout
                    </button>
                </form>
            @endif
        @endauth
    @endguest
    <button id="close-menu" class="mt-8 rounded bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-300">Close</button>
</nav>