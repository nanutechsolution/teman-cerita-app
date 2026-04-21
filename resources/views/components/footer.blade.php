<footer class="bg-white dark:bg-[#0a0a0a] pt-16 lg:pt-24 pb-8 border-t border-neutral-100 dark:border-neutral-900 transition-colors duration-300 relative ">

    {{-- Efek Glow Halus di Background --}}
    <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-red-600/20 dark:via-red-600/30 to-transparent"></div>
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-32 bg-red-600/5 dark:bg-red-600/10 blur-[120px] pointer-events-none z-0"></div>

    {{-- Tombol Kembali ke Atas (Floating Modern) --}}
    <div class="absolute -top-7 left-1/2 -translate-x-1/2 z-20">
        <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" 
            class="group flex items-center justify-center w-14 h-14 bg-white dark:bg-[#151515] border border-neutral-200 dark:border-neutral-800 text-neutral-400 hover:text-red-600 rounded-full shadow-[0_4px_20px_rgb(0,0,0,0.08)] dark:shadow-none hover:-translate-y-2 transition-all duration-300 focus:outline-none ring-4 ring-white dark:ring-[#0a0a0a]">
            <svg class="w-5 h-5 group-hover:animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
            </svg>
        </button>
    </div>

    <div class="max-w-[1350px] mx-auto px-6 lg:px-8 relative z-10">

        <!-- MAIN GRID (Mobile First) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-12 lg:gap-8 xl:gap-16 mb-16 lg:mb-20">

            <!-- KOLOM 1: BRANDING (Span 5 di Desktop) -->
            <div class="lg:col-span-5 flex flex-col items-center sm:items-start text-center sm:text-left">
                <a href="{{ route('home') }}" class="group flex flex-col items-center sm:items-start gap-4 transition-all duration-500 outline-none mb-6">
                    <!-- Logo Circle -->
                    <div class="relative w-20 h-20 sm:w-24 sm:h-24 p-1 rounded-full border border-neutral-200 dark:border-neutral-800 group-hover:border-red-600/50 transition-colors duration-500 bg-neutral-50 dark:bg-[#111]">
                        <div class="w-full h-full rounded-full overflow-hidden">
                            @if(isset($settings['site_logo']))
                                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            @else
                                <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="Logo" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            @endif
                        </div>
                    </div>

                    <!-- Nama Situs -->
                    <div class="flex flex-col items-center sm:items-start select-none" style="font-family: 'Montserrat', sans-serif;">
                        <div class="flex flex-wrap justify-center sm:justify-start items-baseline leading-none">
                            <span class="text-3xl sm:text-4xl font-[1000] tracking-tight text-neutral-900 dark:text-white">
                                {{ Str::before($settings['site_name'] ?? 'Highlight NTT', ' ') }}
                            </span>
                            <span class="text-3xl sm:text-4xl font-[1000] tracking-tight text-red-600 ml-1.5">
                                {{ trim(Str::after($settings['site_name'] ?? 'Highlight NTT', ' ')) }}
                            </span>
                            <span class="text-xl sm:text-2xl font-black tracking-tighter text-blue-800 dark:text-blue-600">.com</span>
                        </div>
                        <span class="text-[11px] sm:text-xs font-extrabold tracking-[0.2em] text-neutral-500 uppercase mt-2.5">
                            {{ $settings['site_tagline'] ?? 'Tajam Menyoroti Fakta' }}
                        </span>
                    </div>
                </a>

                <p class="text-neutral-500 dark:text-neutral-400 leading-relaxed text-[15px] max-w-sm mb-8">
                    {{ $settings['site_description'] ?? 'Menyajikan jurnalisme berkualitas dengan kedalaman data dan integritas fakta. Mata dan suara masyarakat Nusa Tenggara Timur.' }}
                </p>

                <!-- Badge Dewan Pers Modern -->
                <div class="flex items-center gap-3 px-4 py-3 bg-neutral-50 dark:bg-[#121212] border border-neutral-200 dark:border-neutral-800 rounded-2xl w-full sm:w-auto hover:bg-white dark:hover:bg-[#151515] transition-colors cursor-default">
                    <div class="w-10 h-10 rounded-full bg-blue-100/50 dark:bg-blue-900/20 flex items-center justify-center text-blue-600 dark:text-blue-500 shrink-0">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10zm-2.5-6.5l-3-3 1.41-1.41L10 12.67l6.59-6.59L18 7.5l-8.5 8.5z" /></svg>
                    </div>
                    <div class="flex flex-col text-left">
                        <span class="text-[10px] font-bold text-neutral-500 tracking-widest uppercase">Media Siber Terverifikasi</span>
                        <span class="text-sm font-black text-neutral-900 dark:text-white tracking-wide">Dewan Pers Indonesia</span>
                    </div>
                </div>
            </div>

            <!-- KOLOM 2: KATEGORI (Span 3) -->
            <div class="lg:col-span-3 sm:pl-8 lg:pl-0 border-t sm:border-t-0 border-neutral-100 dark:border-neutral-800 pt-8 sm:pt-0">
                <h4 class="text-neutral-900 dark:text-white font-black tracking-widest text-xs uppercase mb-6 flex items-center gap-2">
                    <span class="w-2 h-2 bg-red-600 rounded-sm"></span> Kategori
                </h4>
                <ul class="space-y-3.5">
                    @forelse(collect($categories ?? [])->take(5) as $cat)
                    <li>
                        <a href="{{ route('category.show', $cat->slug) }}" class="text-neutral-500 dark:text-neutral-400 hover:text-red-600 dark:hover:text-red-500 transition-all duration-300 text-[15px] font-semibold flex items-center group w-fit">
                            <span class="group-hover:translate-x-1.5 transition-transform duration-300">{{ $cat->name }}</span>
                        </a>
                    </li>
                    @empty
                    <li><a href="#" class="text-neutral-500 hover:text-red-600 text-[15px] font-semibold">Berita Utama</a></li>
                    <li><a href="#" class="text-neutral-500 hover:text-red-600 text-[15px] font-semibold">Opini Publik</a></li>
                    <li><a href="#" class="text-neutral-500 hover:text-red-600 text-[15px] font-semibold">Budaya & Sosok</a></li>
                    @endforelse

                    @if(collect($categories ?? [])->count() > 5)
                    <li class="pt-2">
                        <a href="{{ route('category.index') }}" class="text-red-600 dark:text-red-500 hover:text-red-700 font-bold text-xs uppercase tracking-widest flex items-center gap-1.5 group w-fit mt-2">
                            Lihat Semua
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>

            <!-- KOLOM 3: INFORMASI (Span 2) -->
            <div class="lg:col-span-2 border-t sm:border-t-0 border-neutral-100 dark:border-neutral-800 pt-8 sm:pt-0">
                <h4 class="text-neutral-900 dark:text-white font-black tracking-widest text-xs uppercase mb-6 flex items-center gap-2">
                    <span class="w-2 h-2 bg-red-600 rounded-sm"></span> Informasi
                </h4>
                <ul class="space-y-3.5">
                    <li><a href="/" class="text-neutral-500 dark:text-neutral-400 hover:text-red-600 transition-colors text-[15px] font-semibold block w-fit hover:translate-x-1.5 duration-300">Beranda</a></li>
                    <li><a href="{{ route('redaksi') ?? '#' }}" class="text-neutral-500 dark:text-neutral-400 hover:text-red-600 transition-colors text-[15px] font-semibold block w-fit hover:translate-x-1.5 duration-300">Tentang Redaksi</a></li>
                    <li><a href="{{ route('iklan') ?? '#' }}" class="text-neutral-500 dark:text-neutral-400 hover:text-red-600 transition-colors text-[15px] font-semibold block w-fit hover:translate-x-1.5 duration-300">Info Iklan</a></li>
                    <li><a href="{{ route('suara-warga') ?? '#' }}" class="text-neutral-500 dark:text-neutral-400 hover:text-red-600 transition-colors text-[15px] font-semibold block w-fit hover:translate-x-1.5 duration-300">Kirim Tulisan</a></li>
                    <li><a href="{{ route('kontak') ?? '#' }}" class="text-neutral-500 dark:text-neutral-400 hover:text-red-600 transition-colors text-[15px] font-semibold block w-fit hover:translate-x-1.5 duration-300">Kontak Kami</a></li>
                </ul>
            </div>

            <!-- KOLOM 4: SOSIAL MEDIA (Span 2) -->
            <div class="lg:col-span-2 border-t sm:border-t-0 border-neutral-100 dark:border-neutral-800 pt-8 sm:pt-0">
                <h4 class="text-neutral-900 dark:text-white font-black tracking-widest text-xs uppercase mb-6 flex items-center gap-2">
                    <span class="w-2 h-2 bg-red-600 rounded-sm"></span> Ikuti Kami
                </h4>
                <div class="flex flex-wrap gap-3">
                    @php
                    $socials = [
                    ['url' => $settings['facebook_url'] ?? '#', 'color' => 'hover:bg-[#1877F2] hover:text-white hover:border-[#1877F2]', 'icon' => 'M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.323-.593 1.323-1.325V1.325C24 .593 23.407 0 22.675 0z'],
                    ['url' => $settings['instagram_url'] ?? '#', 'color' => 'hover:bg-[#E4405F] hover:text-white hover:border-[#E4405F]', 'icon' => 'M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.981 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z'],
                    ['url' => $settings['tiktok_url'] ?? '#', 'color' => 'hover:bg-black dark:hover:bg-white hover:text-white dark:hover:text-black hover:border-black dark:hover:border-white', 'icon' => 'M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-1.13-.32-2.43-.2-3.41.49-.88.61-1.33 1.71-1.3 2.75 0 .59.1 1.19.39 1.71.55.97 1.66 1.61 2.77 1.63 1.16.03 2.37-.53 2.97-1.52.4-.64.53-1.41.51-2.16-.01-4.29-.01-8.58-.01-12.87z'],
                    ];
                    @endphp

                    @foreach($socials as $social)
                    <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer" 
                        class="w-11 h-11 rounded-2xl bg-neutral-50 dark:bg-[#121212] border border-neutral-200 dark:border-neutral-800 flex items-center justify-center text-neutral-500 dark:text-neutral-400 {{ $social['color'] }} transition-all duration-300 hover:-translate-y-1.5 hover:shadow-lg">
                        <svg class="w-[18px] h-[18px] fill-current" viewBox="0 0 24 24">
                            <path d="{{ $social['icon'] }}" />
                        </svg>
                    </a>
                    @endforeach
                </div>
            </div>

        </div>

        {{-- BOTTOM FOOTER: Legal & Copyright --}}
        <div class="pt-8 border-t border-neutral-100 dark:border-neutral-800 flex flex-col md:flex-row justify-between items-center gap-6 text-center md:text-left">
            
            <div class="text-neutral-500 dark:text-neutral-400 text-xs sm:text-sm font-semibold">
                {{ $settings['footer_text'] ?? '© ' . date('Y') . ' Highlight NTT. Hak Cipta Dilindungi.' }}
            </div>

            <nav class="flex flex-wrap justify-center md:justify-end gap-x-6 gap-y-3">
                <a href="{{ route('page.show', 'kode-etik-jurnalistik') ?? '#' }}" class="text-neutral-400 hover:text-red-600 dark:hover:text-red-500 text-xs font-bold tracking-widest uppercase transition-colors">Kode Etik</a>
                <a href="{{ route('page.show', 'pedoman-media-siber') ?? '#' }}" class="text-neutral-400 hover:text-red-600 dark:hover:text-red-500 text-xs font-bold tracking-widest uppercase transition-colors">Pedoman Siber</a>
                <a href="{{ route('page.show', 'penafian') ?? '#' }}" class="text-neutral-400 hover:text-red-600 dark:hover:text-red-500 text-xs font-bold tracking-widest uppercase transition-colors">Penafian</a>
                <a href="{{ route('page.show', 'kebijakan-privasi') ?? '#' }}" class="text-neutral-400 hover:text-red-600 dark:hover:text-red-500 text-xs font-bold tracking-widest uppercase transition-colors">Privasi</a>
            </nav>

        </div>
    </div>
</footer>