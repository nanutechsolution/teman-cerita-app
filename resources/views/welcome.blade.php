<x-layouts.app :settings="$settings">
    {{-- Meta SEO dinamis dari Settings --}}
    @slot('title', 'Beranda | ' . ($settings['site_name'] ?? 'Teman Cerita NTT'))
    @slot('meta_description', $settings['site_description'] ?? 'Portal berita independen dari Nusa Tenggara Timur.')

    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 pt-6">

        <!-- BREAKING NEWS TICKER -->
        @if(isset($breakingNews) && $breakingNews->count() > 0)
        <div class="flex items-center bg-white dark:bg-[#121212] border border-neutral-200 dark:border-neutral-800 rounded-lg p-2 mb-8 shadow-sm transition-colors duration-300">
            <span class="bg-red-600 text-white px-3 py-1.5 text-xs font-bold uppercase rounded-md mr-4 shrink-0 flex items-center gap-2">
                <svg class="w-4 h-4 animate-pulse" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9V8h2v8zm4 0h-2V8h2v8z"/></svg>
                Kilas Berita
            </span>
            <div class="overflow-hidden w-full relative">
                <marquee class="text-sm font-medium text-neutral-700 dark:text-neutral-300 flex items-center h-full pt-1" scrollamount="5" onmouseover="this.stop();" onmouseout="this.start();">
                    @foreach($breakingNews as $item)
                        <a href="{{ route('episode.show', $item->slug) }}" class="hover:text-red-600 transition-colors">{{ $item->title }}</a>
                        @if(!$loop->last) &nbsp;&nbsp;&bull;&nbsp;&nbsp; @endif
                    @endforeach
                </marquee>
            </div>
        </div>
        @endif

        <!-- HEADLINE & TRENDING SECTION -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-12">
            
            <!-- Berita Utama (Headline) -->
            <div class="lg:col-span-8">
                <div class="flex items-center gap-2 border-b-2 border-neutral-200 dark:border-neutral-800 pb-2 mb-4 transition-colors duration-300">
                    <div class="w-3 h-3 bg-red-600"></div>
                    <h2 class="text-xl font-bold text-neutral-900 dark:text-white uppercase tracking-wider">Sorotan Utama</h2>
                </div>

                @if($headline)
                <a href="{{ route('episode.show', $headline->slug) }}" class="relative group block rounded-2xl overflow-hidden bg-neutral-100 dark:bg-[#1a1a1a] border border-neutral-200 dark:border-neutral-800 transition-colors duration-300 shadow-md">
                    <div class="aspect-[16/9] lg:aspect-[21/9] w-full overflow-hidden">
                        <img src="{{ $headline->img ? asset('storage/' . $headline->img) : 'https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80' }}" alt="{{ $headline->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                    </div>
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-neutral-900 via-neutral-900/40 dark:from-[#0f0f0f] dark:via-[#0f0f0f]/60 to-transparent"></div>
                    
                    <div class="absolute bottom-0 left-0 w-full p-6 md:p-8">
                        <span class="bg-red-600 text-white text-[10px] sm:text-xs font-bold px-3 py-1 rounded-sm uppercase tracking-wider mb-3 inline-block">
                            {{ $headline->category->name ?? 'Update' }}
                        </span>
                        <h3 class="text-2xl md:text-4xl font-bold text-white leading-tight mb-3 group-hover:text-red-400 transition-colors">
                            {{ $headline->title }}
                        </h3>
                        <div class="flex items-center gap-4 text-neutral-200 text-sm font-medium">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                {{ $headline->published_at->diffForHumans() }}
                            </span>
                            <span>•</span>
                            <span>Oleh {{ $headline->author->name ?? 'Redaksi' }}</span>
                        </div>
                    </div>
                </a>
                @else
                <div class="aspect-[16/9] rounded-2xl bg-neutral-100 dark:bg-[#1a1a1a] border border-neutral-200 dark:border-neutral-800 flex items-center justify-center text-neutral-400">
                    Belum ada headline tersedia.
                </div>
                @endif
            </div>

            <!-- Sidebar Berita Terpopuler (Trending) -->
            <div class="lg:col-span-4">
                <div class="flex items-center gap-2 border-b-2 border-neutral-200 dark:border-neutral-800 pb-2 mb-4 transition-colors duration-300">
                    <div class="w-3 h-3 bg-red-600"></div>
                    <h2 class="text-xl font-bold text-neutral-900 dark:text-white uppercase tracking-wider">Terpopuler</h2>
                </div>

                <div class="flex flex-col gap-5">
                    @forelse($trendingNews as $index => $news)
                    <a href="{{ route('episode.show', $news->slug) }}" class="group flex gap-4 items-start">
                        <h4 class="text-4xl font-black text-neutral-300 dark:text-neutral-800 group-hover:text-red-600 transition-colors">
                            {{ sprintf('%02d', $index + 1) }}
                        </h4>
                        <div>
                            <h3 class="text-base font-bold text-neutral-900 dark:text-white group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors leading-snug mb-1">
                                {{ $news->title }}
                            </h3>
                            <span class="text-[11px] text-neutral-500 font-medium uppercase">
                                {{ $news->category->name ?? 'Umum' }} • {{ $news->views }} kali dibaca
                            </span>
                        </div>
                    </a>
                    @if(!$loop->last)
                    <hr class="border-neutral-200 dark:border-neutral-800 transition-colors">
                    @endif
                    @empty
                    <p class="text-sm text-neutral-500 italic">Belum ada data trending.</p>
                    @endforelse
                </div>
                
                <!-- Podcast Promo di Sidebar -->
                <div class="mt-8 bg-neutral-100 dark:bg-[#121212] border border-neutral-200 dark:border-neutral-800 p-6 rounded-xl text-center transition-colors duration-300">
                    <p class="text-[10px] text-neutral-500 uppercase font-black tracking-widest mb-2">Suara Dari Timur</p>
                    <a href="{{ $settings['youtube_url'] ?? '#' }}" target="_blank" class="block group">
                        <h4 class="text-lg font-bold text-neutral-900 dark:text-white group-hover:text-red-500 transition-colors italic">Dengarkan Podcast Kami</h4>
                        <p class="text-xs text-neutral-600 dark:text-neutral-400 mt-2 mb-4 leading-relaxed">Diskusi mendalam bersama tokoh dan narasumber inspiratif Nusa Tenggara Timur.</p>
                        <span class="bg-red-600 text-white px-5 py-2 rounded-full text-xs font-bold inline-flex items-center gap-2 hover:bg-red-700 transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                            Tonton di YouTube
                        </span>
                    </a>
                </div>
            </div>
        </div>

        <!-- BERITA TERBARU (Main Grid) -->
        <section id="berita-terbaru" class="mb-16">
            <div class="flex items-center justify-between border-b-2 border-neutral-200 dark:border-neutral-800 pb-2 mb-6 transition-colors duration-300">
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 bg-red-600"></div>
                    <h2 class="text-xl font-bold text-neutral-900 dark:text-white uppercase tracking-wider">Terbaru Hari Ini</h2>
                </div>
                <a href="#" class="text-sm text-red-600 dark:text-red-500 hover:text-red-700 dark:hover:text-red-400 font-bold flex items-center gap-1 transition-colors">
                    Lihat Indeks <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($latestEpisodes as $ep)
                    <a href="{{ route('episode.show', $ep->slug) }}" class="group flex flex-col bg-white dark:bg-[#121212] border border-neutral-200 dark:border-neutral-800 rounded-xl overflow-hidden hover:border-neutral-400 dark:hover:border-neutral-600 transition-all h-full shadow-sm hover:shadow-md">
                        <div class="relative aspect-[16/10] overflow-hidden bg-neutral-100 dark:bg-[#1a1a1a]">
                            <img src="{{ $ep->img ? asset('storage/' . $ep->img) : asset('placeholder-news.jpg') }}" alt="{{ $ep->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            
                            {{-- Kategori Badge --}}
                            <div class="absolute top-3 left-3 bg-red-600 text-white text-[9px] font-bold px-2 py-0.5 rounded uppercase tracking-widest shadow-lg">
                                {{ $ep->category->name ?? 'Berita' }}
                            </div>

                            {{-- Durasi (Jika Video) --}}
                            @if($ep->type !== 'article' && $ep->duration)
                            <div class="absolute bottom-2 right-2 bg-black/80 text-white text-[10px] font-bold px-1.5 py-0.5 rounded">
                                {{ $ep->duration }}
                            </div>
                            @endif
                        </div>
                        
                        <div class="p-4 flex flex-col flex-grow">
                            <h3 class="text-base md:text-lg font-bold text-neutral-900 dark:text-white line-clamp-3 leading-snug group-hover:text-red-600 dark:group-hover:text-red-500 transition-colors mb-3">
                                {{ $ep->title }}
                            </h3>
                            
                            <div class="mt-auto pt-3 border-t border-neutral-100 dark:border-neutral-800 flex items-center justify-between text-[11px] text-neutral-500 font-medium">
                                <span class="flex items-center gap-1">
                                    {{ $ep->published_at->format('d M Y') }}
                                </span>
                                <span class="flex items-center gap-1 uppercase tracking-tighter">
                                    Oleh {{ $ep->author->name ?? 'Redaksi' }}
                                </span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full py-16 text-center border border-neutral-200 dark:border-neutral-800 rounded-xl bg-white dark:bg-[#121212] transition-colors duration-300">
                        <p class="text-neutral-500 font-medium">Belum ada konten untuk ditampilkan.</p>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- CALL TO ACTION: Newsletter (Gaya Jurnalistik) -->
        <section class="mb-16">
            <div class="relative bg-neutral-900 dark:bg-[#1a1a1a] border border-neutral-800 rounded-2xl p-8 md:p-12 overflow-hidden shadow-xl">
                <div class="absolute top-0 right-0 w-80 h-80 bg-red-600/10 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/4"></div>

                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="max-w-xl text-center md:text-left border-l-4 border-red-600 pl-6">
                        <h2 class="text-2xl md:text-3xl font-black text-white mb-2 tracking-tight uppercase">Jadilah Yang Pertama Tahu</h2>
                        <p class="text-neutral-400 text-sm md:text-base leading-relaxed">Berlangganan buletin gratis kami untuk menerima ringkasan isu publik NTT langsung ke email Anda setiap Senin pagi.</p>
                    </div>
                    <div class="w-full md:w-auto">
                        <form action="#" class="flex flex-col sm:flex-row gap-2">
                            <input type="email" placeholder="Masukkan alamat email..." class="px-5 py-3.5 rounded-sm bg-neutral-800 dark:bg-[#121212] border border-neutral-700 text-white placeholder:text-neutral-500 focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 w-full sm:w-80 transition-all">
                            <button class="bg-red-600 text-white px-8 py-3.5 rounded-sm font-black text-sm uppercase tracking-widest hover:bg-red-700 transition-all active:scale-95">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- PARTNERS -->
        @if(isset($partners) && $partners->count() > 0)
        <section class="py-12 border-t border-neutral-200 dark:border-neutral-800">
            <div class="text-center mb-10">
                <p class="text-[10px] font-black text-neutral-500 uppercase tracking-[0.4em]">Mitra Strategis & Jaringan</p>
            </div>
            <div class="flex flex-wrap justify-center items-center gap-12 sm:gap-16 opacity-60 dark:opacity-40 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-700">
                @foreach($partners as $partner)
                    <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}" class="h-8 md:h-10 w-auto object-contain" title="{{ $partner->name }}">
                @endforeach
            </div>
        </section>
        @endif

    </div>
</x-layouts.app>