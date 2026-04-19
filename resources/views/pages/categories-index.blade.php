@php
$settings = $settings ?? [];
@endphp

<x-layouts.app :settings="$settings">
    @slot('title', 'Indeks Rubrik | ' . ($settings['site_name'] ?? 'Highlight NTT'))

    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 pt-28 lg:pt-36 pb-24">

        <!-- ============================== -->
        <!-- HEADER INDEKS RUBRIK           -->
        <!-- ============================== -->
        <header class="max-w-4xl mb-12 sm:mb-16 relative">
            <!-- Red Pillar Accent -->
            <div class="absolute -left-4 sm:-left-6 top-1 w-1.5 h-full bg-red-600 rounded-full"></div>

            <!-- Breadcrumbs -->
            <nav class="flex flex-wrap items-center text-[10px] sm:text-[11px] font-bold uppercase tracking-widest text-neutral-500 mb-5">
                <a href="{{ route('home') }}" class="hover:text-red-600 transition-colors">Beranda</a>
                <span class="mx-2.5">/</span>
                <span class="text-neutral-900 dark:text-white">Semua Rubrik</span>
            </nav>

            <h1 class="text-4xl md:text-5xl lg:text-[64px] font-[1000] text-neutral-900 dark:text-white tracking-[-0.04em] uppercase leading-[0.9] mb-6">
                Eksplorasi <br> <span class="text-red-600">Kanal Berita</span>
            </h1>
            <p class="text-neutral-600 dark:text-neutral-400 font-medium max-w-2xl text-sm sm:text-base leading-relaxed">
                Temukan berbagai topik dan isu terkini yang kami kurasi khusus untuk Anda. Mulai dari liputan mendalam, opini publik, hingga ragam budaya Nusa Tenggara Timur.
            </p>
        </header>

        <!-- ============================== -->
        <!-- GRID KATEGORI (KANAL)          -->
        <!-- ============================== -->
        @if(isset($categories) && $categories->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 sm:gap-6">
            @foreach($categories as $cat)
            <a href="{{ route('category.show', $cat->slug) }}" class="group relative bg-white dark:bg-[#121212] p-6 sm:p-8 rounded-[1.5rem] border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-xl hover:shadow-red-600/10 hover:border-red-600/30 dark:hover:border-red-600/50 transition-all duration-300 overflow-hidden flex flex-col justify-between min-h-[160px] active:scale-[0.98]">

                <!-- Aksen Garis Merah Hover -->
                <div class="absolute top-0 left-0 w-full h-1.5 bg-red-600 scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>

                <!-- Judul Kategori -->
                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="w-2 h-2 rounded-full bg-red-600 shadow-[0_0_10px_rgba(220,38,38,0.8)] group-hover:animate-pulse"></span>
                        <h2 class="text-xl sm:text-2xl font-[1000] uppercase tracking-tight text-neutral-900 dark:text-white group-hover:text-red-600 transition-colors">
                            {{ $cat->name }}
                        </h2>
                    </div>

                    <!-- Deskripsi Singkat Kategori (Jika Ada) -->
                    <p class="text-xs font-medium text-neutral-500 dark:text-neutral-400 line-clamp-2 leading-relaxed">
                        {{ $cat->description ?? 'Kumpulan berita dan artikel terbaru seputar topik ' . $cat->name . '.' }}
                    </p>
                </div>

                <!-- Indikator Interaksi (Panah) -->
                <div class="mt-6 flex items-center justify-between w-full border-t border-neutral-100 dark:border-neutral-800/50 pt-4 relative z-10">
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-neutral-400 group-hover:text-red-600 transition-colors">
                        Lihat Berita
                    </span>
                    <div class="w-8 h-8 rounded-full bg-neutral-50 dark:bg-[#1a1a1a] flex items-center justify-center group-hover:bg-red-600 group-hover:text-white text-neutral-400 transition-colors">
                        <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>

                <!-- Background Watermark (Initial Huruf Pertama) -->
                <div class="absolute -right-4 -bottom-8 text-[120px] font-[1000] text-neutral-50 dark:text-neutral-900/40 select-none pointer-events-none group-hover:text-red-50 dark:group-hover:text-red-900/10 transition-colors duration-500">
                    {{ substr($cat->name, 0, 1) }}
                </div>
            </a>
            @endforeach
        </div>
        @else
        <!-- State Jika Kategori Kosong -->
        <div class="py-24 flex flex-col items-center justify-center text-center bg-neutral-50 dark:bg-[#121212] rounded-[2.5rem] border border-neutral-200 dark:border-neutral-800">
            <div class="w-20 h-20 bg-neutral-200 dark:bg-neutral-800 rounded-full flex items-center justify-center mb-6">
                <svg class="w-10 h-10 text-neutral-400 dark:text-neutral-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                </svg>
            </div>
            <h3 class="text-xl sm:text-2xl font-[1000] text-neutral-900 dark:text-white uppercase tracking-tight mb-2">Kanal Belum Tersedia</h3>
            <p class="text-sm text-neutral-500 font-medium max-w-md px-6">Redaksi sedang mempersiapkan berbagai kanal berita menarik untuk Anda. Silakan kembali lagi nanti.</p>
        </div>
        @endif

    </div>
</x-layouts.app>