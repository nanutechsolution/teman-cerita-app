<x-layouts.app :settings="$settings">
{{-- Meta SEO dinamis --}}
@slot('title', 'Beranda | ' . ($settings['site_name'] ?? 'Teman Cerita NTT'))
@slot('meta_description', $settings['site_description'] ?? 'Portal berita independen dari Nusa Tenggara Timur.')

{{-- Pembungkus luar sudah ditangani oleh layout utama (app.blade.php) --}}
<div class="px-4 sm:px-6 lg:px-8 pt-8 pb-24">

    <!-- KILAS BERITA (TICKER) - Minimalist Design -->
    @if(isset($breakingNews) && $breakingNews->count() > 0)
    <div class="relative flex items-center bg-neutral-50 dark:bg-neutral-900/50 border border-neutral-200/60 dark:border-neutral-800 rounded-2xl overflow-hidden mb-10 group transition-all hover:border-red-500/30">
        <div class="bg-red-600 text-white px-5 py-3 text-[10px] font-black uppercase tracking-[0.2em] shrink-0 flex items-center gap-3">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
            </span>
            Flash
        </div>
        <div class="overflow-hidden w-full px-6">
            <marquee class="text-xs font-bold text-neutral-800 dark:text-neutral-200 uppercase tracking-tight" scrollamount="5" onmouseover="this.stop();" onmouseout="this.start();">
                @foreach($breakingNews as $item)
                    <a href="{{ route('episode.show', $item->slug) }}" class="hover:text-red-600 transition-colors mx-6">{{ $item->title }}</a>
                    @if(!$loop->last) <span class="text-neutral-300 dark:text-neutral-700 mx-2">•</span> @endif
                @endforeach
            </marquee>
        </div>
    </div>
    @endif

    <!-- HERO SECTION: HEADLINE & TRENDING -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 mb-20 items-start">
        <!-- Berita Utama (Headline) -->
        <div class="lg:col-span-8 group/headline">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div class="h-8 w-1.5 bg-red-600 rounded-full"></div>
                    <h2 class="text-2xl font-black text-neutral-900 dark:text-white uppercase tracking-tighter">
                        {{ (isset($headlines) && $headlines->count() > 0) ? 'Sorotan Utama' : 'Terbaru' }}
                    </h2>
                </div>
            </div>

            <div class="relative aspect-[16/10] md:aspect-[16/9] rounded-[2.5rem] overflow-hidden shadow-2xl shadow-neutral-200/50 dark:shadow-none bg-neutral-200 dark:bg-neutral-800">
                @if(isset($headlines) && $headlines->count() > 0)
                    <div id="headline-slider" class="h-full w-full relative">
                        @foreach($headlines as $index => $hl)
                            <div class="headline-slide h-full w-full absolute inset-0 transition-all duration-1000 ease-in-out {{ $index === 0 ? 'opacity-100 scale-100 z-10' : 'opacity-0 scale-105 z-0' }}" data-index="{{ $index }}">
                                <a href="{{ route('episode.show', $hl->slug) }}" class="block w-full h-full relative group/item">
                                    <img src="{{ $hl->img ? asset('storage/' . $hl->img) : 'https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&w=1200&q=80' }}" 
                                        alt="{{ $hl->title }}" 
                                        class="w-full h-full object-cover transform group-hover/item:scale-110 transition-transform duration-[2s] ease-out">
                                    
                                    <!-- Overlay Gradien yang lebih dramatis -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/30 to-transparent opacity-80 transition-opacity group-hover/item:opacity-90"></div>
                                    
                                    <!-- Konten Headline -->
                                    <div class="absolute bottom-0 left-0 w-full p-8 md:p-14 z-10">
                                        <div class="flex items-center gap-3 mb-5">
                                            <span class="bg-red-600 text-white text-[9px] font-black px-4 py-1.5 rounded-full uppercase tracking-[0.2em] shadow-lg shadow-red-600/20">
                                                {{ $hl->category->name ?? 'Fokus' }}
                                            </span>
                                            <span class="text-white/70 text-[10px] font-bold uppercase tracking-widest bg-white/10 backdrop-blur-md px-3 py-1.5 rounded-full">
                                                {{ $hl->published_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        <h3 class="text-3xl md:text-5xl font-black text-white leading-[1.1] mb-6 max-w-3xl filter drop-shadow-lg group-hover/item:text-red-500 transition-colors duration-500">
                                            {{ $hl->title }}
                                        </h3>
                                        <div class="flex items-center gap-4 border-t border-white/20 pt-6">
                                            <div class="h-10 w-10 rounded-full border-2 border-white/50 overflow-hidden shrink-0">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($hl->author->name ?? 'A') }}&background=random" class="w-full h-full object-cover">
                                            </div>
                                            <div class="text-white">
                                                <p class="text-[10px] uppercase tracking-widest font-black opacity-60">Dilaporkan Oleh</p>
                                                <p class="text-sm font-bold">{{ $hl->author->name ?? 'Redaksi' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                        
                        <!-- Slider Dots - Bottom Right -->
                        <div class="absolute bottom-10 right-10 flex gap-3 z-20">
                            @foreach($headlines as $index => $hl)
                                <button class="slider-dot w-3 h-3 rounded-full border-2 border-white/50 transition-all duration-500 {{ $index === 0 ? 'bg-red-600 border-red-600 w-10' : 'bg-transparent' }}" data-index="{{ $index }}"></button>
                            @endforeach
                        </div>
                    </div>
                @else
                    <!-- Desain Fallback -->
                    @if(isset($latestEpisodes) && $latestEpisodes->count() > 0)
                        @php $fallbackHl = $latestEpisodes->first(); @endphp
                        <div class="h-full w-full relative">
                            <a href="{{ route('episode.show', $fallbackHl->slug) }}" class="block w-full h-full relative group">
                                <img src="{{ $fallbackHl->img ? asset('storage/' . $fallbackHl->img) : 'https://images.unsplash.com/photo-1504711432869-5d590129a394?auto=format&fit=crop&w=1200&q=80' }}" 
                                    alt="{{ $fallbackHl->title }}" 
                                    class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-1000">
                                <div class="absolute inset-0 bg-neutral-950/80"></div>
                                <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-10">
                                    <span class="text-red-600 font-black text-[12px] uppercase tracking-[0.4em] mb-6">Warta Terbaru</span>
                                    <h3 class="text-3xl md:text-4xl font-black text-white leading-tight max-w-2xl">{{ $fallbackHl->title }}</h3>
                                    <div class="mt-8 h-1 w-20 bg-red-600"></div>
                                </div>
                            </a>
                        </div>
                    @endif
                @endif
            </div>
        </div>
        <!-- Trending Sidebar - Penyesuaian Ruang Kosong -->
        <div class="lg:col-span-4">
            <div class="flex items-center gap-3 mb-6">
                <div class="h-8 w-1.5 bg-neutral-900 dark:bg-neutral-100 rounded-full"></div>
                <h2 class="text-2xl font-black text-neutral-900 dark:text-white uppercase tracking-tighter">Hits</h2>
            </div>

            <div class="bg-white dark:bg-neutral-900 border border-neutral-100 dark:border-neutral-800 rounded-[2.5rem] p-8 shadow-sm h-auto">
                <div class="space-y-8">
                    @forelse($trendingNews as $index => $news)
                    <a href="{{ route('episode.show', $news->slug) }}" class="group flex items-start gap-5 relative">
                        <div class="flex flex-col">
                            <span class="text-xs font-black text-red-600 uppercase tracking-widest mb-1">{{ $news->category->name ?? 'Hot' }}</span>
                            <h3 class="text-base font-extrabold text-neutral-900 dark:text-neutral-100 group-hover:text-red-600 transition-colors leading-[1.3] line-clamp-2">
                                {{ $news->title }}
                            </h3>
                            <p class="text-[10px] text-neutral-400 font-bold mt-2 uppercase tracking-tighter">{{ number_format($news->views) }} Kali Dibaca</p>
                        </div>
                        <span class="text-4xl font-black text-neutral-100 dark:text-neutral-800/50 absolute -right-2 -top-2 transition-colors group-hover:text-red-600/10 pointer-events-none">
                            #{{ $index + 1 }}
                        </span>
                    </a>
                    @empty
                    <div class="py-10 text-center">
                        <p class="text-sm text-neutral-400 font-bold uppercase tracking-widest italic">Belum Ada Data</p>
                    </div>
                    @endforelse
                </div>

                <!-- Modern CTA Box -->
                <div class="mt-12 group relative overflow-hidden bg-neutral-950 rounded-[2rem] p-6 border border-white/5">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-red-600 rounded-full blur-[40px] opacity-20 group-hover:opacity-40 transition-opacity"></div>
                    <h4 class="text-white font-black text-sm mb-1">Eksklusif Visual</h4>
                    <p class="text-neutral-500 text-[10px] mb-5 leading-relaxed">Saksikan rangkuman berita harian melalui kanal YouTube kami.</p>
                    <a href="{{ $settings['youtube_url'] ?? '#' }}" target="_blank" class="w-full inline-flex items-center justify-center gap-2 py-3 bg-red-600 text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-red-700 transition-all hover:scale-[1.02] active:scale-95 shadow-xl shadow-red-600/20">
                        Ikuti Kami
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- INDEKS TERKINI -->
    <section id="indeks-terkini">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
            <div class="flex items-center gap-4">
                <div class="h-10 w-2 bg-red-600 rounded-full"></div>
                <h2 class="text-3xl font-black text-neutral-900 dark:text-white uppercase tracking-tighter">Laporan Terbaru</h2>
            </div>
            <div class="flex gap-2">
                <a href="#" class="px-6 py-3 bg-neutral-100 dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs font-black uppercase tracking-widest rounded-full hover:bg-red-600 hover:text-white transition-all shadow-sm">
                    Lihat Arsip
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-8 gap-y-12">
            @forelse($latestEpisodes as $index => $ep)
                @if(!( !isset($headlines) || $headlines->count() == 0 ) || $index > 0)
                    <article class="group flex flex-col h-full bg-white dark:bg-transparent rounded-[2rem] overflow-hidden transition-all duration-500 hover:shadow-xl hover:shadow-neutral-200/50 dark:hover:shadow-none">
                        <a href="{{ route('episode.show', $ep->slug) }}" class="relative aspect-[4/3] rounded-[1.5rem] overflow-hidden bg-neutral-100 dark:bg-neutral-800 block mb-6">
                            <img src="{{ $ep->img ? asset('storage/' . $ep->img) : 'https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&w=800&q=80' }}" 
                                alt="{{ $ep->title }}" 
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000 ease-out">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <div class="absolute top-4 left-4">
                                <span class="bg-white/90 dark:bg-neutral-900/90 backdrop-blur-md text-neutral-900 dark:text-white text-[8px] font-black px-3 py-1.5 rounded-lg uppercase tracking-widest shadow-sm">
                                    {{ $ep->category->name ?? 'Update' }}
                                </span>
                            </div>
                        </a>
                        <div class="flex flex-col flex-grow px-2">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-[10px] text-neutral-400 font-black uppercase tracking-widest">{{ $ep->published_at->format('M d, Y') }}</span>
                                <span class="h-1 w-1 rounded-full bg-red-600"></span>
                                <span class="text-[10px] text-neutral-400 font-bold uppercase tracking-widest">3 Min Read</span>
                            </div>
                            <h3 class="text-xl font-extrabold text-neutral-900 dark:text-neutral-50 group-hover:text-red-600 transition-colors leading-snug mb-4 line-clamp-3">
                                <a href="{{ route('episode.show', $ep->slug) }}">{{ $ep->title }}</a>
                            </h3>
                            <p class="text-neutral-500 dark:text-neutral-400 text-sm line-clamp-2 mb-6 leading-relaxed font-medium">
                                {{ Str::limit(strip_tags($ep->content), 100) }}
                            </p>
                            <div class="mt-auto pt-6 border-t border-neutral-100 dark:border-neutral-800">
                                <a href="{{ route('episode.show', $ep->slug) }}" class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-neutral-900 dark:text-white hover:text-red-600 dark:hover:text-red-500 transition-colors">
                                    Baca Detail <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7-7 7M3 12h18"/></svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @endif
            @empty
                <div class="col-span-full py-24 text-center rounded-[3rem] bg-neutral-50 dark:bg-neutral-900/50 border-2 border-dashed border-neutral-200 dark:border-neutral-800">
                    <div class="max-w-xs mx-auto">
                        <p class="text-neutral-400 font-black uppercase tracking-[0.2em] text-xs">Informasi Belum Tersedia</p>
                        <p class="text-neutral-500 text-sm mt-4">Redaksi kami sedang menyiapkan konten terbaik untuk Anda hari ini.</p>
                    </div>
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
                    s.classList.replace('scale-105', 'scale-100');
                    s.style.zIndex = "10";
                } else {
                    s.classList.replace('opacity-100', 'opacity-0');
                    s.classList.replace('scale-100', 'scale-105');
                    s.style.zIndex = "0";
                }
            });

            dots.forEach((d, idx) => {
                if(idx === n) {
                    d.classList.replace('bg-transparent', 'bg-red-600');
                    d.classList.replace('border-white/50', 'border-red-600');
                    d.classList.add('w-10');
                    d.classList.remove('w-3');
                } else {
                    d.classList.replace('bg-red-600', 'bg-transparent');
                    d.classList.replace('border-red-600', 'border-white/50');
                    d.classList.add('w-3');
                    d.classList.remove('w-10');
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