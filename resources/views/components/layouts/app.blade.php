<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
    // --- Helper URL Gambar Meta & Favicon ---
    $logoUrl = asset('favicon.ico');
    if (!empty($settings['site_logo'])) {
        $logoUrl = str_starts_with($settings['site_logo'], 'http') ? $settings['site_logo'] : asset('storage/' . $settings['site_logo']);
    }

    $finalOgImage = $logoUrl;
    if (!empty($og_image)) {
        $finalOgImage = $og_image;
    } elseif (isset($post) && !empty($post->img)) {
        $finalOgImage = str_starts_with($post->img, 'http') ? $post->img : asset('storage/' . $post->img);
    }

    $finalOgType = $og_type ?? (isset($post) ? 'article' : 'website');
    @endphp

    {{-- SEO & Meta Tags --}}
    <title>{{ $title ?? $settings['site_name'] ?? config('app.name') }}</title>
    <meta name="description" content="{{ $meta_description ?? $settings['site_description'] ?? 'Kanal berbagi informasi dan cerita dari Nusa Tenggara Timur.' }}">
    <meta name="keywords" content="{{ $meta_keywords ?? 'berita ntt, teman cerita, jurnalisme ntt, podcast ntt, info kupang' }}">
    <link rel="canonical" href="{{ url()->current() }}">
    
    <meta property="og:type" content="{{ $finalOgType }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $title ?? $settings['site_name'] ?? config('app.name') }}">
    <meta property="og:description" content="{{ $meta_description ?? $settings['site_description'] ?? 'Kanal berbagi informasi dan cerita dari Nusa Tenggara Timur.' }}">
    <meta property="og:image" content="{{ $finalOgImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title ?? $settings['site_name'] ?? config('app.name') }}">
    <meta name="twitter:description" content="{{ $meta_description ?? $settings['site_description'] ?? 'Kanal berbagi informasi dan cerita dari Nusa Tenggara Timur.' }}">
    <meta name="twitter:image" content="{{ $finalOgImage }}">

    <link rel="icon" href="{{ $logoUrl }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    
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

    <!-- NAVBAR PORTAL -->
    <nav :class="isScrolled ? 'bg-white/95 dark:bg-[#0f0f0f]/95 backdrop-blur-xl border-neutral-200 dark:border-neutral-800 py-2 shadow-md' : 'bg-white/90 dark:bg-[#0f0f0f]/90 backdrop-blur-md border-transparent py-4 shadow-sm'"
        class="fixed w-full z-50 transition-all duration-300 border-b flex justify-center">
        
        <div class="absolute inset-0 z-0 opacity-30 dark:opacity-15 pointer-events-none"
            style="background-image: url('{{ asset('images/header.jpeg') }}'); 
            background-size: cover; 
            background-position: center;
            background-repeat: no-repeat;">
        </div>

        <div class="relative z-10 w-full max-w-[1400px] px-4 sm:px-6 flex justify-between items-center gap-4">

            <!-- 1. BRANDING SECTION -->
            <div class="flex items-center shrink-0 py-1">
                <a href="{{ route('home') }}" class="group flex items-center gap-3 sm:gap-4 transition-all duration-500">
                    <div class="relative flex-shrink-0">
                        <div class="relative w-[48px] h-[48px] sm:w-[60px] sm:h-[60px] lg:w-[68px] lg:h-[68px] flex items-center justify-center p-0.5">
                            <div class="w-full h-full overflow-hidden">
                                @if(!empty($settings['site_logo']))
                                    <img src="{{ str_starts_with($settings['site_logo'], 'http') ? $settings['site_logo'] : asset('storage/' . $settings['site_logo']) }}" alt="Logo" class="w-full h-full object-cover">
                                @else
                                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-cover">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col justify-center items-start select-none whitespace-nowrap pt-1" style="font-family: 'Montserrat', sans-serif;">
                        <div class="flex items-baseline leading-[0.9] flex-nowrap drop-shadow-md">
                            <span class="text-[clamp(22px,3.5vw,36px)] font-[1000] tracking-tight text-neutral-900 dark:text-white transition-colors">
                                {{ Str::before($settings['site_name'] ?? 'Highlight NTT', ' ') }}
                            </span>
                            <span class="text-[clamp(22px,3.5vw,36px)] font-[1000] tracking-tight text-red-600 dark:text-red-500 group-hover:text-red-700 transition-colors duration-300">
                                {{ trim(Str::after($settings['site_name'] ?? 'Highlight NTT', ' ')) }}
                            </span>
                            <span class="text-[clamp(12px,1.8vw,18px)] font-black tracking-tighter text-blue-800 dark:text-blue-600 group-hover:text-blue-900 transition-colors duration-300">.com</span>
                        </div>
                        <div class="relative mt-1.5 flex items-center group/tagline">
                            <span class="text-[8px] sm:text-[10px] lg:text-[11px] font-bold uppercase tracking-[0.15em] text-neutral-600 dark:text-neutral-400 drop-shadow-sm">
                                {{ $settings['site_tagline'] ?? 'Tajam Menyoroti Fakta, Teguh Menjaga Etika' }}
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- 2. NAVIGATION & CONTROLS -->
            <div class="flex items-center justify-end gap-2 lg:gap-5 flex-1 min-w-0">

                <!-- MENU DESKTOP -->
                <div class="hidden xl:flex items-center gap-1">
                    @php $isHome = request()->routeIs('home'); @endphp
                    <a href="{{ route('home') }}" class="relative px-3 py-2 text-[13px] font-bold uppercase tracking-wider transition-colors group {{ $isHome ? 'text-red-600' : 'text-neutral-800 dark:text-neutral-200 hover:text-red-600' }}">
                        Home
                        <span class="absolute -bottom-1 left-0 h-[2px] bg-red-600 transition-all duration-300 rounded-full {{ $isHome ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                    </a>

                    @if(isset($categories))
                        @foreach($categories->take(3) as $navCat)
                            @php $isActive = request()->fullUrlIs(route('category.show', $navCat->slug)); @endphp
                            <a href="{{ route('category.show', $navCat->slug) }}" class="relative px-3 py-2 text-[13px] font-bold uppercase tracking-wider transition-colors group {{ $isActive ? 'text-red-600' : 'text-neutral-800 dark:text-neutral-200 hover:text-red-600' }}">
                                {{ $navCat->name }}
                                <span class="absolute -bottom-1 left-0 h-[2px] bg-red-600 transition-all duration-300 rounded-full {{ $isActive ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                            </a>
                        @endforeach

                        @if($categories->count() > 3)
                            @php
                                $otherCats = $categories->skip(3);
                                $isDropdownActive = false;
                                foreach($otherCats as $other) {
                                    if(request()->fullUrlIs(route('category.show', $other->slug))) { $isDropdownActive = true; break; }
                                }
                            @endphp
                            <div class="relative ml-1">
                                <button @click.stop="isOtherMenuOpen = !isOtherMenuOpen" class="flex items-center gap-1.5 px-3 py-2 text-[13px] font-bold uppercase tracking-wider transition-colors group focus:outline-none {{ $isDropdownActive ? 'text-red-600' : 'text-neutral-800 dark:text-neutral-200 hover:text-red-600' }}">
                                    Rubrik
                                    <svg class="w-4 h-4 transition-transform duration-300" :class="isOtherMenuOpen ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                        <path d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <div x-show="isOtherMenuOpen" @click.away="isOtherMenuOpen = false" x-transition class="absolute right-0 mt-4 w-60 bg-white/95 dark:bg-[#121212]/95 backdrop-blur-xl border border-neutral-200 dark:border-neutral-800 rounded-xl shadow-2xl py-2 z-[100]" x-cloak>
                                    @foreach($otherCats as $otherCat)
                                        @php $isSubActive = request()->fullUrlIs(route('category.show', $otherCat->slug)); @endphp
                                        <a href="{{ route('category.show', $otherCat->slug) }}" class="flex items-center gap-3 px-5 py-3 text-[11px] font-bold hover:bg-neutral-50 dark:hover:bg-neutral-800 transition-all uppercase tracking-widest group {{ $isSubActive ? 'text-red-600 bg-red-50/50 dark:bg-red-900/10' : 'text-neutral-600 dark:text-neutral-300 hover:text-red-600' }}">
                                            <span class="w-1.5 h-1.5 rounded-full transition-colors {{ $isSubActive ? 'bg-red-600' : 'bg-neutral-300 dark:bg-neutral-600 group-hover:bg-red-600' }}"></span>
                                            {{ $otherCat->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endif
                </div>

                <!-- CONTROLS -->
                <div class="flex items-center gap-2 sm:gap-3 shrink-0">
                    <form action="{{ route('search') }}" method="GET" class="hidden md:block relative group">
                        <input type="text" name="q" placeholder="Cari berita..." class="w-28 lg:w-44 focus:w-60 pl-9 pr-4 py-2 bg-neutral-100/80 dark:bg-[#1a1a1a]/80 backdrop-blur-sm border border-neutral-200 dark:border-neutral-800 focus:border-red-500 rounded-full text-[13px] transition-all duration-300 outline-none">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                            <svg class="w-4 h-4 text-neutral-400 group-focus-within:text-red-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </form>

                    <div class="hidden sm:block w-px h-6 bg-neutral-300 dark:bg-neutral-700 mx-1"></div>

                    <button @click="toggleDarkMode()" class="p-2 sm:p-2.5 rounded-full hover:bg-neutral-200/50 dark:hover:bg-neutral-800/50 transition-all focus:outline-none group">
                        <svg x-show="!darkMode" class="w-5 h-5 text-neutral-600 group-hover:text-neutral-900" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                        <svg x-show="darkMode" class="w-5 h-5 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" x-cloak>
                            <path d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </button>

                    <button @click="isMobileMenuOpen = !isMobileMenuOpen" class="xl:hidden p-2 sm:p-2.5 rounded-xl bg-neutral-100 dark:bg-[#1a1a1a] text-neutral-900 dark:text-white transition-colors hover:bg-neutral-200 dark:hover:bg-neutral-800">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path x-show="!isMobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                            <path x-show="isMobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" x-cloak />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- 3. OVERLAY MENU MOBILE -->
        <div x-show="isMobileMenuOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-4"
            class="absolute top-full left-0 w-full max-h-[85vh] overflow-y-auto bg-white/98 dark:bg-[#0f0f0f]/98 backdrop-blur-2xl border-b border-neutral-200 dark:border-neutral-800 p-6 xl:hidden shadow-2xl z-[100]" x-cloak>

            <form action="{{ route('search') }}" method="GET" class="relative mb-8">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-neutral-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" name="q" placeholder="Cari berita..." class="w-full bg-neutral-100 dark:bg-[#1a1a1a] border border-transparent focus:border-red-600 rounded-2xl pl-12 pr-5 py-4 text-sm outline-none text-neutral-900 dark:text-white">
            </form>

            <div class="flex flex-col gap-2">
                <p class="text-[11px] font-black text-red-600 uppercase tracking-[0.2em] mb-4 px-2 flex items-center gap-2">
                    <span class="w-8 h-[2px] bg-red-600"></span> Rubrik Utama
                </p>

                @php $mHomeActive = request()->routeIs('home'); @endphp
                <a href="{{ route('home') }}" class="flex items-center justify-between px-4 py-4 rounded-2xl text-sm font-bold uppercase tracking-wider transition-all {{ $mHomeActive ? 'bg-red-600/10 text-red-600 shadow-sm' : 'bg-neutral-50 dark:bg-[#1a1a1a] text-neutral-800 dark:text-neutral-200' }}">
                    Beranda
                    <svg class="w-4 h-4 {{ $mHomeActive ? 'text-red-600' : 'text-neutral-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                    </svg>
                </a>

                @if(isset($categories))
                    @foreach($categories as $cat)
                        @php $mCatActive = request()->fullUrlIs(route('category.show', $cat->slug)); @endphp
                        <a href="{{ route('category.show', $cat->slug) }}" class="group flex items-center justify-between px-4 py-4 rounded-2xl transition-all border {{ $mCatActive ? 'bg-red-600/10 text-red-600 border-red-200 dark:border-red-900/30' : 'hover:bg-neutral-50 dark:hover:bg-[#1a1a1a] text-neutral-700 dark:text-neutral-300 border-transparent hover:border-neutral-200 dark:hover:border-neutral-800 text-sm font-bold uppercase tracking-wider' }}">
                            <div class="flex items-center gap-3">
                                <span class="w-1.5 h-1.5 rounded-full transition-colors {{ $mCatActive ? 'bg-red-600' : 'bg-neutral-300 dark:bg-neutral-600 group-hover:bg-red-600' }}"></span>
                                {{ $cat->name }}
                            </div>
                            <svg class="w-4 h-4 transition-all {{ $mCatActive ? 'text-red-600' : 'text-neutral-300 group-hover:text-red-600 group-hover:translate-x-1' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    @endforeach
                @endif
            </div>

            <div class="mt-10 pt-6 border-t border-neutral-100 dark:border-neutral-800 flex flex-col gap-4">
                <div class="flex items-center justify-between px-2">
                    <span class="text-xs font-bold text-neutral-500 uppercase tracking-wider">Mode Tampilan</span>
                    <button @click="toggleDarkMode()" class="p-2 bg-neutral-100 dark:bg-[#1a1a1a] rounded-xl">
                        <svg x-show="!darkMode" class="w-5 h-5 text-neutral-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                        <svg x-show="darkMode" class="w-5 h-5 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" x-cloak>
                            <path d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <main class="pt-24 pb-12 min-h-[60vh] flex flex-col items-center">
        <div class="w-full max-w-[1400px]">
            {{ $slot }}
        </div>
    </main>

    <x-ad-banner position="footer_top" />
    <footer class="flex justify-center border-t border-neutral-200 dark:border-neutral-800">
        <div class="w-full max-w-[1400px]">
            <x-footer :settings="$settings" :categories="$categories" />
        </div>
    </footer>

    @stack('scripts')
    @livewireScripts
</body>
</html>