<x-layouts.app :settings="$settings">
{{-- Meta SEO dinamis --}}
@slot('title', 'Beranda | ' . ($settings['site_name'] ?? 'Highlight NTT'))
@slot('meta_description', $settings['site_description'] ?? 'Portal berita independen dari Nusa Tenggara Timur.')

<div class="max-w-[1280px] mx-auto px-0 sm:px-4 lg:px-8 pt-0 sm:pt-6 pb-24">

    <!-- KILAS BERITA (TICKER) - Editorial Style -->
    @if(isset($breakingNews) && $breakingNews->count() > 0)
    <div class="flex items-center bg-white dark:bg-[#121212] border-y sm:border border-neutral-200 dark:border-neutral-800 mb-8 sm:mb-10">
        <div class="bg-red-600 text-white px-4 sm:px-5 py-2 text-[10px] sm:text-[11px] font-black uppercase tracking-widest shrink-0 flex items-center gap-2 relative z-10">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
            </span>
            Kilas Berita
        </div>
        <div class="overflow-hidden w-full px-4 relative flex items-center bg-neutral-50 dark:bg-[#1a1a1a] h-full py-2">
            <marquee class="text-[12px] sm:text-[13px] font-semibold text-neutral-800 dark:text-neutral-200 flex items-center h-full" scrollamount="4" onmouseover="this.stop();" onmouseout="this.start();">
                @foreach($breakingNews as $item)
                    <a href="{{ route('episode.show', $item->slug) }}" class="hover:text-red-600 transition-colors mx-4">{{ $item->title }}</a>
                    @if(!$loop->last) <span class="text-neutral-300 dark:text-neutral-700 mx-2">|</span> @endif
                @endforeach
            </marquee>
        </div>
    </div>
    @endif

    <!-- HERO SECTION: HEADLINE & TERPOPULER -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-0 sm:gap-8 lg:gap-10 mb-16 items-start">
        
        <!-- Berita Utama (Headline Slider) -->
        <div class="lg:col-span-8 group/headline">
            
            <!-- Frame Headline: Edge-to-edge di HP, menyudut tajam di Laptop -->
            <div class="relative aspect-[4/3] sm:aspect-[16/9] overflow-hidden bg-neutral-900 border-y sm:border border-neutral-200 dark:border-neutral-800">
                @if(isset($headlines) && $headlines->count() > 0)
                    <div id="headline-slider" class="h-full w-full relative">
                        @foreach($headlines as $index => $hl)
                            <div class="headline-slide h-full w-full absolute inset-0 transition-opacity duration-700 ease-in-out {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}" data-index="{{ $index }}">
                                <a href="{{ route('episode.show', $hl->slug) }}" class="block w-full h-full relative group/item">
                                    <!-- Gambar dengan efek zoom halus -->
                                    <img src="{{ $hl->img ? asset('storage/' . $hl->img) : 'https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&w=1200&q=80' }}" 
                                         alt="{{ $hl->title }}" 
                                         class="w-full h-full object-cover transform group-hover/item:scale-105 transition-transform duration-[5s] ease-out">
                                    
                                    <!-- Overlay Gradien Lembut (Makin gelap ke bawah) -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/40 to-transparent to-60%"></div>
                                    
                                    <!-- Konten Headline -->
                                    <div class="absolute bottom-0 left-0 w-full p-5 sm:p-8 z-10 flex flex-col justify-end h-full">
                                        <div class="flex flex-wrap items-center gap-2 mb-3 transform translate-y-2 group-hover/item:translate-y-0 transition-transform duration-300">
                                            <span class="bg-red-600 text-white text-[10px] sm:text-[11px] font-bold px-2 py-0.5 uppercase tracking-widest">
                                                {{ $hl->category->name ?? 'Sorotan Utama' }}
                                            </span>
                                            <span class="text-neutral-300 text-[10px] sm:text-[11px] font-medium uppercase tracking-widest">
                                                {{ $hl->published_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        
                                        <h3 class="text-2xl sm:text-3xl lg:text-[40px] font-extrabold text-white leading-[1.2] mb-4 sm:mb-8 max-w-3xl drop-shadow-md group-hover/item:text-red-400 transition-colors duration-300">
                                            {{ $hl->title }}
                                        </h3>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                        
                        <!-- Slider Dots - Editorial Minimalist -->
                        <div class="absolute bottom-4 right-4 sm:bottom-6 sm:right-6 flex gap-2 z-20">
                            @foreach($headlines as $index => $hl)
                                <button class="slider-dot w-8 h-1 rounded-sm transition-all duration-300 {{ $index === 0 ? 'bg-red-600' : 'bg-white/40 hover:bg-white/80' }}" data-index="{{ $index }}"></button>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Terpopuler (Sidebar) -->
        <div class="lg:col-span-4 px-4 sm:px-0 mt-8 lg:mt-0">
            <!-- Judul Seksi -->
            <div class="flex items-center justify-between border-b-2 border-black dark:border-white pb-3 mb-5">
                <h2 class="text-xl font-black text-neutral-900 dark:text-white uppercase tracking-tight">Terpopuler</h2>
            </div>

            <!-- List Terpopuler dengan Nomor Editorial -->
            <div class="flex flex-col">
                @forelse($trendingNews as $index => $news)
                <a href="{{ route('episode.show', $news->slug) }}" class="group flex items-start gap-4 py-4 border-b border-neutral-200 dark:border-neutral-800 last:border-0 hover:bg-neutral-50 dark:hover:bg-[#1a1a1a] transition-colors -mx-4 px-4 sm:mx-0 sm:px-2 rounded-sm">
                    <!-- Angka Klasik Besar -->
                    <span class="text-4xl font-black text-neutral-200 dark:text-neutral-800 leading-none w-8 text-center shrink-0 group-hover:text-red-600 transition-colors italic">
                        {{ $index + 1 }}
                    </span>
                    <div class="flex flex-col">
                        <span class="text-[10px] font-bold text-red-600 uppercase tracking-widest mb-1.5">{{ $news->category->name ?? 'Populer' }}</span>
                        <!-- Efek Underline Jurnalistik saat hover -->
                        <h3 class="text-[15px] sm:text-base font-bold text-neutral-900 dark:text-neutral-100 leading-[1.4] line-clamp-3 group-hover:underline decoration-red-600 decoration-2 underline-offset-4">
                            {{ $news->title }}
                        </h3>
                    </div>
                </a>
                @empty
                <div class="py-10 text-center border-b border-neutral-200 dark:border-neutral-800">
                    <p class="text-xs text-neutral-400 font-bold uppercase tracking-widest">Belum Ada Data</p>
                </div>
                @endforelse
            </div>

            <!-- Box Iklan/Promo (Clean Look) -->
            <div class="mt-8 bg-[#0f2440] dark:bg-[#111] border border-[#1a365d] dark:border-neutral-800 p-6 relative group flex flex-col items-center text-center">
                <h4 class="text-white font-black text-sm uppercase tracking-widest mb-2">Visual Eksklusif</h4>
                <p class="text-neutral-300 text-xs mb-5 leading-relaxed font-medium">Saksikan tayangan liputan mendalam melalui kanal YouTube resmi kami.</p>
                <a href="{{ $settings['youtube_url'] ?? '#' }}" target="_blank" class="w-full inline-flex items-center justify-center py-2.5 border-2 border-red-600 text-white text-[11px] font-bold uppercase tracking-widest hover:bg-red-600 transition-colors">
                    Tonton Video
                </a>
            </div>
        </div>
    </div>

    <!-- INDEKS TERKINI (Berita Terbaru - Layout Grid Profesional) -->
    <section id="indeks-terkini" class="px-4 sm:px-0">
        <!-- Header Seksi Klasik -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 border-b-2 border-black dark:border-white pb-3 mb-8">
            <div class="flex flex-col gap-1">
                <h2 class="text-2xl sm:text-3xl font-black text-neutral-900 dark:text-white uppercase tracking-tighter">Berita Terbaru</h2>
                <p class="text-xs text-neutral-500 font-medium uppercase tracking-widest">Laporan Terkini Seputar NTT</p>
            </div>
            <a href="#" class="text-neutral-900 dark:text-white hover:text-red-600 dark:hover:text-red-500 text-[11px] font-bold uppercase tracking-widest transition-colors flex items-center gap-1 group">
                Lihat Indeks Lengkap <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>

        <!-- Grid 3 Kolom untuk keterbacaan yang optimal -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12">
            @forelse($latestPosts as $index => $ep)
                @if(!( !isset($headlines) || $headlines->count() == 0 ) || $index > 0)
                    <article class="group flex flex-col h-full">
                        <!-- Area Gambar Edge-to-Edge pada kolom -->
                        <a href="{{ route('episode.show', $ep->slug) }}" class="relative aspect-[3/2] overflow-hidden bg-neutral-100 dark:bg-neutral-900 block mb-4 border border-neutral-200 dark:border-neutral-800">
                            <img src="{{ $ep->img ? asset('storage/' . $ep->img) : 'https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&w=800&q=80' }}" 
                                alt="{{ $ep->title }}" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                            
                            <!-- Label Kategori menempel di bawah gambar -->
                            <div class="absolute bottom-0 left-0 bg-red-600 text-white text-[10px] font-bold px-2 py-1 uppercase tracking-widest">
                                {{ $ep->category->name ?? 'Update' }}
                            </div>
                        </a>
                        
                        <div class="flex flex-col flex-grow">
                            <!-- Meta Info -->
                            <div class="flex items-center gap-2 mb-2 text-[10px] text-neutral-500 dark:text-neutral-400 font-semibold uppercase tracking-wider">
                                <span>{{ $ep->author->name ?? 'Redaksi' }}</span>
                                <span>•</span>
                                <span>{{ $ep->published_at->format('d M Y') }}</span>
                            </div>
                            
                            <!-- Judul Profesional -->
                            <h3 class="text-[17px] sm:text-[19px] font-extrabold text-neutral-900 dark:text-white leading-[1.35] mb-2 line-clamp-3 group-hover:text-red-600 transition-colors">
                                <a href="{{ route('episode.show', $ep->slug) }}">
                                    {{ $ep->title }}
                                </a>
                            </h3>
                            
                            <!-- Deskripsi Pendek -->
                            <p class="text-neutral-600 dark:text-neutral-400 text-sm line-clamp-2 leading-relaxed">
                                {{ Str::limit(strip_tags($ep->content), 120) }}
                            </p>
                        </div>
                    </article>
                @endif
            @empty
                <div class="col-span-full py-16 text-center border-y border-neutral-200 dark:border-neutral-800">
                    <p class="text-neutral-400 font-bold uppercase tracking-widest text-xs mb-2">Informasi Belum Tersedia</p>
                    <p class="text-neutral-500 text-sm">Redaksi kami sedang menyiapkan konten terbaik untuk Anda.</p>
                </div>
            @endforelse
        </div>
    </section>

</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.headline-slide');
        const dots = document.querySelectorAll('.slider-dot');
        
        if (slides.length <= 1) return;

        let currentSlide = 0;
        const slideInterval = 6000;

        function showSlide(n) {
            slides.forEach((s, idx) => {
                if(idx === n) {
                    s.classList.replace('opacity-0', 'opacity-100');
                    s.style.zIndex = "10";
                } else {
                    s.classList.replace('opacity-100', 'opacity-0');
                    s.style.zIndex = "0";
                }
            });

            dots.forEach((d, idx) => {
                if(idx === n) {
                    d.classList.replace('bg-transparent', 'bg-red-600');
                    d.classList.replace('border-white/50', 'border-red-600');
                    d.classList.replace('bg-white/40', 'bg-red-600');
                } else {
                    d.classList.replace('bg-red-600', 'bg-white/40');
                    d.classList.replace('border-red-600', 'border-white/50');
                }
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        let timer = setInterval(nextSlide, slideInterval);

        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                clearInterval(timer);
                currentSlide = index;
                showSlide(currentSlide);
                timer = setInterval(nextSlide, slideInterval);
            });
        });
    });
</script>
@endpush

</x-layouts.app>