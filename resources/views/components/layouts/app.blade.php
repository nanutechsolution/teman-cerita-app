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
                <a href="{{ route('home') }}" class="group flex items-center gap-2.5 sm:gap-3 transition-transform duration-300 hover:scale-[1.02]">

                    <!-- Wrapper Logo -->
                    <div class="relative w-10 h-10 sm:w-11 sm:h-11 flex-shrink-0 bg-neutral-100 dark:bg-[#1a1a1a] rounded-full flex items-center justify-center border border-neutral-200 dark:border-neutral-800 shadow-sm group-hover:border-red-600 group-hover:shadow-red-500/20 transition-all duration-300">
                        @if(isset($settings['site_logo']))
                        <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="Logo HighlightNTT" class="w-full h-full object-cover rounded-full">
                        @else
                        <!-- Fallback Icon jika logo kosong -->
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-neutral-800 dark:text-neutral-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 006-6v-1.5m-6 7.5a6 6 0 01-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 01-3-3V4.5a3 3 0 116 0v8.25a3 3 0 01-3 3z" />
                        </svg>
                        @endif
                    </div>

                    <!-- Wrapper Teks Typography -->
                    <div class="flex flex-col items-end select-none mt-0.5 sm:mt-0">

                        <!-- Baris "Highlight NTT" -->
                        <div class="flex items-baseline leading-none">
                            <span class="text-2xl sm:text-[28px] font-black tracking-tight 
                         text-white [-webkit-text-stroke:1px_#000] 
                         dark:text-[#121212] dark:[-webkit-text-stroke:1px_#fff]">
                                Highlight
                            </span>

                            <span class="text-2xl sm:text-[28px] font-black tracking-tight text-red-600 uppercase ml-0.5">
                                NTT
                            </span>
                        </div>

                        <!-- Baris ".com" -->
                        <span class="text-[10px] sm:text-[12px] font-black tracking-[0.15em] -mt-1 leading-none 
                     text-[#041E42] dark:text-[#e2e8f0]">
                            .com
                        </span>

                    </div>
                </a>
            </div>
            <!-- NAVIGASI & SEARCH -->
            <div class="flex items-center justify-end gap-4 lg:gap-6 flex-1 min-w-0">

                <!-- Menu Kategori (Desktop) -->
                <div class="hidden xl:flex items-center gap-2">
                    <a href="{{ route('home') }}" class="relative px-2 py-2 text-[13px] font-bold uppercase tracking-wider text-neutral-700 dark:text-neutral-200 hover:text-red-600 dark:hover:text-red-500 transition-colors group">
                        Home
                        <!-- Animated Underline -->
                        <span class="absolute -bottom-1 left-0 w-0 h-[2px] bg-red-600 transition-all duration-300 group-hover:w-full rounded-full"></span>
                    </a>

                    @foreach($categories->take(3) as $navCat)
                    <a href="{{ route('category.show', $navCat->slug) }}" class="relative px-2 py-2 text-[13px] font-bold uppercase tracking-wider text-neutral-700 dark:text-neutral-200 hover:text-red-600 dark:hover:text-red-500 transition-colors whitespace-nowrap group">
                        {{ $navCat->name }}
                        <span class="absolute -bottom-1 left-0 w-0 h-[2px] bg-red-600 transition-all duration-300 group-hover:w-full rounded-full"></span>
                    </a>
                    @endforeach

                    @if($categories->count() > 3)
                    <div class="relative ml-1">
                        <button @click.stop="isOtherMenuOpen = !isOtherMenuOpen" class="flex items-center gap-1.5 px-3 py-2 text-[13px] font-bold uppercase tracking-wider text-neutral-700 dark:text-neutral-200 hover:text-red-600 dark:hover:text-red-500 transition-colors group">
                            Rubrik
                            <svg class="w-4 h-4 transition-transform duration-300 group-hover:text-red-600" :class="isOtherMenuOpen ? 'rotate-180 text-red-600' : 'text-neutral-400'" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="isOtherMenuOpen"
                            @click.away="isOtherMenuOpen = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-2"
                            class="absolute right-0 mt-4 w-64 bg-white/95 dark:bg-[#151515]/95 backdrop-blur-md border border-neutral-100 dark:border-neutral-800 rounded-xl shadow-2xl py-2 overflow-hidden z-[60]" x-cloak>
                            @foreach($categories->skip(3) as $otherCat)
                            <a href="{{ route('category.show', $otherCat->slug) }}" class="flex items-center gap-3 px-5 py-3 text-[11px] font-bold text-neutral-600 dark:text-neutral-300 hover:bg-red-50 dark:hover:bg-[#202020] hover:text-red-600 dark:hover:text-red-500 transition-all uppercase tracking-widest group">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-600 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                                {{ $otherCat->name }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- PENCARIAN & KONTROL -->
                <div class="flex items-center gap-3 shrink-0 ml-2">

                    <!-- Search Bar Desktop -->
                    <form action="{{ route('search') }}" method="GET" class="hidden lg:block relative group">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-neutral-400 group-focus-within:text-red-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="q" placeholder="Cari berita..."
                            class="w-36 xl:w-48 focus:w-64 pl-10 pr-4 py-2 bg-neutral-100/80 dark:bg-[#1a1a1a] border border-neutral-200 dark:border-neutral-800 focus:border-red-500 dark:focus:border-red-600 rounded-full text-[13px] font-medium text-neutral-900 dark:text-white transition-all duration-300 outline-none focus:shadow-[0_0_15px_rgba(220,38,38,0.1)] placeholder-neutral-400 dark:placeholder-neutral-500">
                    </form>

                    <!-- Garis Pemisah (Divider) -->
                    <div class="hidden xl:block w-px h-6 bg-neutral-200 dark:bg-neutral-800 mx-1"></div>

                    <!-- Tombol Dark Mode -->
                    <button @click="toggleDarkMode()" class="p-2.5 rounded-full bg-neutral-50 dark:bg-[#1a1a1a] border border-neutral-200 dark:border-neutral-800 text-neutral-500 dark:text-neutral-400 hover:text-red-600 dark:hover:text-red-500 hover:border-red-200 dark:hover:border-red-900/50 hover:bg-white dark:hover:bg-[#222] transition-all duration-300 focus:outline-none" aria-label="Toggle Dark Mode">
                        <svg x-show="!darkMode" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                        <svg x-show="darkMode" class="w-4 h-4 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" x-cloak>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </button>

                    <!-- Tombol Menu Mobile -->
                    <button @click="isMobileMenuOpen = !isMobileMenuOpen" class="xl:hidden p-2.5 rounded-xl bg-neutral-100 dark:bg-[#1a1a1a] text-neutral-900 dark:text-white focus:outline-none hover:bg-neutral-200 dark:hover:bg-[#252525] transition-colors">
                        <svg x-show="!isMobileMenuOpen" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                        <svg x-show="isMobileMenuOpen" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" x-cloak>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                </div>
            </div>
        </div>

   <!-- MENU MOBILE (OVERLAY) -->
        <div x-show="isMobileMenuOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="absolute top-full left-0 w-full max-h-[85vh] overflow-y-auto bg-white/95 dark:bg-[#121212]/95 backdrop-blur-xl border-b border-neutral-200 dark:border-neutral-800 p-5 sm:p-6 xl:hidden shadow-[0_20px_40px_rgba(0,0,0,0.1)] dark:shadow-[0_20px_40px_rgba(0,0,0,0.5)] z-[100]" x-cloak>

            <!-- Kotak Pencarian Mobile -->
            <form action="{{ route('search') }}" method="GET" class="relative mb-8">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-neutral-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" name="q" placeholder="Cari berita..." 
                       class="w-full bg-neutral-100 dark:bg-[#1a1a1a] border border-transparent focus:border-red-500/50 rounded-2xl pl-11 pr-5 py-3.5 text-sm text-neutral-900 dark:text-white outline-none font-semibold transition-all shadow-inner focus:bg-white dark:focus:bg-[#121212]">
            </form>

            <!-- Menu Kategori (List Style) -->
            <div class="flex flex-col gap-1.5 mb-8">
                <p class="text-[11px] font-black text-neutral-400 dark:text-neutral-500 uppercase tracking-[0.2em] mb-2 px-2">Eksplorasi</p>
                
                <a href="{{ route('home') }}" class="group flex items-center justify-between px-4 py-3.5 rounded-xl text-sm font-bold uppercase tracking-wider text-neutral-800 dark:text-neutral-200 hover:bg-red-50 dark:hover:bg-[#1a1a1a] hover:text-red-600 dark:hover:text-red-500 transition-all active:scale-[0.98]">
                    <div class="flex items-center gap-3">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-600 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        Beranda
                    </div>
                    <svg class="w-4 h-4 text-neutral-400 group-hover:text-red-600 group-hover:translate-x-1 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>

                @foreach($categories as $cat)
                <a href="{{ route('category.show', $cat->slug) }}" class="group flex items-center justify-between px-4 py-3.5 rounded-xl text-sm font-bold uppercase tracking-wider text-neutral-800 dark:text-neutral-200 hover:bg-red-50 dark:hover:bg-[#1a1a1a] hover:text-red-600 dark:hover:text-red-500 transition-all active:scale-[0.98]">
                    <div class="flex items-center gap-3">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-600 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        {{ $cat->name }}
                    </div>
                    <svg class="w-4 h-4 text-neutral-400 group-hover:text-red-600 group-hover:translate-x-1 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
                @endforeach
            </div>

            <!-- Bagian Bawah: Switch Dark Mode -->
            <div class="border-t border-neutral-200 dark:border-neutral-800 pt-6 mt-2 pb-4">
                <button @click="toggleDarkMode()" class="flex items-center justify-between w-full p-4 bg-neutral-50 dark:bg-[#1a1a1a] rounded-2xl border border-neutral-100 dark:border-neutral-800 hover:border-neutral-300 dark:hover:border-neutral-700 transition-all active:scale-[0.98]">
                    
                    <div class="flex items-center gap-3">
                        <div class="p-2 rounded-full bg-white dark:bg-[#252525] shadow-sm text-neutral-600 dark:text-neutral-400">
                            <!-- Icon Sun (Light Mode) -->
                            <svg x-show="!darkMode" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <!-- Icon Moon (Dark Mode) -->
                            <svg x-show="darkMode" class="w-4 h-4 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" x-cloak>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                        </div>
                        <span class="text-xs font-bold uppercase tracking-widest text-neutral-800 dark:text-neutral-200" x-text="darkMode ? 'Mode Gelap Aktif' : 'Mode Terang Aktif'"></span>
                    </div>

                    <!-- Toggle UI -->
                    <div class="w-11 h-6 bg-neutral-300 dark:bg-neutral-700 rounded-full relative transition-colors duration-300" :class="darkMode ? 'bg-red-600 dark:bg-red-600' : ''">
                        <div class="absolute top-1 left-1 w-4 h-4 rounded-full bg-white shadow-md transition-transform duration-300" :class="darkMode ? 'translate-x-5' : ''"></div>
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