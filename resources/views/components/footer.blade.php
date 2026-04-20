<footer class="bg-white dark:bg-[#0a0a0a] pt-20 pb-8 border-t border-neutral-200 dark:border-neutral-900 transition-colors duration-300 relative">

    {{-- Wrapper Khusus Efek Glow Latar Belakang (Menggunakan overflow-hidden di sini agar tidak memotong tombol) --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-2xl h-32 bg-red-600/5 dark:bg-red-600/10 blur-[100px]"></div>
    </div>

    {{-- Tombol Kembali ke Atas (Back to Top) --}}
    <div class="absolute -top-6 left-1/2 -translate-x-1/2 z-20">
        <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="group bg-white dark:bg-[#1a1a1a] border border-neutral-200 dark:border-neutral-800 text-neutral-500 hover:text-red-600 p-3 rounded-full shadow-[0_8px_30px_rgb(0,0,0,0.12)] hover:-translate-y-1.5 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-red-600/50">
            <svg class="w-5 h-5 group-hover:animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
            </svg>
        </button>
    </div>

    <div class="max-w-[1400px] mx-auto px-5 sm:px-8 relative z-10">
        
        <!-- GRID UTAMA (Mobile First: 1 Kolom -> Tablet: 2 Kolom -> Desktop: 12 Kolom) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-y-14 gap-x-10 xl:gap-x-16 mb-16">

            {{-- ========================================== --}}
            {{-- KOLOM 1: BRANDING & FILOSOFI (Span 4)      --}}
            {{-- ========================================== --}}
            <div class="lg:col-span-4 flex flex-col items-center lg:items-start text-center lg:text-left space-y-7">

                <a href="/" class="group inline-flex flex-col items-center lg:items-start gap-5 transition-all duration-500 w-full">
                    
                    <!-- Logo Medallion -->
                    <div class="relative flex-shrink-0">
                        <div class="relative w-20 h-20 sm:w-24 sm:h-24 flex items-center justify-center p-1.5  transition-all duration-500">
                            <div class="w-full h-full  overflow-hidden flex items-center justify-center">
                                @if(isset($settings['site_logo']))
                                    <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="Logo" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                    @else
                                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Typography: Responsive Font Sizes agar tidak tumpah di kolom -->
                    <div class="flex flex-col items-center lg:items-start select-none w-full" style="font-family: 'Montserrat', sans-serif;">
                        
                        <div class="flex flex-wrap justify-center lg:justify-start items-baseline leading-[0.85] gap-x-1.5">
                            <span class="text-3xl sm:text-[40px] xl:text-[46px] font-[1000] tracking-[-0.04em] text-white [-webkit-text-stroke:1.5px_#000] [paint-order:stroke_fill] dark:text-[#0f0f0f] dark:[-webkit-text-stroke:1.5px_#fff]">
                                {{ Str::before($settings['site_name'] ?? 'Highlight NTT', ' ') }}
                            </span>
                            <div class="flex items-baseline">
                                <span class="text-3xl sm:text-[40px] xl:text-[46px] font-[1000] tracking-[-0.04em] text-red-600 uppercase group-hover:text-red-700 transition-colors duration-300">
                                    {{ Str::after($settings['site_name'] ?? 'Highlight NTT', ' ') }}
                                </span>
                                <span class="text-sm sm:text-base font-black tracking-tighter text-neutral-400 ml-0.5">.com</span>
                            </div>
                        </div>

                        <!-- Tagline & Motto -->
                        <div class="relative mt-4 sm:mt-5 flex flex-col items-center lg:items-start group/tagline w-full">
                            <span class="text-[11px] sm:text-[13px] font-black uppercase tracking-[0.15em] text-neutral-800 dark:text-neutral-200 leading-tight">
                                {{ $settings['site_tagline'] ?? 'Tajam Menyoroti Fakta' }}
                            </span>
                            
                            <!-- Aksen Garis Khas -->
                            <div class="mt-2.5 flex items-center justify-center lg:justify-start gap-1.5 w-full max-w-[200px]">
                                <div class="h-[2px] w-8 bg-red-600"></div>
                                <div class="h-[1px] flex-1 bg-neutral-200 dark:bg-neutral-800"></div>
                            </div>

                            <span class="text-[9px] sm:text-[10px] font-bold text-neutral-500 uppercase tracking-[0.25em] mt-2.5">
                                {{ $settings['site_motto'] ?? 'Nusa Tenggara Timur' }}
                            </span>
                        </div>
                    </div>
                </a>

                <p class="text-neutral-600 dark:text-neutral-400 leading-relaxed text-sm font-medium">
                    {{ $settings['site_description'] ?? 'Menyajikan jurnalisme berkualitas dengan kedalaman data dan integritas fakta. Mata dan suara masyarakat Nusa Tenggara Timur.' }}
                </p>

                <!-- Badge Dewan Pers -->
                <div class="inline-flex items-center gap-2.5 px-4 py-2.5 bg-neutral-50 dark:bg-[#1a1a1a] border border-neutral-200 dark:border-neutral-800 rounded-xl hover:border-blue-500/30 transition-all shadow-sm">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10zm-2.5-6.5l-3-3 1.41-1.41L10 12.67l6.59-6.59L18 7.5l-8.5 8.5z" /></svg>
                    <span class="text-[10px] sm:text-[11px] font-black text-neutral-700 dark:text-neutral-300 uppercase tracking-[0.1em]">Media Siber Terverifikasi</span>
                </div>
            </div>

            {{-- ========================================== --}}
            {{-- KOLOM 2 & 3: MENU NAVIGASI                 --}}
            {{-- ========================================== --}}
            <!-- Menggunakan Wrapper tambahan agar rapi di Tablet -->
            <div class="lg:col-span-4 grid grid-cols-2 gap-8 lg:gap-12">
                
                <!-- Kategori -->
                <div>
                    <h4 class="text-neutral-900 dark:text-white font-black uppercase tracking-widest text-xs mb-6 border-b-2 border-red-600 inline-block pb-2">
                        Kategori
                    </h4>
                    <ul class="space-y-4">
                        {{-- Membatasi hanya 5 kategori teratas yang muncul --}}
                        @forelse(collect($categories ?? [])->take(5) as $cat)
                        <li>
                            <a href="{{ route('category.show', $cat->slug) }}" class="text-neutral-600 dark:text-neutral-400 hover:text-red-600 dark:hover:text-red-500 transition-colors text-sm font-bold flex items-center gap-2.5 group py-1">
                                <span class="w-1.5 h-1.5 bg-red-600 rounded-sm opacity-0 group-hover:opacity-100 transition-all -translate-x-2 group-hover:translate-x-0"></span>
                                <span class="group-hover:translate-x-1 transition-transform">{{ $cat->name }}</span>
                            </a>
                        </li>
                        @empty
                        <li><a href="#" class="text-neutral-600 hover:text-red-600 text-sm font-bold py-1 inline-block">Berita Utama</a></li>
                        <li><a href="#" class="text-neutral-600 hover:text-red-600 text-sm font-bold py-1 inline-block">Opini Publik</a></li>
                        <li><a href="#" class="text-neutral-600 hover:text-red-600 text-sm font-bold py-1 inline-block">Budaya & Sosok</a></li>
                        @endforelse

                        {{-- Tautan "Lihat Semua" jika kategori lebih dari 5 --}}
                        @if(collect($categories ?? [])->count() > 5)
                        <li class="pt-2">
                            <a href="{{ route('category.index') }}" class="text-red-600 dark:text-red-500 hover:text-red-700 transition-colors text-xs font-black uppercase tracking-wider flex items-center gap-1.5 group">
                                Lihat Semua
                                <svg class="w-3 h-3 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>

                <!-- Informasi -->
                <div>
                    <h4 class="text-neutral-900 dark:text-white font-black uppercase tracking-widest text-xs mb-6 border-b-2 border-red-600 inline-block pb-2">
                        Informasi
                    </h4>
                    <ul class="space-y-4 font-bold text-sm">
                        <li><a href="/" class="text-neutral-600 dark:text-neutral-400 hover:text-red-600 transition-colors py-1 inline-block">Beranda</a></li>
                        <li><a href="{{ route('redaksi') ?? '#' }}" class="text-neutral-600 dark:text-neutral-400 hover:text-red-600 transition-colors py-1 inline-block">Tentang Redaksi</a></li>
                        <li><a href="{{ route('iklan') ?? '#' }}" class="text-neutral-600 dark:text-neutral-400 hover:text-red-600 transition-colors py-1 inline-block">Info Iklan</a></li>
                        <li><a href="{{ route('suara-warga') ?? '#' }}" class="text-neutral-600 dark:text-neutral-400 hover:text-red-600 transition-colors py-1 inline-block">Kirim Tulisan</a></li>
                        <li><a href="{{ route('kontak') ?? '#' }}" class="text-neutral-600 dark:text-neutral-400 hover:text-red-600 transition-colors py-1 inline-block">Kontak Kami</a></li>
                    </ul>
                </div>
            </div>

            {{-- ========================================== --}}
            {{-- KOLOM 4: NEWSLETTER, APPS & SOCIAL         --}}
            {{-- ========================================== --}}
            <div class="lg:col-span-4 space-y-8">
                
                <!-- Newsletter Box -->
                <div class="bg-neutral-50 dark:bg-[#151515] border border-neutral-200 dark:border-neutral-800 p-6 rounded-2xl relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-1 h-full bg-red-600"></div>
                    <h4 class="text-neutral-900 dark:text-white font-black uppercase tracking-wider text-xs mb-2">Buletin Redaksi</h4>
                    <p class="text-neutral-500 dark:text-neutral-400 text-xs mb-5 leading-relaxed">Kurasi berita independen terbaik NTT, langsung ke kotak masuk Anda.</p>
                    
                    <form action="#" class="flex flex-col sm:flex-row gap-2">
                        <input type="email" placeholder="Alamat Email" required class="w-full bg-white dark:bg-[#0f0f0f] border border-neutral-300 dark:border-neutral-700 rounded-xl px-4 py-3 text-sm text-neutral-900 dark:text-white focus:outline-none focus:border-red-600 focus:ring-2 focus:ring-red-600/20 transition-all placeholder-neutral-400">
                        <button type="submit" class="w-full sm:w-auto bg-red-600 text-white px-6 py-3 rounded-xl hover:bg-red-700 transition-colors font-bold text-sm tracking-wide shrink-0 shadow-md shadow-red-600/20 active:scale-95">
                            Daftar
                        </button>
                    </form>
                </div>

                <!-- App Stores -->
                <div>
                    <p class="text-neutral-900 dark:text-white text-xs font-black uppercase tracking-widest mb-3">Aplikasi Mobile</p>
                    <div class="flex flex-wrap gap-3">
                        <a href="#" class="flex items-center gap-3 bg-neutral-100 dark:bg-[#1a1a1a] border border-neutral-200 dark:border-neutral-800 hover:border-red-600 dark:hover:border-red-600 px-4 py-2.5 rounded-xl transition-all group active:scale-95">
                            <svg class="w-6 h-6 text-neutral-700 dark:text-white group-hover:text-red-600 transition-colors" viewBox="0 0 24 24" fill="currentColor"><path d="M3.6 3.1c-.2.2-.3.6-.3 1.1v15.6c0 .5.1.9.3 1.1l.1.1 8.8-8.8v-.2L3.7 3l-.1.1z M12.8 12l2.8-2.8 3.3 1.9c.9.5.9 1.4 0 1.9l-3.3 1.9-2.8-2.9v0z M13.1 12.3l-8.3 8.3c.5.5 1.3.6 2.2.1l6.1-3.5-0-4.9z M13.1 11.7l0-4.9-6.1-3.5C6.1 2.8 5.3 2.9 4.8 3.4l8.3 8.3z"/></svg>
                            <div class="flex flex-col text-left">
                                <span class="text-[9px] uppercase tracking-wider text-neutral-500 font-bold leading-none mb-0.5">Get it on</span>
                                <span class="text-xs font-black text-neutral-900 dark:text-white leading-none">Google Play</span>
                            </div>
                        </a>
                        <a href="#" class="flex items-center gap-3 bg-neutral-100 dark:bg-[#1a1a1a] border border-neutral-200 dark:border-neutral-800 hover:border-red-600 dark:hover:border-red-600 px-4 py-2.5 rounded-xl transition-all group active:scale-95">
                            <svg class="w-6 h-6 text-neutral-700 dark:text-white group-hover:text-red-600 transition-colors" viewBox="0 0 24 24" fill="currentColor"><path d="M12.152 6.896c-.948 0-2.415-1.078-3.96-1.04-2.04.027-3.91 1.183-4.961 3.014-2.117 3.675-.546 9.103 1.519 12.09 1.013 1.454 2.208 3.09 3.792 3.039 1.52-.065 2.09-.987 3.935-.987 1.831 0 2.35.987 3.96.948 1.637-.026 2.676-1.48 3.676-2.948 1.156-1.688 1.636-3.325 1.662-3.415-.039-.013-3.182-1.221-3.22-4.857-.026-3.04 2.48-4.494 2.597-4.559-1.429-2.09-3.623-2.324-4.39-2.376-2-.156-3.675 1.09-4.61 1.09zM15.53 3.83c.843-1.012 1.4-2.427 1.245-3.83-1.207.052-2.662.805-3.532 1.818-.78.896-1.454 2.338-1.273 3.714 1.338.104 2.715-.688 3.56-1.702z"/></svg>
                            <div class="flex flex-col text-left">
                                <span class="text-[9px] uppercase tracking-wider text-neutral-500 font-bold leading-none mb-0.5">Download on the</span>
                                <span class="text-xs font-black text-neutral-900 dark:text-white leading-none">App Store</span>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Social Media -->
                <div>
                    <p class="text-neutral-900 dark:text-white text-xs font-black uppercase tracking-widest mb-3">Media Sosial</p>
                    <div class="flex flex-wrap gap-2.5">
                        @php
                            $socials = [
                                ['url' => $settings['youtube_url'] ?? '#', 'color' => 'hover:bg-red-600', 'icon' => 'M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z'],
                                ['url' => $settings['instagram_url'] ?? '#', 'color' => 'hover:bg-pink-600', 'icon' => 'M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.981 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z'],
                                ['url' => $settings['facebook_url'] ?? '#', 'color' => 'hover:bg-blue-600', 'icon' => 'M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.323-.593 1.323-1.325V1.325C24 .593 23.407 0 22.675 0z'],
                                ['url' => $settings['tiktok_url'] ?? '#', 'color' => 'hover:bg-neutral-900 dark:hover:bg-white dark:hover:text-black', 'icon' => 'M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-1.13-.32-2.43-.2-3.41.49-.88.61-1.33 1.71-1.3 2.75 0 .59.1 1.19.39 1.71.55.97 1.66 1.61 2.77 1.63 1.16.03 2.37-.53 2.97-1.52.4-.64.53-1.41.51-2.16-.01-4.29-.01-8.58-.01-12.87z'],
                                ['url' => $settings['rss_feed_url'] ?? '/feed', 'color' => 'hover:bg-orange-500', 'icon' => 'M4 11a9 9 0 0 1 9 9H9c0-2.76-2.24-5-5-5v-4zm0-7a16 16 0 0 1 16 16h-4a12 12 0 0 0-12-12V4zm2 14a2 2 0 1 1-4 0 2 2 0 0 1 4 0z'],
                            ];
                        @endphp

                        @foreach($socials as $social)
                        <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-xl bg-neutral-100 dark:bg-[#1a1a1a] border border-neutral-200 dark:border-neutral-800 flex items-center justify-center text-neutral-500 dark:text-neutral-400 {{ $social['color'] }} hover:text-white hover:border-transparent transition-all hover:-translate-y-1">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="{{ $social['icon'] }}" /></svg>
                        </a>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>

        {{-- ========================================== --}}
        {{-- BOTTOM FOOTER: Legal & Copyright           --}}
        {{-- ========================================== --}}
        <div class="pt-8 border-t border-neutral-200 dark:border-neutral-800 flex flex-col md:flex-row justify-between items-center gap-6 text-center md:text-left">
            
            <!-- Copyright -->
            <div class="flex flex-col gap-1.5">
                <div class="text-neutral-900 dark:text-neutral-100 text-sm font-bold tracking-wide">
                    {{ $settings['footer_text'] ?? '© ' . date('Y') . ' Highlight NTT. Hak Cipta Dilindungi.' }}
                </div>
                <p class="text-neutral-500 dark:text-neutral-500 text-xs font-semibold">
                    {{ $settings['site_motto'] ?? 'Suara Independen dari Timur untuk Indonesia.' }}
                </p>
            </div>

            <!-- Legal Links -->
            <nav class="flex flex-wrap justify-center md:justify-end gap-x-6 gap-y-3 text-neutral-500 text-xs font-bold uppercase tracking-widest">
                <a href="{{ route('page.show', 'kode-etik-jurnalistik') ?? '#' }}" class="hover:text-red-600 transition-colors">Kode Etik</a>
                <a href="{{ route('page.show', 'pedoman-media-siber') ?? '#' }}" class="hover:text-red-600 transition-colors">Pedoman Siber</a>
                <a href="{{ route('page.show', 'penafian') ?? '#' }}" class="hover:text-red-600 transition-colors">Penafian</a>
                <a href="{{ route('page.show', 'kebijakan-privasi') ?? '#' }}" class="hover:text-red-600 transition-colors">Privasi</a>
            </nav>

        </div>
    </div>
</footer>