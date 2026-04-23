<x-layouts.app :settings="$settings">
    {{-- Meta SEO dinamis --}}
    @slot('title', 'Beranda | ' . ($settings['site_name'] ?? 'Highlight NTT'))
    @slot('meta_description', $settings['site_description'] ?? 'Portal berita independen dari Nusa Tenggara Timur.')

    <style>
        .hide-scroll {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .hide-scroll::-webkit-scrollbar {
            display: none;
        }

        .editorial-number {
            -webkit-text-stroke: 1px rgba(220, 38, 38, 0.3);
            color: transparent;
        }

        .dark .editorial-number {
            -webkit-text-stroke: 1px rgba(239, 68, 68, 0.4);
        }

        .group:hover .editorial-number {
            color: rgba(220, 38, 38, 0.1);
        }

        [x-cloak] {
            display: none !important;
        }

        .swiper-pagination-bullet {
            background-color: #d4d4d4;
            opacity: 0.6;
            transition: all 0.3s ease;
        }

        .swiper-pagination-bullet-active {
            background-color: #dc2626;
            /* red-600 */
            opacity: 1;
            transform: scale(1.3);
        }

        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 18px !important;
            font-weight: bold;
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

        <!-- IKLAN POSISI: ATAS (HOME TOP) -->
        <x-ad-banner position="home_top" class="mb-8" />

        <div class="grid grid-cols-1 xl:grid-cols-12 gap-4 sm:gap-6 lg:gap-8 mb-12 items-start px-4 sm:px-0">

            <!-- BAGIAN KIRI: HEADLINE CAROUSEL (8 KOLOM) -->
            <div class="xl:col-span-8 group/headline">
                @if(isset($headlines) && $headlines->count() > 0)

                <!-- Swiper Container -->
                <div class="swiper headlineSwiper w-full h-[380px] md:h-[450px] lg:h-[500px] overflow-hidden relative pb-12">
                    <div class="swiper-wrapper">

                        @foreach($headlines->take(6) as $hl)
                        <div class="swiper-slide h-full relative group rounded-2xl overflow-hidden shadow-md border border-neutral-200 dark:border-neutral-800 bg-black">
                            <a href="{{ route('post.show', $hl->slug) }}" class="block w-full h-full relative">
                                <!-- Image -->
                                <img src="{{ $hl->img ? asset('storage/' . $hl->img) : 'https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&w=1200&q=80' }}"
                                    alt="{{ $hl->title }}"
                                    class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 ease-out">

                                <!-- Overlay Gradasi -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/40 to-transparent opacity-90 group-hover:opacity-100 transition-opacity duration-300"></div>

                                <!-- Konten Teks -->
                                <div class="absolute bottom-0 left-0 w-full p-5 md:p-6 z-10 flex flex-col justify-end">
                                    <div class="transform translate-y-2 group-hover:translate-y-0 transition-transform duration-500">
                                        <span class="inline-block px-2.5 py-1 mb-3 text-[10px] md:text-xs font-bold text-white bg-red-600 rounded uppercase tracking-wider shadow-md">
                                            {{ $hl->category->name ?? 'Nasional' }}
                                        </span>
                                        <h2 class="text-lg md:text-xl lg:text-2xl font-extrabold text-white leading-tight drop-shadow-md line-clamp-3 group-hover:text-red-200 transition-colors">
                                            {{ $hl->title }}
                                        </h2>
                                        <div class="mt-3 flex items-center text-neutral-300 text-[10px] md:text-xs gap-3">
                                            <span class="flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                {{ $hl->created_at ? $hl->created_at->diffForHumans() : 'Baru saja' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach

                    </div>

                    <!-- Tombol Navigasi Kiri & Kanan (Muncul saat Hover di Desktop) -->
                    <div class="swiper-button-next hidden md:flex opacity-0 group-hover/headline:opacity-100 !text-white bg-black/50 hover:bg-red-600 w-10 h-10 rounded-full backdrop-blur-sm transition-all shadow-lg !right-2"></div>
                    <div class="swiper-button-prev hidden md:flex opacity-0 group-hover/headline:opacity-100 !text-white bg-black/50 hover:bg-red-600 w-10 h-10 rounded-full backdrop-blur-sm transition-all shadow-lg !left-2"></div>

                    <!-- Indikator Titik (Pagination) -->
                    <div class="swiper-pagination !bottom-2 "></div>
                </div>

                <!-- Inisialisasi Swiper -->
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        new Swiper('.headlineSwiper', {
                            slidesPerView: 1.15,
                            /* Mobile: 1 slide + sedikit intipan berita selanjutnya */
                            centeredSlides: false,
                            spaceBetween: 12,
                            loop: true,
                            grabCursor: true,
                            autoplay: {
                                delay: 4500,
                                /* Auto scroll setiap 4.5 detik */
                                disableOnInteraction: false,
                                /* Tetap auto scroll meski user pernah nge-klik */
                                pauseOnMouseEnter: true /* Berhenti otomatis saat cursor berada di atas berita */
                            },
                            pagination: {
                                el: '.swiper-pagination',
                                clickable: true,
                                dynamicBullets: true,
                            },
                            navigation: {
                                nextEl: '.swiper-button-next',
                                prevEl: '.swiper-button-prev',
                            },
                            breakpoints: {
                                640: {
                                    slidesPerView: 2,
                                    spaceBetween: 16,
                                },
                                1024: {
                                    slidesPerView: 2,
                                    /* Desktop menampilkan 2 berita utama berdampingan */
                                    spaceBetween: 20,
                                }
                            }
                        });
                    });
                </script>

                @else
                <!-- Empty State -->
                <div class="h-[400px] rounded-2xl bg-neutral-50 dark:bg-neutral-900 flex flex-col items-center justify-center border-2 border-dashed border-neutral-200 dark:border-neutral-800">
                    <div class="p-4 bg-neutral-200 dark:bg-neutral-800 rounded-full mb-4">
                        <svg class="w-8 h-8 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <p class="text-neutral-500 font-bold uppercase tracking-widest text-xs">Belum ada konten utama</p>
                </div>
                @endif
            </div>

            <!-- BAGIAN KANAN: TERPOPULER (4 KOLOM) -->
            <div class="xl:col-span-4 space-y-6">
                <h3 class="text-xl font-black uppercase tracking-tighter border-l-4 border-amber-500 pl-4 mb-6">Terpopuler</h3>
                <div class="flex flex-col flex-1 justify-between gap-1">
                    @forelse($trendingNews ?? [] as $index => $news)
                    <a href="{{ route('post.show', $news->slug) }}" class="group relative flex items-center py-3 border-b border-neutral-200 dark:border-neutral-800 last:border-0 hover:bg-white dark:hover:bg-[#1a1a1a] transition-all -mx-2 px-2 rounded-lg z-10 overflow-hidden">
                        <span class="editorial-number absolute -left-2 top-1/2 -translate-y-1/2 text-[80px] font-black italic leading-none z-[-1] transition-colors duration-500 pointer-events-none select-none opacity-20 dark:opacity-10 text-neutral-300 dark:text-neutral-700">
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
    </div>

    <x-ad-banner position="home_middle" />

    <!-- 4. FOKUS KATEGORI DINAMIS -->
    @if(isset($focusPosts) && $focusPosts->count() > 0)
    <section class="mb-16 px-4 sm:px-0">
        <div class="flex items-center gap-4 border-b-[3px] border-black dark:border-white pb-2 mb-6">
            <div class="w-4 h-4 bg-red-600"></div>
            <h2 class="text-2xl font-black text-neutral-900 dark:text-white uppercase tracking-tighter">
                {{ $focusCategory->name ?? 'Fokus Utama' }}
            </h2>
            <a href="{{ isset($focusCategory) ? route('category.show', $focusCategory->slug) : '#' }}" class="ml-auto text-[10px] sm:text-xs font-bold uppercase tracking-widest text-neutral-500 hover:text-red-600 transition-colors">Lihat Semua &rarr;</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 lg:gap-8">
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

            <div class="md:col-span-5 flex flex-col gap-5">
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

    <!-- 5. MULTIMEDIA / GALERI VIDEO (DINAMIS) -->
    @if(isset($videoPosts) && $videoPosts->count() > 0)
    <section class="mb-16 -mx-4 sm:mx-0 px-4 py-12 sm:p-12 bg-neutral-900 dark:bg-[#0a0a0a] sm:rounded-3xl relative overflow-hidden shadow-2xl border border-neutral-800">
        <div class="absolute top-0 right-0 w-96 h-96 bg-red-600/10 blur-[120px] rounded-full pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-blue-600/5 blur-[100px] rounded-full pointer-events-none"></div>

        <div class="flex items-center gap-4 border-b-[3px] border-neutral-700 pb-3 mb-8 relative z-10">
            <div class="w-4 h-4 bg-red-600 rounded-full animate-pulse shadow-[0_0_10px_rgba(220,38,38,0.8)]"></div>
            <h2 class="text-2xl sm:text-3xl font-black text-white uppercase tracking-tighter">Highlight Video</h2>
            <a href="{{ route('videos.index') }}" class="ml-auto text-[10px] sm:text-xs font-bold uppercase tracking-widest text-neutral-400 hover:text-red-500 transition-colors">Lihat Semua &rarr;</a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 relative z-10">
            @php $mainVideo = $videoPosts->first(); @endphp
            <div class="lg:col-span-2">
                <a href="{{ route('post.show', $mainVideo->slug) }}" class="group relative block overflow-hidden rounded-2xl border border-neutral-800 bg-black aspect-video shadow-2xl">
                    <img src="{{ $mainVideo->img ? asset('storage/' . $mainVideo->img) : 'https://images.unsplash.com/photo-1517554558209-4081c7f8a70c?q=80&w=1200' }}"
                        alt="{{ $mainVideo->title }}"
                        class="w-full h-full object-cover opacity-70 group-hover:scale-105 group-hover:opacity-90 transition-all duration-700">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-20 h-20 bg-red-600/90 rounded-full flex items-center justify-center backdrop-blur-sm group-hover:bg-red-500 group-hover:scale-110 transition-all shadow-xl shadow-red-600/30">
                            <svg class="w-10 h-10 text-white ml-1.5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                        </div>
                    </div>
                    <div class="absolute bottom-0 left-0 w-full p-6 sm:p-10 bg-gradient-to-t from-black via-black/40 to-transparent">
                        <span class="bg-red-600 text-white text-[10px] font-black px-3 py-1 uppercase tracking-widest w-max mb-3 block rounded-sm shadow-lg">Eksklusif</span>
                        <h3 class="text-2xl sm:text-3xl font-black text-white leading-tight group-hover:text-red-400 transition-colors line-clamp-2">
                            {{ $mainVideo->title }}
                        </h3>
                    </div>
                </a>
            </div>
            <div class="flex flex-col gap-5">
                @foreach($videoPosts->skip(1)->take(3) as $video)
                <a href="{{ route('post.show', $video->slug) }}" class="group flex gap-4 items-center p-3 rounded-2xl hover:bg-white/5 transition-all border border-transparent hover:border-neutral-800">
                    <div class="w-32 sm:w-40 aspect-video shrink-0 relative overflow-hidden bg-black rounded-xl border border-neutral-800">
                        <img src="{{ $video->img ? asset('storage/' . $video->img) : 'https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?q=80&w=400' }}" class="w-full h-full object-cover opacity-60 group-hover:opacity-100 transition-opacity">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform">
                                <svg class="w-4 h-4 text-white ml-0.5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z" />
                                </svg>
                            </div>
                        </div>
                        @if($video->duration)
                        <div class="absolute bottom-1 right-1 bg-black/80 text-white text-[9px] font-bold px-1.5 py-0.5 rounded-md">
                            {{ $video->duration }}
                        </div>
                        @endif
                    </div>
                    <div class="flex flex-col">
                        <h4 class="text-sm font-bold text-neutral-200 group-hover:text-white leading-snug line-clamp-2 transition-colors">{{ $video->title }}</h4>
                        <span class="text-[10px] text-neutral-500 font-medium mt-2 uppercase tracking-wider">
                            {{ number_format($video->views ?? 0, 0, ',', '.') }} Tayangan
                        </span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @if(isset($galleries) && $galleries->count() > 0)
    <!-- 6. GALERI FOTO (DINAMIS DENGAN LIGHTBOX) -->
    <section x-data="galleryLightbox()" class="mb-16 px-4 sm:px-0">
        <div class="flex items-center gap-4 border-b-[3px] border-black dark:border-white pb-3 mb-6">
            <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <h2 class="text-2xl sm:text-3xl font-black text-neutral-900 dark:text-white uppercase tracking-tighter">Lensa Flobamorata</h2>
            <div class="ml-auto hidden sm:flex items-center gap-4">
                <a href="{{ route('gallery.index') }}" class="text-[10px] sm:text-xs font-bold uppercase tracking-widest text-neutral-500 hover:text-red-600 transition-colors mr-2">Semua Galeri &rarr;</a>
                <div class="flex gap-2">
                    <button @click="scrollPrev()" class="p-2.5 bg-neutral-100 dark:bg-[#1a1a1a] hover:bg-red-600 hover:text-white text-neutral-600 dark:text-neutral-400 rounded-full transition-all shadow-sm active:scale-90">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <button @click="scrollNext()" class="p-2.5 bg-neutral-100 dark:bg-[#1a1a1a] hover:bg-red-600 hover:text-white text-neutral-600 dark:text-neutral-400 rounded-full transition-all shadow-sm active:scale-90">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div id="gallery-container" class="flex overflow-x-auto snap-x snap-mandatory gap-4 pb-6 hide-scroll scroll-smooth">
            @forelse($galleries as $gallery)
            <div @click="openModal({{ json_encode($gallery) }}, {{ $gallery->images->map(fn($img) => ['path' => asset('storage/' . $img->image_path), 'caption' => $img->caption]) }})"
                class="snap-start shrink-0 w-[85vw] sm:w-[45vw] md:w-[35vw] lg:w-[22vw] relative group cursor-pointer overflow-hidden rounded-2xl bg-neutral-100 dark:bg-neutral-800 border border-neutral-200 dark:border-neutral-800 shadow-md hover:shadow-2xl transition-all duration-500">
                <div class="aspect-[4/5] w-full">
                    <img src="{{ $gallery->cover_image ? asset('storage/' . $gallery->cover_image) : 'https://images.unsplash.com/photo-1518002171953-a080ee817e1f?auto=format&fit=crop&w=600' }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent opacity-80 group-hover:opacity-100 transition-opacity"></div>
                <div class="absolute bottom-0 left-0 w-full p-5 flex flex-col justify-end">
                    <div class="flex items-center gap-1.5 bg-red-600 text-white text-[9px] font-black px-2.5 py-1 rounded-sm uppercase tracking-widest w-max mb-3 shadow-xl">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ $gallery->images_count ?? 0 }} Foto
                    </div>
                    <h3 class="text-white font-bold text-[16px] leading-[1.4] line-clamp-3 group-hover:text-red-400 transition-colors drop-shadow-md">{{ $gallery->title }}</h3>
                </div>
            </div>
            @empty
            <div class="w-full py-16 text-center text-neutral-400 font-bold uppercase tracking-widest text-xs border-2 border-dashed border-neutral-200 dark:border-neutral-800 rounded-2xl">Belum ada galeri foto terbaru</div>
            @endforelse
        </div>

        <template x-teleport="body">
            <div x-show="isOpen" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/98 backdrop-blur-2xl p-4 sm:p-10" x-cloak @keydown.escape.window="closeModal()" @keydown.right.window="nextImage()" @keydown.left.window="prevImage()">
                <button @click="closeModal()" class="absolute top-6 right-6 z-[110] text-white/50 hover:text-white p-3 bg-white/5 hover:bg-red-600 rounded-full"><svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg></button>
                <button @click="prevImage()" class="hidden sm:flex absolute left-8 z-[110] p-5 text-white/40 hover:text-white"><svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path d="M15 19l-7-7 7-7" />
                    </svg></button>
                <button @click="nextImage()" class="hidden sm:flex absolute right-8 z-[110] p-5 text-white/40 hover:text-white"><svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path d="M9 5l7 7-7 7" />
                    </svg></button>
                <div class="w-full max-w-6xl h-full flex flex-col justify-center items-center">
                    <div class="relative w-full h-[55vh] sm:h-[70vh] flex items-center justify-center">
                        <template x-for="(img, index) in activeImages" :key="index">
                            <div x-show="currentIndex === index" class="absolute inset-0 flex items-center justify-center"><img :src="img.path" class="max-w-full max-h-full object-contain rounded-lg shadow-2xl"></div>
                        </template>
                    </div>
                    <div class="mt-8 text-center max-w-3xl">
                        <div class="text-red-500 font-black text-xs uppercase tracking-[0.4em] mb-3" x-text="'Foto ' + (currentIndex + 1) + ' / ' + activeImages.length"></div>
                        <h3 class="text-white text-xl sm:text-3xl font-black mb-4" x-text="activeGallery?.title"></h3>
                        <p class="text-neutral-400 text-sm sm:text-base leading-relaxed italic" x-text="activeImages[currentIndex]?.caption || 'Lensa Flobamora - Mengabadikan momen terbaik NTT.'"></p>
                    </div>
                </div>
            </div>
        </template>
    </section>
    @endif



    <!-- 7. INDEKS TERKINI (BERITA TERBARU GRID) -->
    <section id="indeks-terkini" class="px-4 sm:px-0">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 border-b-[3px] border-black dark:border-white pb-2 mb-8">
            <h2 class="text-2xl sm:text-3xl font-black text-neutral-900 dark:text-white uppercase tracking-tighter">Berita Terbaru</h2>
            <a href="{{ route('indeks') }}" class="text-neutral-900 dark:text-white hover:text-red-600 dark:hover:text-red-500 text-[11px] font-bold uppercase tracking-widest transition-colors flex items-center gap-1 group bg-neutral-100 dark:bg-[#1a1a1a] px-4 py-2 rounded-full border border-neutral-200 dark:border-neutral-800">
                Indeks Lengkap <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-10">
            @forelse($latestPosts ?? [] as $index => $ep)
            <article class="group flex flex-col h-full">
                <a href="{{ route('post.show', $ep->slug) }}" class="relative aspect-[4/3] overflow-hidden bg-neutral-100 dark:bg-neutral-900 block mb-4 border border-neutral-200 dark:border-neutral-800 rounded-xl">
                    <img src="{{ $ep->img ? asset('storage/' . $ep->img) : 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&w=600&q=80' }}" alt="{{ $ep->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                    <div class="absolute top-2 left-2 bg-red-600 text-white text-[9px] font-bold px-2 py-1 uppercase tracking-widest shadow-md rounded-sm">{{ $ep->category->name ?? 'Update' }}</div>
                </a>
                <div class="flex flex-col flex-grow">
                    <h3 class="text-[16px] font-extrabold text-neutral-900 dark:text-white leading-[1.3] mb-2 line-clamp-3 group-hover:text-red-600 transition-colors"><a href="{{ route('post.show', $ep->slug) }}">{{ $ep->title }}</a></h3>
                    <div class="mt-auto pt-2 flex items-center gap-2 text-[10px] text-neutral-500 dark:text-neutral-400 font-semibold uppercase tracking-wider border-t border-neutral-100 dark:border-neutral-800"><span>{{ $ep->published_at->format('d M, H:i') }}</span></div>
                </div>
            </article>
            @empty
            @for ($i = 0; $i < 8; $i++)
                <article class="group flex flex-col h-full animate-pulse">
                <div class="aspect-[4/3] bg-neutral-200 dark:bg-neutral-800 mb-3 w-full rounded-xl"></div>
                <div class="h-4 bg-neutral-200 dark:bg-neutral-800 w-1/4 mb-2"></div>
                </article>
                @endfor
                @endforelse
        </div>
    </section>
    </div>

    @push('scripts')
    <script>
        function galleryLightbox() {
            return {
                isOpen: false,
                activeGallery: null,
                activeImages: [],
                currentIndex: 0,
                openModal(gallery, images) {
                    this.activeGallery = gallery;
                    this.activeImages = images;
                    this.currentIndex = 0;
                    this.isOpen = true;
                    document.body.classList.add('overflow-hidden');
                },
                closeModal() {
                    this.isOpen = false;
                    document.body.classList.remove('overflow-hidden');
                },
                nextImage() {
                    this.currentIndex = (this.currentIndex + 1) % this.activeImages.length;
                },
                prevImage() {
                    this.currentIndex = (this.currentIndex - 1 + this.activeImages.length) % this.activeImages.length;
                },
                scrollNext() {
                    document.getElementById('gallery-container').scrollBy({
                        left: 400,
                        behavior: 'smooth'
                    });
                },
                scrollPrev() {
                    document.getElementById('gallery-container').scrollBy({
                        left: -400,
                        behavior: 'smooth'
                    });
                }
            }
        }
    </script>
    @endpush
</x-layouts.app>