<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- SEO & Meta Tags Terlengkap --}}
    <title>{{ $title ?? $settings['site_name'] ?? config('app.name') }}</title>
    <meta name="description" content="{{ $meta_description ?? $settings['site_description'] ?? 'Kanal berbagi informasi dan cerita dari Nusa Tenggara Timur.' }}">
    <meta name="keywords" content="{{ $meta_keywords ?? 'berita ntt, teman cerita, jurnalisme ntt, podcast ntt, info kupang' }}">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph / Facebook / WhatsApp --}}
    <meta property="og:type" content="{{ isset($episode) ? 'article' : 'website' }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $title ?? $settings['site_name'] ?? config('app.name') }}">
    <meta property="og:description" content="{{ $meta_description ?? $settings['site_description'] ?? 'Kanal berbagi informasi dan cerita dari Nusa Tenggara Timur.' }}">
    <meta property="og:image" content="{{ isset($episode->img) ? asset('storage/' . $episode->img) : (isset($settings['site_logo']) ? asset('storage/' . $settings['site_logo']) : asset('default-share.jpg')) }}">

    {{-- Favicon --}}
    <link rel="icon" href="{{ isset($settings['site_logo']) ? asset('storage/' . $settings['site_logo']) : asset('favicon.ico') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Script Pencegah Flash Mode Gelap -->
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="min-h-screen bg-neutral-50 dark:bg-[#0f0f0f] text-neutral-900 dark:text-[#f1f1f1] font-sans selection:bg-red-500/30 selection:text-red-900 dark:selection:text-white overflow-x-hidden antialiased transition-colors duration-300"
    x-data="{ 
        isScrolled: false, 
        isMobileMenuOpen: false,
        isOtherMenuOpen: false,
        scrollProgress: 0,
        darkMode: document.documentElement.classList.contains('dark'),
        toggleDarkMode() {
            this.darkMode = !this.darkMode;
            if (this.darkMode) {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
            }
        }
    }"
    @scroll.window="
        isScrolled = (window.pageYOffset > 20);
        scrollProgress = (window.pageYOffset / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
    "
    @click.away="isOtherMenuOpen = false">

    <!-- BAR PROGRES SCROLL -->
    <div class="fixed top-0 left-0 h-1 bg-red-600 z-[70] transition-all duration-150 ease-out" :style="'width: ' + scrollProgress + '%'"></div>

    <!-- NAVBAR PORTAL BERITA - DIBATASI LEBARNYA -->
    <nav :class="isScrolled ? 'bg-white/95 dark:bg-[#0f0f0f]/95 backdrop-blur-md border-neutral-200 dark:border-neutral-800 py-3 shadow-lg' : 'bg-transparent border-transparent py-5'"
        class="fixed w-full z-50 transition-all duration-300 border-b flex justify-center">
        
        <!-- Kontainer Navbar Tengah -->
        <div class="w-full max-w-[1400px] px-4 sm:px-6 flex justify-between items-center gap-8">

            <!-- LOGO & BRANDING -->
            <div class="flex items-center shrink-0">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    @if(isset($settings['site_logo']))
                    <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="Logo" class="w-9 h-9 sm:w-10 sm:h-10 rounded-full object-cover border border-neutral-200 dark:border-neutral-800 shadow-md group-hover:border-red-600 transition-colors">
                    @else
                    <div class="relative w-9 h-9 sm:w-10 sm:h-10 bg-neutral-100 dark:bg-[#1a1a1a] rounded-full flex items-center justify-center border border-neutral-200 dark:border-neutral-800 group-hover:border-red-600 transition-colors shadow-sm shadow-red-900/10">
                        <svg class="w-5 h-5 text-neutral-800 dark:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 006-6v-1.5m-6 7.5a6 6 0 01-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 01-3-3V4.5a3 3 0 116 0v8.25a3 3 0 01-3 3z" />
                        </svg>
                    </div>
                    @endif

                    <div class="flex flex-col">
                        <span class="text-sm sm:text-lg font-black tracking-tighter text-neutral-900 dark:text-white leading-none uppercase italic">
                            {{ $settings['site_name'] ?? 'Teman Cerita' }}
                        </span>
                        <span class="text-[7px] sm:text-[9px] font-bold text-red-600 dark:text-red-500 tracking-widest uppercase mt-0.5">Portal Berita NTT</span>
                    </div>
                </a>
            </div>

            <!-- NAVIGASI & SEARCH -->
            <div class="flex items-center justify-end gap-3 lg:gap-6 flex-1 min-w-0 font-black uppercase tracking-wider text-[11px]">

                <!-- Menu Kategori -->
                <div class="hidden xl:flex items-center gap-1">
                    <a href="{{ route('home') }}" class="text-neutral-600 dark:text-neutral-300 hover:text-red-600 px-3 py-2 rounded-lg transition-colors">Home</a>

                    @foreach($categories->take(3) as $navCat)
                    <a href="{{ route('category.show', $navCat->slug) }}" class="text-neutral-600 dark:text-neutral-300 hover:text-red-600 px-3 py-2 rounded-lg transition-colors whitespace-nowrap">{{ $navCat->name }}</a>
                    @endforeach

                    @if($categories->count() > 3)
                    <div class="relative">
                        <button @click.stop="isOtherMenuOpen = !isOtherMenuOpen" class="flex items-center gap-1 text-neutral-600 dark:text-neutral-300 hover:text-red-600 px-3 py-2 rounded-lg transition-colors">
                            Rubrik
                            <svg class="w-3 h-3 transition-transform" :class="isOtherMenuOpen ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="isOtherMenuOpen"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            class="absolute right-0 mt-2 w-56 bg-white dark:bg-[#1a1a1a] border border-neutral-200 dark:border-neutral-800 rounded-xl shadow-2xl py-3 overflow-hidden z-[60]" x-cloak>
                            @foreach($categories->skip(3) as $otherCat)
                            <a href="{{ route('category.show', $otherCat->slug) }}" class="block px-5 py-2.5 text-[10px] font-bold text-neutral-600 dark:text-neutral-300 hover:bg-neutral-50 dark:hover:bg-neutral-800 hover:text-red-600 transition-colors uppercase">
                                {{ $otherCat->name }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- PENCARIAN & KONTROL -->
                <div class="flex items-center gap-2 shrink-0">
                    <form action="{{ route('search') }}" method="GET" class="hidden md:block relative group">
                        <input type="text" name="q" placeholder="Cari..."
                            class="w-32 lg:w-40 focus:w-56 bg-neutral-100 dark:bg-[#121212] border border-neutral-300 dark:border-neutral-700 focus:border-red-500 rounded-full px-4 py-1.5 text-xs text-neutral-900 dark:text-white transition-all duration-300 outline-none">
                    </form>

                    <!-- Tombol Dark Mode (Sekarang muncul di semua ukuran layar) -->
                    <button @click="toggleDarkMode()" class="p-2 flex rounded-full text-neutral-500 hover:bg-neutral-200 dark:hover:bg-neutral-800 transition-colors focus:outline-none">
                        <svg x-show="!darkMode" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                        <svg x-show="darkMode" class="w-5 h-5 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" x-cloak><path d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    </button>

                    <!-- Tombol Menu Mobile -->
                    <button @click="isMobileMenuOpen = !isMobileMenuOpen" class="xl:hidden text-neutral-900 dark:text-neutral-300 p-2 focus:outline-none">
                        <svg x-show="!isMobileMenuOpen" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" /></svg>
                        <svg x-show="isMobileMenuOpen" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" x-cloak><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- MENU MOBILE (OVERLAY) -->
        <div x-show="isMobileMenuOpen" x-transition class="absolute top-full left-0 w-full bg-white dark:bg-[#0f0f0f] border-b border-neutral-200 dark:border-neutral-800 p-6 xl:hidden shadow-2xl z-[100]" x-cloak>
            
            <!-- Tambahan Pencarian di Mobile -->
            <form action="{{ route('search') }}" method="GET" class="mb-6">
                <input type="text" name="q" placeholder="Cari berita..." class="w-full bg-neutral-100 dark:bg-[#121212] border border-neutral-300 dark:border-neutral-700 focus:border-red-500 rounded-xl px-5 py-3 text-sm text-neutral-900 dark:text-white outline-none font-bold uppercase tracking-widest transition-colors">
            </form>

            <div class="flex flex-col gap-4 mb-6 pb-6 border-b border-neutral-200 dark:border-neutral-800">
                <p class="text-[10px] font-black text-neutral-400 uppercase tracking-widest mb-2">Seluruh Rubrik</p>
                <a href="{{ route('home') }}" class="text-lg font-black text-neutral-900 dark:text-white uppercase italic hover:text-red-600 transition-colors">Beranda</a>
                @foreach($categories as $cat)
                <a href="{{ route('category.show', $cat->slug) }}" class="text-lg font-black text-neutral-900 dark:text-white uppercase italic hover:text-red-600 transition-colors">{{ $cat->name }}</a>
                @endforeach
            </div>

            <!-- Tambahan Switch Dark Mode & YouTube di Menu Mobile -->
            <div class="flex flex-col gap-4">
                <button @click="toggleDarkMode()" class="flex items-center justify-between w-full p-4 bg-neutral-50 dark:bg-[#121212] rounded-xl text-xs font-black uppercase tracking-widest transition-colors">
                    <span x-text="darkMode ? 'Terangkan Layar' : 'Gelapkan Layar'" class="text-neutral-700 dark:text-neutral-300"></span>
                    <div class="w-10 h-6 bg-neutral-200 dark:bg-neutral-800 rounded-full relative">
                        <div class="absolute top-1 left-1 w-4 h-4 rounded-full transition-transform bg-white shadow-sm" :class="darkMode ? 'translate-x-4 bg-red-600' : ''"></div>
                    </div>
                </button>
            </div>
        </div>
    </nav>

    <!-- AREA KONTEN - DIBATASI LEBARNYA DAN DI TENGAH -->
    <main class="pt-24 pb-12 min-h-[60vh] flex flex-col items-center">
        <div class="w-full max-w-[1400px]">
            {{ $slot }}
        </div>
    </main>

    <!-- FOOTER - DIBATASI LEBARNYA -->
    <footer class="flex justify-center border-t border-neutral-200 dark:border-neutral-800">
        <div class="w-full max-w-[1400px]">
            <x-footer :settings="$settings" :categories="$categories" />
        </div>
    </footer>

    @stack('scripts')
    @livewireScripts

</body>

</html>