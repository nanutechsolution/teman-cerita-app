<x-layouts.app :settings="$settings">
    {{-- Meta SEO dinamis --}}
    @slot('title', 'Beranda | ' . ($settings['site_name'] ?? 'Highlight NTT'))
    @slot('meta_description', $settings['site_description'] ?? 'Portal berita independen dari Nusa Tenggara Timur.')

    <style>
        /* Utility class untuk menyembunyikan scrollbar tapi tetap bisa di-scroll */
        .hide-scroll {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
        .hide-scroll::-webkit-scrollbar {
            display: none; /* Chrome, Safari and Opera */
        }
        /* Style khusus untuk angka Terpopuler ala Editorial Besar */
        .editorial-number {
            -webkit-text-stroke: 1px rgba(220, 38, 38, 0.3); /* Red stroke */
            color: transparent;
        }
        .dark .editorial-number {
            -webkit-text-stroke: 1px rgba(239, 68, 68, 0.4);
        }
        .group:hover .editorial-number {
            color: rgba(220, 38, 38, 0.1);
        }
    </style>

    <div class="max-w-[1400px] mx-auto px-0 sm:px-4 lg:px-8 pt-0 sm:pt-6 pb-24">

        <!-- 1. KILAS BERITA (TICKER) -->
        @if(isset($breakingNews) && $breakingNews->count() > 0)
        <div class="flex items-center bg-white dark:bg-[#121212] border-y sm:border border-neutral-200 dark:border-neutral-800 mb-4 shadow-sm sm:rounded-lg overflow-hidden">
            <div class="bg-red-600 text-white px-4 sm:px-5 py-2.5 text-[10px] sm:text-[11px] font-black uppercase tracking-widest shrink-0 flex items-center gap-2 relative z-10">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
                </span>
                Kilas Berita
            </div>
            <div class="overflow-hidden w-full px-4 relative flex items-center bg-neutral-50 dark:bg-[#1a1a1a] h-full py-2.5">
                <marquee class="text-[12px] sm:text-[13px] font-semibold text-neutral-800 dark:text-neutral-200 flex items-center h-full" scrollamount="4" onmouseover="this.stop();" onmouseout="this.start();">
                    @foreach($breakingNews as $item)
                        <a href="{{ route('post.show', $item->slug) }}" class="hover:text-red-600 transition-colors mx-4">{{ $item->title }}</a>
                        @if(!$loop->last) <span class="text-neutral-300 dark:text-neutral-700 mx-2">|</span> @endif
                    @endforeach
                </marquee>
            </div>
        </div>
        @endif

        <!-- TOPIK HANGAT (TRENDING TAGS) -->
        <!-- <div class="flex flex-wrap items-center gap-2 sm:gap-3 mb-8 sm:mb-10 px-4 sm:px-0">
            <span class="text-[10px] sm:text-[11px] font-black text-neutral-500 uppercase tracking-widest flex items-center gap-1">
                <svg class="w-4 h-4 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                Topik Hangat:
            </span>
            <div class="flex flex-wrap gap-2">
                <a href="#" class="px-3 py-1 bg-red-50 text-red-600 dark:bg-red-900/20 dark:text-red-400 text-[10px] sm:text-xs font-bold uppercase tracking-wider rounded-full hover:bg-red-600 hover:text-white transition-all border border-red-100 dark:border-red-900/30">#PilkadaNTT2024</a>
                <a href="#" class="px-3 py-1 bg-neutral-100 text-neutral-700 dark:bg-[#1a1a1a] dark:text-neutral-300 text-[10px] sm:text-xs font-bold uppercase tracking-wider rounded-full hover:bg-neutral-200 dark:hover:bg-neutral-800 transition-all border border-neutral-200 dark:border-neutral-800">#KTT_ASEAN_LabuanBajo</a>
                <a href="#" class="px-3 py-1 bg-neutral-100 text-neutral-700 dark:bg-[#1a1a1a] dark:text-neutral-300 text-[10px] sm:text-xs font-bold uppercase tracking-wider rounded-full hover:bg-neutral-200 dark:hover:bg-neutral-800 transition-all border border-neutral-200 dark:border-neutral-800 hidden sm:inline-block">#EkonomiDigital</a>
            </div>
        </div> -->

        <!-- 2. HERO SECTION: MOSAIC HEADLINES & TERPOPULER -->
        <div class="grid grid-cols-1 xl:grid-cols-12 gap-0 sm:gap-6 lg:gap-8 mb-12 items-start px-4 sm:px-0">
            
            <!-- Berita Utama (Mosaic Area - 8 Kolom) -->
            <div class="xl:col-span-8 group/headline">
                @if(isset($headlines) && $headlines->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 grid-rows-none lg:grid-rows-2 gap-3 sm:gap-4 h-auto lg:h-[480px] xl:h-[540px]">
                        
                        {{-- ITEM 1: Headline Utama (Besar) --}}
                        @php $mainHeadline = $headlines[0]; @endphp
                        <div class="md:col-span-2 lg:col-span-2 lg:row-span-2 relative group overflow-hidden rounded-xl h-[300px] md:h-[400px] lg:h-full border border-neutral-200 dark:border-neutral-800 shadow-sm">
                            <a href="{{ route('post.show', $mainHeadline->slug) }}" class="block w-full h-full relative">
                                <img src="{{ $mainHeadline->img ? asset('storage/' . $mainHeadline->img) : 'https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&w=1200&q=80' }}" 
                                     alt="{{ $mainHeadline->title }}" 
                                     class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 ease-out">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/40 to-transparent"></div>
                                <div class="absolute bottom-0 left-0 w-full p-5 lg:p-7 z-10 flex flex-col justify-end h-full">
                                    <h2 class="text-2xl sm:text-3xl lg:text-[32px] font-extrabold text-white leading-tight mb-2 drop-shadow-md line-clamp-3 group-hover:text-neutral-200 transition-colors">
                                        {{ $mainHeadline->title }}
                                    </h2>
                                    <span class="text-amber-500 text-[11px] sm:text-[13px] font-black uppercase tracking-widest drop-shadow-sm">
                                        {{ $mainHeadline->category->name ?? 'Nasional' }}
                                    </span>
                                </div>
                            </a>
                        </div>

                        {{-- ITEM 2-5: Headline Kecil (Mosaic 2x2 di Kanan) --}}
                        @for($i = 1; $i <= 4; $i++)
                            @if(isset($headlines[$i]))
                                @php $hl = $headlines[$i]; @endphp
                                <div class="relative group overflow-hidden rounded-xl h-[200px] sm:h-[220px] lg:h-full border border-neutral-200 dark:border-neutral-800 shadow-sm">
                                    <a href="{{ route('post.show', $hl->slug) }}" class="block w-full h-full relative">
                                        <img src="{{ $hl->img ? asset('storage/' . $hl->img) : 'https://images.unsplash.com/photo-1540910419892-4a36d2c3266c?auto=format&fit=crop&w=600&q=80' }}" 
                                             alt="{{ $hl->title }}" 
                                             class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 ease-out">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/40 to-transparent"></div>
                                        <div class="absolute bottom-0 left-0 w-full p-4 z-10 flex flex-col justify-end h-full">
                                            <h3 class="text-sm sm:text-[15px] lg:text-base font-extrabold text-white leading-snug mb-1.5 drop-shadow-md line-clamp-3 group-hover:text-neutral-200 transition-colors">
                                                {{ $hl->title }}
                                            </h3>
                                            <span class="text-amber-500 text-[9px] sm:text-[10px] font-black uppercase tracking-widest drop-shadow-sm">
                                                {{ $hl->category->name ?? 'Nasional' }}
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            @else
                                <div class="relative overflow-hidden rounded-xl bg-neutral-200 dark:bg-[#1a1a1a] animate-pulse h-[200px] lg:h-full hidden lg:block border border-neutral-200 dark:border-neutral-800"></div>
                            @endif
                        @endfor
                        
                    </div>
                @else
                    <!-- Fallback jika kosong -->
                    <div class="relative aspect-[4/3] sm:aspect-[16/9] overflow-hidden bg-neutral-100 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-xl flex flex-col items-center justify-center text-neutral-400 p-10 text-center">
                        <p class="font-black uppercase tracking-widest text-xs">Redaksi sedang menyiapkan Headline</p>
                    </div>
                @endif
            </div>

            <!-- Terpopuler Sidebar (4 Kolom) -->
            <div class="xl:col-span-4 mt-8 xl:mt-0 flex flex-col h-full bg-neutral-50 dark:bg-[#161616] border border-neutral-200 dark:border-neutral-800 p-5 sm:p-6 rounded-xl shadow-sm">
                <div class="flex items-center justify-between border-b-[3px] border-black dark:border-white pb-2 mb-4">
                    <h2 class="text-xl font-black text-neutral-900 dark:text-white uppercase tracking-tight">Terpopuler</h2>
                </div>
                <div class="flex flex-col flex-1 justify-between gap-1">
                    @forelse($trendingNews ?? [] as $index => $news)
                    <a href="{{ route('post.show', $news->slug) }}" class="group relative flex items-center py-3 border-b border-neutral-200 dark:border-neutral-800 last:border-0 hover:bg-white dark:hover:bg-[#1a1a1a] transition-all -mx-2 px-2 rounded-lg z-10 overflow-hidden">
                        <!-- Angka Raksasa Latar Belakang (Magazine Style) -->
                        <span class="editorial-number absolute -left-2 top-1/2 -translate-y-1/2 text-[80px] font-black italic leading-none z-[-1] transition-colors duration-500 pointer-events-none select-none">
                            {{ $index + 1 }}
                        </span>
                        
                        <div class="flex flex-col pl-6">
                            <span class="text-[9px] font-bold text-red-600 uppercase tracking-widest mb-1">{{ $news->category->name ?? 'Update' }}</span>
                            <h3 class="text-[14px] sm:text-[15px] font-bold text-neutral-900 dark:text-neutral-100 leading-[1.4] line-clamp-2 group-hover:text-red-600 transition-colors">
                                {{ $news->title }}
                            </h3>
                        </div>
                    </a>
                    @empty
                    <div class="py-10 text-center z-10 relative">
                        <p class="text-xs text-neutral-400 font-bold uppercase tracking-widest">Belum Ada Data</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
      <!-- 4. FOKUS KATEGORI DINAMIS -->
        @if(isset($focusPosts) && $focusPosts->count() > 0)
        <section class="mb-16 px-4 sm:px-0">
            <div class="flex items-center gap-4 border-b-[3px] border-black dark:border-white pb-2 mb-6">
                <div class="w-4 h-4 bg-red-600"></div>
                <!-- Judul Kategori Dinamis -->
                <h2 class="text-2xl font-black text-neutral-900 dark:text-white uppercase tracking-tighter">
                    {{ $focusCategory->name ?? 'Fokus Utama' }}
                </h2>
                <!-- Link Dinamis ke halaman kategori -->
                <a href="{{ isset($focusCategory) ? route('category.show', $focusCategory->slug) : '#' }}" class="ml-auto text-[10px] sm:text-xs font-bold uppercase tracking-widest text-neutral-500 hover:text-red-600 transition-colors">Lihat Semua &rarr;</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 lg:gap-8">
                
                <!-- Highlight Berita (Kiri - 7 Kolom) -->
                @php $mainFocus = $focusPosts->first(); @endphp
                <div class="md:col-span-7">
                    <a href="{{ route('post.show', $mainFocus->slug) }}" class="group block relative h-full overflow-hidden bg-neutral-50 dark:bg-[#121212] p-3 sm:p-4 border border-neutral-200 dark:border-neutral-800 hover:border-red-200 dark:hover:border-red-900/30 transition-colors rounded-xl flex flex-col">
                        <div class="aspect-[16/9] w-full overflow-hidden bg-neutral-200 mb-4 rounded-lg shrink-0">
                            <img src="{{ $mainFocus->img ? asset('storage/' . $mainFocus->img) : 'https://images.unsplash.com/photo-1540910419892-4a36d2c3266c?q=80&w=800&auto=format&fit=crop' }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                                 alt="{{ $mainFocus->title }}">
                        </div>
                        <div class="flex-1 flex flex-col justify-center">
                            <span class="text-[10px] font-bold text-red-600 uppercase tracking-widest mb-2 block">Laporan Khusus</span>
                            <h3 class="text-xl sm:text-3xl font-black text-neutral-900 dark:text-white leading-tight mb-3 group-hover:text-red-600 transition-colors">
                                {{ $mainFocus->title }}
                            </h3>
                            <p class="text-sm text-neutral-600 dark:text-neutral-400 line-clamp-3 leading-relaxed">
                                {{ Str::limit(strip_tags($mainFocus->excerpt ?? $mainFocus->content), 200) }}
                            </p>
                        </div>
                    </a>
                </div>

                <!-- List Berita (Kanan - 5 Kolom) -->
                <div class="md:col-span-5 flex flex-col gap-5">
                    {{-- Lewati berita pertama (karena sudah di kiri), lalu ambil maksimal 4 berita berikutnya --}}
                    @foreach($focusPosts->skip(1)->take(4) as $post)
                    <a href="{{ route('post.show', $post->slug) }}" class="group flex gap-4 items-center pb-5 border-b border-neutral-200 dark:border-neutral-800 last:border-0 last:pb-0">
                        <div class="w-24 h-24 sm:w-28 sm:h-28 shrink-0 overflow-hidden bg-neutral-200 border border-neutral-200 dark:border-neutral-800 rounded-lg">
                            <img src="{{ $post->img ? asset('storage/' . $post->img) : 'https://images.unsplash.com/photo-1526470608268-f674ce90ebd4?q=80&w=200&auto=format&fit=crop' }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" 
                                 alt="{{ $post->title }}">
                        </div>
                        <div class="flex flex-col justify-center">
                            <span class="text-[9px] font-bold text-red-600 uppercase tracking-widest mb-1">
                                {{ $post->category->name ?? ($focusCategory->name ?? 'Update') }}
                            </span>
                            <h4 class="text-sm sm:text-[15px] font-bold text-neutral-900 dark:text-white leading-[1.4] line-clamp-3 group-hover:text-red-600 transition-colors">
                                {{ $post->title }}
                            </h4>
                            <span class="text-[10px] text-neutral-400 font-medium mt-2">
                                {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->diffForHumans() : '' }}
                            </span>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        <!-- 5. MULTIMEDIA / GALERI VIDEO -->
        <section class="mb-16 -mx-4 sm:mx-0 px-4 py-12 sm:p-12 bg-neutral-900 dark:bg-[#0a0a0a] sm:rounded-2xl relative overflow-hidden shadow-lg border border-neutral-800">
            <div class="absolute top-0 right-0 w-64 h-64 bg-red-600/10 blur-[100px] rounded-full"></div>
            
            <div class="flex items-center gap-4 border-b-[3px] border-neutral-700 pb-2 mb-8 relative z-10">
                <div class="w-4 h-4 bg-red-600 rounded-full animate-pulse"></div>
                <h2 class="text-2xl font-black text-white uppercase tracking-tighter">Highlight Video</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 relative z-10">
                <div class="md:col-span-2 relative group cursor-pointer">
                    <div class="aspect-video w-full overflow-hidden bg-black rounded-xl border border-neutral-800">
                        <img src="https://images.unsplash.com/photo-1517554558209-4081c7f8a70c?q=80&w=800&auto=format&fit=crop" class="w-full h-full object-cover opacity-80 group-hover:scale-105 group-hover:opacity-100 transition-all duration-500">
                    </div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-16 h-16 bg-red-600/90 rounded-full flex items-center justify-center backdrop-blur-sm group-hover:bg-red-500 group-hover:scale-110 transition-all shadow-lg shadow-red-600/30">
                            <svg class="w-8 h-8 text-white ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                    <div class="absolute bottom-0 left-0 w-full p-6 bg-gradient-to-t from-black/90 to-transparent rounded-b-xl">
                        <span class="bg-red-600 text-white text-[9px] font-bold px-2 py-0.5 uppercase tracking-widest w-max mb-2 block rounded-sm">Eksklusif</span>
                        <h3 class="text-xl sm:text-2xl font-bold text-white line-clamp-2">Wawancara Eksklusif: Arah Pembangunan Ekonomi Digital NTT 2025</h3>
                    </div>
                </div>

                <div class="flex flex-col gap-4">
                    @for ($i = 0; $i < 3; $i++)
                    <div class="group flex gap-4 cursor-pointer p-2 -mx-2 hover:bg-white/5 rounded-xl transition-colors">
                        <div class="w-32 aspect-video shrink-0 relative overflow-hidden bg-black rounded-lg border border-neutral-800">
                            <img src="https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?q=80&w=300&auto=format&fit=crop" class="w-full h-full object-cover opacity-70 group-hover:opacity-100 transition-opacity">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="w-8 h-8 bg-black/60 rounded-full flex items-center justify-center backdrop-blur-sm group-hover:bg-red-600 transition-colors">
                                    <svg class="w-4 h-4 text-white ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col justify-center">
                            <h4 class="text-sm font-bold text-neutral-300 group-hover:text-white leading-snug line-clamp-3">Melihat Langsung Sentra Tenun Ikat di Desa Sasando</h4>
                            <span class="text-[10px] text-neutral-500 font-medium mt-1">1,2K Tayangan</span>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </section>

        <!-- 6. GALERI FOTO -->
        <section class="mb-16 px-4 sm:px-0">
            <div class="flex items-center gap-4 border-b-[3px] border-black dark:border-white pb-2 mb-6">
                <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <h2 class="text-2xl font-black text-neutral-900 dark:text-white uppercase tracking-tighter">Galeri</h2>
                
                <div class="ml-auto hidden sm:flex gap-2">
                    <button id="btn-prev-gallery" class="p-2 bg-neutral-100 dark:bg-[#1a1a1a] hover:bg-red-600 hover:text-white text-neutral-600 dark:text-neutral-400 rounded-full transition-colors focus:outline-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                    <button id="btn-next-gallery" class="p-2 bg-neutral-100 dark:bg-[#1a1a1a] hover:bg-red-600 hover:text-white text-neutral-600 dark:text-neutral-400 rounded-full transition-colors focus:outline-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>
            </div>

            <div id="gallery-container" class="flex overflow-x-auto snap-x snap-mandatory gap-4 pb-4 hide-scroll scroll-smooth">
                @php
                    $dummyGallery = [
                        ['img' => '1518002171953-a080ee817e1f', 'title' => 'Keindahan Alam Pulau Komodo yang Mendunia'],
                        ['img' => '1528164344705-47542687000d', 'title' => 'Festival Budaya Daerah Tampilkan Ratusan Penari Tradisional'],
                        ['img' => '1533669955142-6a73332af4db', 'title' => 'Potret Kehidupan Nelayan Tradisional di Pesisir Pantai'],
                        ['img' => '1493246507139-91e8fad9978e', 'title' => 'Kawasan Pegunungan yang Sejuk Menarik Minat Wisatawan'],
                        ['img' => '1465809873722-b4f71b3e4046', 'title' => 'Detail Arsitektur Rumah Adat yang Tetap Terjaga'],
                        ['img' => '1476514525535-07fb3b4ae5f1', 'title' => 'Keriuhan Pasar Tradisional di Pagi Hari'],
                    ];
                @endphp

                @foreach($dummyGallery as $foto)
                <div class="snap-start shrink-0 w-[85vw] sm:w-[45vw] md:w-[35vw] lg:w-[22vw] relative group cursor-pointer overflow-hidden rounded-xl bg-neutral-200 dark:bg-neutral-800 border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md transition-shadow">
                    <div class="aspect-[4/5] w-full">
                        <img src="https://images.unsplash.com/photo-{{ $foto['img'] }}?auto=format&fit=crop&w=600&q=80" alt="Gallery" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent opacity-80 group-hover:opacity-100 transition-opacity"></div>
                    <div class="absolute bottom-0 left-0 w-full p-5 flex flex-col justify-end">
                        <h3 class="text-white font-bold text-[14px] leading-[1.4] line-clamp-3">{{ $foto['title'] }}</h3>
                    </div>
                    <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity transform translate-y-2 group-hover:translate-y-0">
                        <div class="p-2 bg-red-600/90 backdrop-blur-sm rounded-full text-white shadow-lg">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l5-5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                            </svg>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- 7. INDEKS TERKINI (BERITA TERBARU GRID) -->
        <section id="indeks-terkini" class="px-4 sm:px-0">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 border-b-[3px] border-black dark:border-white pb-2 mb-8">
                <div class="flex items-center gap-4">
                    <h2 class="text-2xl sm:text-3xl font-black text-neutral-900 dark:text-white uppercase tracking-tighter">Berita Terbaru</h2>
                </div>
                <a href="{{ route('indeks') }}" class="text-neutral-900 dark:text-white hover:text-red-600 dark:hover:text-red-500 text-[11px] font-bold uppercase tracking-widest transition-colors flex items-center gap-1 group bg-neutral-100 dark:bg-[#1a1a1a] px-4 py-2 rounded-full border border-neutral-200 dark:border-neutral-800">
                    Indeks Lengkap <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-10">
                @forelse($latestPosts ?? [] as $index => $ep)
                    @if(!($headlines->isEmpty() && $index === 0))
                        <article class="group flex flex-col h-full">
                            <a href="{{ route('post.show', $ep->slug) }}" class="relative aspect-[4/3] overflow-hidden bg-neutral-100 dark:bg-neutral-900 block mb-4 border border-neutral-200 dark:border-neutral-800 rounded-xl">
                                <img src="{{ $ep->img ? asset('storage/' . $ep->img) : 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&w=600&q=80' }}" 
                                    alt="{{ $ep->title }}" 
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                                <div class="absolute top-2 left-2 bg-red-600 text-white text-[9px] font-bold px-2 py-1 uppercase tracking-widest shadow-md rounded-sm">
                                    {{ $ep->category->name ?? 'Update' }}
                                </div>
                            </a>
                            <div class="flex flex-col flex-grow">
                                <h3 class="text-[16px] font-extrabold text-neutral-900 dark:text-white leading-[1.3] mb-2 line-clamp-3 group-hover:text-red-600 transition-colors">
                                    <a href="{{ route('post.show', $ep->slug) }}">
                                        {{ $ep->title }}
                                    </a>
                                </h3>
                                <div class="mt-auto pt-2 flex items-center gap-2 text-[10px] text-neutral-500 dark:text-neutral-400 font-semibold uppercase tracking-wider border-t border-neutral-100 dark:border-neutral-800">
                                    <span>{{ $ep->published_at->format('d M, H:i') }}</span>
                                </div>
                            </div>
                        </article>
                    @endif
                @empty
                    @for ($i = 0; $i < 8; $i++)
                        <article class="group flex flex-col h-full animate-pulse">
                            <div class="aspect-[4/3] bg-neutral-200 dark:bg-neutral-800 mb-3 w-full rounded-xl"></div>
                            <div class="h-4 bg-neutral-200 dark:bg-neutral-800 w-1/4 mb-2"></div>
                            <div class="h-5 bg-neutral-200 dark:bg-neutral-800 w-full mb-1"></div>
                            <div class="h-5 bg-neutral-200 dark:bg-neutral-800 w-3/4"></div>
                        </article>
                    @endfor
                @endforelse
            </div>
        </section>

    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- Logika Navigasi Galeri Foto ---
            const gallery = document.getElementById('gallery-container');
            const btnPrev = document.getElementById('btn-prev-gallery');
            const btnNext = document.getElementById('btn-next-gallery');

            if(gallery && btnPrev && btnNext) {
                const scrollAmount = () => {
                    const firstItem = gallery.querySelector('.snap-start');
                    return firstItem ? firstItem.offsetWidth + 16 : 300;
                };

                btnNext.addEventListener('click', () => {
                    gallery.scrollBy({ left: scrollAmount(), behavior: 'smooth' });
                });

                btnPrev.addEventListener('click', () => {
                    gallery.scrollBy({ left: -scrollAmount(), behavior: 'smooth' });
                });
            }
        });
    </script>
    @endpush
</x-layouts.app>