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

    <!-- NAVBAR PORTAL BERITA -->
    <nav :class="isScrolled ? 'bg-white/95 dark:bg-[#0f0f0f]/95 backdrop-blur-md border-neutral-200 dark:border-neutral-800 py-3 shadow-lg' : 'bg-transparent border-transparent py-5'"
        class="fixed w-full z-50 transition-all duration-300 border-b">
        <div class="max-w-[1440px] mx-auto px-4 sm:px-6 flex justify-between items-center gap-8">

            <!-- LOGO & BRANDING -->
            <div class="flex items-center shrink-0">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    @if(isset($settings['site_logo']))
                        <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="Logo" class="w-10 h-10 rounded-full object-cover border border-neutral-200 dark:border-neutral-800 shadow-md group-hover:border-red-600 transition-colors">
                    @else
                        <div class="relative w-10 h-10 bg-neutral-100 dark:bg-[#1a1a1a] rounded-full flex items-center justify-center border border-neutral-200 dark:border-neutral-800 group-hover:border-red-600 transition-colors shadow-sm shadow-red-900/10">
                            <svg class="w-5 h-5 text-neutral-800 dark:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 006-6v-1.5m-6 7.5a6 6 0 01-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 01-3-3V4.5a3 3 0 116 0v8.25a3 3 0 01-3 3z" />
                            </svg>
                        </div>
                    @endif
                    <div class="flex flex-col hidden lg:flex">
                        <span class="text-lg font-black tracking-tighter text-neutral-900 dark:text-white leading-none uppercase italic">
                            {{ $settings['site_name'] ?? 'Teman Cerita' }}
                        </span>
                        <span class="text-[9px] font-bold text-red-600 dark:text-red-500 tracking-widest uppercase mt-0.5">Portal Berita NTT</span>
                    </div>
                </a>
            </div>

            <!-- NAVIGASI & SEARCH -->
            <div class="flex items-center justify-end gap-3 lg:gap-6 flex-1 min-w-0 font-black uppercase tracking-wider text-[11px]">
                
                <!-- Menu Kategori (Maksimal 5 untuk Desktop) -->
                <div class="hidden xl:flex items-center gap-1">
                    <a href="{{ route('home') }}" class="text-neutral-600 dark:text-neutral-300 hover:text-red-600 px-3 py-2 rounded-lg transition-colors">Home</a>
                    
                    @foreach($categories->take(3) as $navCat)
                        <a href="{{ route('category.show', $navCat->slug) }}" class="text-neutral-600 dark:text-neutral-300 hover:text-red-600 px-3 py-2 rounded-lg transition-colors whitespace-nowrap">{{ $navCat->name }}</a>
                    @endforeach

                    @if($categories->count() > 3)
                    <div class="relative">
                        <button @click.stop="isOtherMenuOpen = !isOtherMenuOpen" class="flex items-center gap-1 text-neutral-600 dark:text-neutral-300 hover:text-red-600 px-3 py-2 rounded-lg transition-colors">
                            Rubrik
                            <svg class="w-3 h-3 transition-transform" :class="isOtherMenuOpen ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="isOtherMenuOpen" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             class="absolute right-0 mt-2 w-56 bg-white dark:bg-[#1a1a1a] border border-neutral-200 dark:border-neutral-800 rounded-xl shadow-2xl py-3 overflow-hidden z-[60]" x-cloak>
                            @foreach($categories->skip(5) as $otherCat)
                                <a href="{{ route('category.show', $otherCat->slug) }}" class="block px-5 py-2.5 text-[10px] font-bold text-neutral-600 dark:text-neutral-300 hover:bg-neutral-50 dark:hover:bg-neutral-800 hover:text-red-600 transition-colors uppercase">
                                    {{ $otherCat->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- KOLOM PENCARIAN & INDEKS KALENDER -->
                <div class="hidden md:flex items-center gap-2 shrink-0">
                    <form action="{{ route('search') }}" method="GET" class="relative group">
                        <input type="text" name="q" placeholder="Cari berita..." 
                            class="w-36 lg:w-48 focus:w-56 lg:focus:w-72 bg-neutral-100 dark:bg-[#121212] border border-neutral-300 dark:border-neutral-700 focus:border-red-500 rounded-full px-4 py-1.5 text-xs text-neutral-900 dark:text-white transition-all duration-300 outline-none placeholder:text-neutral-500 font-bold uppercase tracking-widest">
                        <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-neutral-400 group-focus-within:text-red-600 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </button>
                    </form>
                    
                    {{-- Tombol Indeks Berita (Cari Tanggal) --}}
                    <a href="{{ route('indeks') }}" class="p-2 text-neutral-500 hover:text-red-600 transition-colors" title="Indeks Berita / Cari Tanggal">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </a>
                </div>

                <!-- KONTROL TAMBAHAN -->
                <div class="flex items-center gap-2 shrink-0">
                    <button @click="toggleDarkMode()" class="p-2 hidden sm:flex rounded-full text-neutral-500 hover:bg-neutral-200 dark:hover:bg-neutral-800 transition-colors focus:outline-none">
                        <svg x-show="!darkMode" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                        <svg x-show="darkMode" class="w-5 h-5 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" x-cloak><path d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    </button>

                    <a href="{{ $settings['youtube_url'] ?? '#' }}" target="_blank"
                        class="hidden md:flex bg-red-600 text-white px-4 py-2 rounded-full font-black uppercase text-[10px] tracking-[0.2em] hover:bg-red-700 transition-all active:scale-95 items-center gap-2 shadow-lg shadow-red-900/20 italic">
                        YouTube
                    </a>

                    <!-- Tombol Menu Mobile -->
                    <button @click="isMobileMenuOpen = !isMobileMenuOpen" class="xl:hidden text-neutral-900 dark:text-neutral-300 p-2 focus:outline-none">
                        <svg x-show="!isMobileMenuOpen" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" /></svg>
                        <svg x-show="isMobileMenuOpen" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" x-cloak><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- MENU MOBILE (OVERLAY) -->
        <div x-show="isMobileMenuOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="absolute top-full left-0 w-full bg-white dark:bg-[#0f0f0f] border-b border-neutral-200 dark:border-neutral-800 p-6 flex flex-col gap-6 xl:hidden shadow-2xl overflow-y-auto max-h-screen z-[100]" x-cloak>
            
            <form action="{{ route('search') }}" method="GET" class="flex items-center w-full bg-neutral-100 dark:bg-[#121212] rounded-full border border-neutral-300 dark:border-neutral-700 overflow-hidden">
                <input type="text" name="q" placeholder="Cari berita..." class="w-full bg-transparent text-neutral-900 dark:text-white px-5 py-3 outline-none text-sm font-bold uppercase tracking-widest">
            </form>

            <div class="flex flex-col gap-2 border-b border-neutral-200 dark:border-neutral-800 pb-6">
                <p class="text-[10px] font-black text-neutral-400 uppercase tracking-widest mb-4">Navigasi Utama</p>
                <a href="{{ route('home') }}" class="text-xl font-black text-neutral-900 dark:text-white hover:text-red-600 transition-colors uppercase italic">Beranda</a>
                <a href="{{ route('indeks') }}" class="text-xl font-black text-red-600 hover:text-red-700 transition-colors uppercase italic flex items-center gap-2">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    Indeks Berita (Cari Tanggal)
                </a>
                
                <div class="h-px bg-neutral-100 dark:bg-neutral-800 my-4"></div>
                <p class="text-[10px] font-black text-neutral-400 uppercase tracking-widest mb-2">Seluruh Rubrik</p>
                @foreach($categories as $cat)
                    <a href="{{ route('category.show', $cat->slug) }}" class="text-lg font-black text-neutral-900 dark:text-white hover:text-red-600 transition-colors uppercase italic">{{ $cat->name }}</a>
                @endforeach
            </div>

            <div class="flex flex-col gap-4">
                <button @click="toggleDarkMode()" class="flex items-center justify-between w-full p-4 bg-neutral-50 dark:bg-[#121212] rounded-xl text-xs font-black uppercase tracking-widest">
                    <span x-text="darkMode ? 'Terangkan Layar' : 'Gelapkan Layar'"></span>
                    <div class="w-10 h-6 bg-neutral-200 dark:bg-neutral-800 rounded-full relative">
                        <div class="absolute top-1 left-1 w-4 h-4 rounded-full transition-transform bg-white shadow-sm" :class="darkMode ? 'translate-x-4 bg-red-600' : ''"></div>
                    </div>
                </button>
                <a href="{{ $settings['youtube_url'] ?? '#' }}" target="_blank" class="bg-red-600 text-white p-4 rounded-xl font-black text-center uppercase tracking-[0.2em] italic">Subscribe YouTube</a>
            </div>
        </div>
    </nav>

    <!-- AREA KONTEN -->
    <main class="pt-24 pb-12 min-h-[60vh]">
        {{ $slot }}
    </main>

    <!-- FOOTER COMPONENT -->
    <x-footer :settings="$settings" :categories="$categories" />

    @livewireScripts
</body>

</html>