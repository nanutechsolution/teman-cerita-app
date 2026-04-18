<x-layouts.app :settings="$settings">
{{-- Meta SEO dinamis --}}
@slot('title', 'Beranda | ' . ($settings['site_name'] ?? 'Highlight NTT'))
@slot('meta_description', $settings['site_description'] ?? 'Portal berita independen dari Nusa Tenggara Timur.')

<div class="max-w-[1400px] mx-auto px-0 sm:px-4 lg:px-8 pt-0 sm:pt-6 pb-24">

    <!-- KILAS BERITA (TICKER) - Editorial Style -->
    @if(isset($breakingNews) && $breakingNews->count() > 0)
    <div class="flex items-center bg-white dark:bg-[#121212] border-y sm:border border-neutral-200 dark:border-neutral-800 sm:rounded-sm overflow-hidden mb-8 sm:mb-12">
        <div class="bg-red-600 text-white px-4 sm:px-5 py-2.5 text-[10px] sm:text-xs font-black uppercase tracking-[0.2em] shrink-0 flex items-center gap-2.5 relative z-10">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
            </span>
            Kilas Berita
        </div>
        <div class="overflow-hidden w-full px-4 relative flex items-center bg-neutral-50 dark:bg-[#1a1a1a] h-full py-2.5">
            <marquee class="text-[11px] sm:text-xs font-bold text-neutral-800 dark:text-neutral-200 uppercase tracking-wide flex items-center h-full" scrollamount="4" onmouseover="this.stop();" onmouseout="this.start();">
                @foreach($breakingNews as $item)
                    <a href="{{ route('episode.show', $item->slug) }}" class="hover:text-red-600 transition-colors mx-4">{{ $item->title }}</a>
                    @if(!$loop->last) <span class="text-neutral-300 dark:text-neutral-600 mx-2">/</span> @endif
                @endforeach
            </marquee>
        </div>
    </div>
    @endif

    <!-- HERO SECTION: HEADLINE & TRENDING -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-0 sm:gap-8 lg:gap-10 mb-16 items-start">
        
        <!-- Berita Utama (Headline) -->
        <div class="lg:col-span-8 group/headline px-4 sm:px-0">
            <div class="flex items-center gap-3 mb-4 sm:mb-5">
                <div class="h-5 w-1 bg-red-600"></div>
                <h2 class="text-xl sm:text-2xl font-black text-neutral-900 dark:text-white uppercase tracking-tight">
                    {{ (isset($headlines) && $headlines->count() > 0) ? 'Sorotan Utama' : 'Berita Terbaru' }}
                </h2>
            </div>

            <!-- Frame Headline: Ujung tajam/sedikit melengkung -->
            <div class="relative aspect-[4/3] sm:aspect-[16/9] sm:rounded-md overflow-hidden bg-neutral-200 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800">
                @if(isset($headlines) && $headlines->count() > 0)
                    <div id="headline-slider" class="h-full w-full relative">
                        @foreach($headlines as $index => $hl)
                            <div class="headline-slide h-full w-full absolute inset-0 transition-all duration-1000 ease-in-out {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}" data-index="{{ $index }}">
                                <a href="{{ route('episode.show', $hl->slug) }}" class="block w-full h-full relative group/item">
                                    <!-- Gambar -->
                                    <img src="{{ $hl->img ? asset('storage/' . $hl->img) : 'https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&w=1200&q=80' }}" 
                                         alt="{{ $hl->title }}" 
                                         class="w-full h-full object-cover transform group-hover/item:scale-105 transition-transform duration-[4s] ease-out">
                                    
                                    <!-- Overlay Gradien: to-50% agar gambar atas jernih -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/60 to-transparent to-50% transition-opacity duration-300"></div>
                                    
                                    <!-- Konten Headline -->
                                    <div class="absolute bottom-0 left-0 w-full p-5 sm:p-8 md:p-10 z-10">
                                        <div class="flex flex-wrap items-center gap-2 mb-3">
                                            <span class="bg-red-600 text-white text-[10px] sm:text-xs font-bold px-2 py-0.5 uppercase tracking-wider">
                                                {{ $hl->category->name ?? 'Fokus' }}
                                            </span>
                                            <span class="text-neutral-200 text-[10px] sm:text-xs font-medium px-2 py-0.5 bg-black/40 backdrop-blur-sm uppercase tracking-widest border border-white/10">
                                                {{ $hl->published_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        
                                        <h3 class="text-2xl sm:text-3xl md:text-4xl lg:text-[40px] font-black text-white leading-[1.15] mb-4 sm:mb-6 max-w-4xl drop-shadow-lg group-hover/item:text-red-400 transition-colors duration-300">
                                            {{ $hl->title }}
                                        </h3>
                                        
                                        <div class="flex items-center gap-3">
                                            <div class="h-8 w-8 sm:h-10 sm:w-10 border border-neutral-500 shrink-0">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($hl->author->name ?? 'A') }}&background=random" class="w-full h-full object-cover grayscale opacity-90">
                                            </div>
                                            <div class="text-white">
                                                <p class="text-[9px] sm:text-[10px] text-neutral-400 uppercase tracking-widest font-bold">Laporan Oleh</p>
                                                <p class="text-xs sm:text-sm font-bold tracking-wide">{{ $hl->author->name ?? 'Redaksi' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                        
                        <!-- Slider Dots - Style Kotak Editorial -->
                        <div class="absolute bottom-5 right-5 sm:bottom-8 sm:right-8 flex gap-1.5 z-20">
                            @foreach($headlines as $index => $hl)
                                <button class="slider-dot h-1.5 transition-all duration-300 {{ $index === 0 ? 'bg-red-600 border-red-600 w-10' : 'bg-transparent border-white/50 w-3' }} border" data-index="{{ $index }}"></button>
                            @endforeach
                        </div>
                    </div>
                @else
                    <!-- Desain Fallback (Jika Headline Kosong) -->
                    @if(isset($latestEpisodes) && $latestEpisodes->count() > 0)
                        @php $fallbackHl = $latestEpisodes->first(); @endphp
                        <div class="h-full w-full relative">
                            <a href="{{ route('episode.show', $fallbackHl->slug) }}" class="block w-full h-full relative group">
                                <img src="{{ $fallbackHl->img ? asset('storage/' . $fallbackHl->img) : 'https://images.unsplash.com/photo-1504711432869-5d590129a394?auto=format&fit=crop&w=1200&q=80' }}" 
                                    alt="{{ $fallbackHl->title }}" 
                                    class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-[3s]">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent"></div>
                                <div class="absolute bottom-0 left-0 p-8">
                                    <span class="bg-red-600 text-white font-bold text-[10px] px-2 py-0.5 uppercase tracking-widest mb-3 inline-block">Warta Terbaru</span>
                                    <h3 class="text-2xl sm:text-4xl font-black text-white leading-tight max-w-2xl">{{ $fallbackHl->title }}</h3>
                                </div>
                            </a>
                        </div>
                    @endif
                @endif
            </div>
        </div>

        <!-- Trending Sidebar (Hits) -->
        <div class="lg:col-span-4 px-4 sm:px-0 mt-8 lg:mt-0">
            <div class="flex items-center justify-between border-b-2 border-neutral-900 dark:border-neutral-100 mb-5 pb-2">
                <h2 class="text-lg sm:text-xl font-black text-neutral-900 dark:text-white uppercase tracking-tight">Terpopuler</h2>
                <span class="text-[10px] font-bold text-neutral-500 uppercase tracking-widest">Minggu Ini</span>
            </div>

            <div class="flex flex-col">
                @forelse($trendingNews as $index => $news)
                <a href="{{ route('episode.show', $news->slug) }}" class="group flex items-start gap-4 py-4 border-b border-neutral-200 dark:border-neutral-800 last:border-0 hover:bg-neutral-50 dark:hover:bg-[#121212] transition-colors -mx-2 px-2 sm:mx-0 sm:px-0">
                    <span class="text-3xl font-black text-neutral-200 dark:text-neutral-800 leading-none w-8 text-center shrink-0 group-hover:text-red-600 transition-colors">
                        {{ $index + 1 }}
                    </span>
                    <div class="flex flex-col">
                        <span class="text-[10px] font-bold text-red-600 uppercase tracking-widest mb-1">{{ $news->category->name ?? 'Populer' }}</span>
                        <h3 class="text-sm sm:text-base font-bold text-neutral-900 dark:text-neutral-100 group-hover:text-red-600 transition-colors leading-[1.4] line-clamp-3">
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

            <!-- Modern CTA Box (Promo) -->
            <div class="mt-8 bg-neutral-900 dark:bg-[#1a1a1a] rounded-sm p-6 relative overflow-hidden group">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-red-600/20 rounded-full blur-2xl group-hover:bg-red-600/40 transition-colors"></div>
                <div class="relative z-10">
                    <h4 class="text-white font-black text-sm uppercase tracking-wide mb-1">Eksklusif Visual</h4>
                    <p class="text-neutral-400 text-[11px] mb-4 leading-relaxed font-medium">Saksikan tayangan reportase langsung melalui kanal YouTube kami.</p>
                    <a href="{{ $settings['youtube_url'] ?? '#' }}" target="_blank" class="w-full inline-flex items-center justify-center gap-2 py-2.5 bg-red-600 text-white text-[11px] font-bold uppercase tracking-widest rounded-sm hover:bg-red-700 transition-colors">
                        Tonton Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- INDEKS TERKINI (Editorial Grid) -->
    <section id="indeks-terkini" class="px-4 sm:px-0">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 border-b-2 border-neutral-900 dark:border-neutral-100 pb-3 mb-8">
            <h2 class="text-2xl sm:text-3xl font-black text-neutral-900 dark:text-white uppercase tracking-tighter">Indeks Terkini</h2>
            <a href="#" class="text-neutral-500 hover:text-red-600 dark:text-neutral-400 dark:hover:text-red-500 text-[11px] font-bold uppercase tracking-widest transition-colors flex items-center gap-1">
                Lihat Semua Berita <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-10">
            @forelse($latestEpisodes as $index => $ep)
                @if(!( !isset($headlines) || $headlines->count() == 0 ) || $index > 0)
                    <article class="group flex flex-col h-full bg-transparent">
                        <a href="{{ route('episode.show', $ep->slug) }}" class="relative aspect-[3/2] sm:aspect-[4/3] overflow-hidden bg-neutral-100 dark:bg-neutral-800 block mb-4 rounded-sm">
                            <img src="{{ $ep->img ? asset('storage/' . $ep->img) : 'https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&w=800&q=80' }}" 
                                alt="{{ $ep->title }}" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                            <div class="absolute top-0 left-0">
                                <span class="bg-red-600 text-white text-[9px] font-bold px-2 py-1 uppercase tracking-widest shadow-sm">
                                    {{ $ep->category->name ?? 'Update' }}
                                </span>
                            </div>
                        </a>
                        
                        <div class="flex flex-col flex-grow">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-[10px] text-neutral-500 dark:text-neutral-400 font-bold uppercase tracking-wider">{{ $ep->published_at->format('d M Y') }}</span>
                            </div>
                            
                            <!-- Judul dengan garis bawah saat di-hover (gaya klasik portal berita) -->
                            <h3 class="text-lg sm:text-xl font-bold text-neutral-900 dark:text-neutral-50 leading-[1.3] mb-3 line-clamp-3">
                                <a href="{{ route('episode.show', $ep->slug) }}" class="group-hover:text-red-600 transition-colors bg-left-bottom bg-gradient-to-r from-red-600 to-red-600 bg-[length:0%_2px] bg-no-repeat group-hover:bg-[length:100%_2px] duration-500 ease-out pb-0.5">
                                    {{ $ep->title }}
                                </a>
                            </h3>
                            
                            <p class="text-neutral-600 dark:text-neutral-400 text-sm line-clamp-2 leading-relaxed mb-4">
                                {{ Str::limit(strip_tags($ep->content), 90) }}
                            </p>
                        </div>
                    </article>
                @endif
            @empty
                <div class="col-span-full py-20 text-center border-y border-neutral-200 dark:border-neutral-800">
                    <p class="text-neutral-400 font-bold uppercase tracking-widest text-xs">Informasi Belum Tersedia</p>
                    <p class="text-neutral-500 text-sm mt-2">Redaksi kami sedang menyiapkan konten terbaik untuk Anda.</p>
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

            // Perbaikan logika javascript untuk dots sesuai class HTML baru
            dots.forEach((d, idx) => {
                if(idx === n) {
                    d.classList.replace('bg-transparent', 'bg-red-600');
                    d.classList.replace('border-white/50', 'border-red-600');
                    d.classList.replace('w-3', 'w-10');
                } else {
                    d.classList.replace('bg-red-600', 'bg-transparent');
                    d.classList.replace('border-red-600', 'border-white/50');
                    d.classList.replace('w-10', 'w-3');
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