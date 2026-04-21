<x-layouts.app :settings="$settings">
    @slot('title', ($post->meta_title ?? $post->title))
    @slot('meta_description', $post->meta_description ?? $post->excerpt)
    @slot('meta_keywords', $post->meta_keywords)

    {{-- TAMBAHKAN DUA BARIS INI UNTUK SHARE WHATSAPP/FB --}}
    @slot('og_image', $post->img ? asset('storage/' . $post->img) : null)
    @slot('og_type', 'article')

    @push('head')
    @push('head')
    <style>
        .prose blockquote p::before,
        .prose blockquote p::after {
            content: none !important;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .trending-number {
            -webkit-text-stroke: 1px rgba(220, 38, 38, 0.2);
            color: transparent;
            font-family: 'Montserrat', sans-serif;
        }

        .dark .trending-number {
            -webkit-text-stroke: 1px rgba(239, 68, 68, 0.2);
        }
    </style>
    @endpush

    <!-- READING PROGRESS BAR -->
    <div x-data="{ percent: 0 }"
        x-init="window.addEventListener('scroll', () => { percent = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100 })"
        class="fixed top-0 left-0 w-full h-1 z-[100] pointer-events-none">
        <div class="h-full bg-red-600 transition-all duration-150 shadow-[0_0_10px_rgba(220,38,38,0.5)]" :style="'width: ' + percent + '%'"></div>
    </div>

    <article class="relative pt-24 lg:pt-32 pb-20 bg-white dark:bg-[#0c0c0c] transition-colors duration-300">
        <div class="max-w-[1350px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            {{-- Breadcrumbs & Top Ad --}}
            <div class="flex flex-col gap-6 mb-8 md:mb-12">
                <nav class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-[0.2em] text-neutral-400 no-scrollbar overflow-x-auto whitespace-nowrap">
                    <a href="{{ route('home') }}" class="hover:text-red-600 transition-colors">Beranda</a>
                    <span class="opacity-30">/</span>
                    @if($post->category)
                    <a href="{{ route('category.show', $post->category->slug) }}" class="hover:text-red-600 transition-colors">{{ $post->category->name }}</a>
                    <span class="opacity-30">/</span>
                    @endif
                    <span class="text-neutral-900 dark:text-neutral-200 truncate max-w-[150px] sm:max-w-none">{{ $post->title }}</span>
                </nav>

                <x-ad-banner position="home_top" class="!my-0" />
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 xl:gap-16 items-start">

                {{-- LEFT SIDE: Main Article Content --}}
                <div class="lg:col-span-8">
                    <header class="mb-8 sm:mb-12">
                        {{-- Judul: Ukuran dinamis untuk mobile-first --}}
                        <h1 class="text-2xl sm:text-4xl lg:text-5xl xl:text-[52px] font-[1000] text-neutral-900 dark:text-white leading-[1.2] sm:leading-[1.1] tracking-tight mb-6 sm:mb-8">
                            {{ $post->title }}
                        </h1>

                        <div class="flex flex-col gap-6 py-6 border-y border-neutral-100 dark:border-neutral-800">
                            {{-- Baris Atas: Info Penulis & Waktu --}}
                            <div class="flex items-start justify-between">
                                <div class="flex items-center gap-3 sm:gap-4">
                                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full overflow-hidden border-2 border-red-600/20 p-0.5 shrink-0">
                                        <img src="{{ $post->author && $post->author->profile_photo_path ? asset('storage/' . $post->author->profile_photo_path) : 'https://ui-avatars.com/api/?name='.urlencode($post->author->name ?? 'Redaksi').'&background=random' }}"
                                            class="w-full h-full object-cover rounded-full grayscale hover:grayscale-0 transition-all duration-500">
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-black text-neutral-900 dark:text-white text-xs sm:text-sm uppercase tracking-wide">
                                            {{ $post->author->name ?? 'Redaksi Highlight NTT' }}
                                        </span>
                                        <time class="text-[10px] sm:text-[11px] text-neutral-500 font-bold uppercase tracking-wider mt-0.5">
                                            {{ $post->published_at ? $post->published_at->translatedFormat('l, d F Y | H:i') : $post->created_at->translatedFormat('l, d F Y | H:i') }}
                                        </time>
                                    </div>
                                </div>

                                {{-- Meta Info: Waktu Baca & Jumlah Dilihat --}}
                                <div class="flex gap-4 sm:gap-6 text-right shrink-0">
                                    @php
                                    // Mengambil data views (sesuaikan dengan nama field di database Anda, misalnya 'views' atau 'view_count')
                                    $viewCount = $post->views ?? $post->view_count ?? $post->views_count ?? 0;
                                    @endphp

                                    @if($viewCount > 10)
                                    <div class="flex flex-col items-end">
                                        <span class="text-[9px] font-black text-neutral-400 uppercase tracking-widest leading-none mb-1">Dilihat</span>
                                        <span class="text-[11px] sm:text-xs font-bold text-red-600 flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            {{ number_format($viewCount) }}x
                                        </span>
                                    </div>
                                    @endif

                                    <div class="flex flex-col items-end border-l border-neutral-200 dark:border-neutral-800 pl-4 sm:pl-6">
                                        <span class="text-[9px] font-black text-neutral-400 uppercase tracking-widest leading-none mb-1">Waktu Baca</span>
                                        <span class="text-[11px] sm:text-xs font-bold dark:text-neutral-200 flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5 text-neutral-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            ± {{ max(1, ceil(str_word_count(strip_tags($post->content)) / 200)) }} Min
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- Baris Bawah: Social Share Lengkap --}}
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <span class="text-[10px] font-black text-neutral-400 uppercase tracking-[0.2em] sm:hidden text-center italic">Bagikan Artikel</span>

                                <div class="flex items-center justify-center sm:justify-start gap-2 sm:gap-3"
                                    x-data="{ 
                                        url: window.location.href, 
                                        title: '{{ addslashes($post->title) }}',
                                        copyTo() { 
                                            navigator.clipboard.writeText(this.url); 
                                            alert('Tautan disalin!'); 
                                        } 
                                    }">

                                    {{-- Facebook --}}
                                    <a :href="`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`"
                                        target="_blank" class="w-10 h-10 rounded-full bg-[#1877F2] text-white flex items-center justify-center hover:scale-110 transition-transform shadow-md" title="Share ke Facebook">
                                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                        </svg>
                                    </a>

                                    {{-- WhatsApp --}}
                                    <a :href="`https://api.whatsapp.com/send?text=${encodeURIComponent(title + ' - ' + url)}`"
                                        target="_blank" class="w-10 h-10 rounded-full bg-[#25D366] text-white flex items-center justify-center hover:scale-110 transition-transform shadow-md" title="Share ke WhatsApp">
                                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884" />
                                        </svg>
                                    </a>

                                    {{-- Twitter / X --}}
                                    <a :href="`https://twitter.com/intent/tweet?text=${encodeURIComponent(title)}&url=${encodeURIComponent(url)}`"
                                        target="_blank" class="w-10 h-10 rounded-full bg-black text-white flex items-center justify-center hover:scale-110 transition-transform shadow-md" title="Share ke X">
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                        </svg>
                                    </a>

                                    {{-- Telegram --}}
                                    <a :href="`https://t.me/share/url?url=${encodeURIComponent(url)}&text=${encodeURIComponent(title)}`"
                                        target="_blank" class="w-10 h-10 rounded-full bg-[#0088cc] text-white flex items-center justify-center hover:scale-110 transition-transform shadow-md" title="Share ke Telegram">
                                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4.64 6.8c-.15 1.58-.8 5.42-1.13 7.19-.14.75-.42 1-.68 1.03-.58.05-1.02-.38-1.58-.75-.88-.58-1.38-.94-2.23-1.5-.99-.65-.35-1.01.22-1.59.15-.15 2.71-2.48 2.76-2.69.01-.03.01-.14-.07-.2-.08-.06-.19-.04-.27-.02-.11.02-1.93 1.23-5.46 3.62-.51.35-.98.52-1.4.51-.46-.01-1.35-.26-2.01-.48-.81-.27-1.45-.42-1.39-.89.03-.24.36-.49.99-.75 3.88-1.69 6.47-2.8 7.76-3.32 3.7-1.5 4.46-1.76 4.96-1.77.11 0 .36.03.52.17.13.12.17.28.18.39z" />
                                        </svg>
                                    </a>

                                    {{-- Copy Link --}}
                                    <button @click="copyTo()" class="w-10 h-10 rounded-full bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 flex items-center justify-center hover:bg-red-600 hover:text-white transition-all shadow-sm" title="Salin Tautan">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </header>

                    {{-- MEDIA HERO (Selalu Menampilkan Gambar Sesuai Permintaan) --}}
                    <figure class="mb-10 sm:mb-12 -mx-4 sm:mx-0 group">
                        <div class="relative aspect-video sm:rounded-2xl overflow-hidden bg-neutral-100 dark:bg-neutral-900 shadow-2xl">
                            <img src="{{ $post->img ? asset('storage/' . $post->img) : asset('images/default-news.jpg') }}"
                                alt="{{ $post->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-[4000ms] ease-out">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                        </div>

                        @if($post->image_caption || $post->image_source)
                        <figcaption class="mt-4 px-4 sm:px-0 text-[11px] sm:text-xs text-neutral-500 flex flex-col sm:flex-row justify-between items-start gap-2 italic border-l-2 border-red-600 pl-4">
                            <span class="leading-relaxed">{{ $post->image_caption ?? $post->title }}</span>
                            @if($post->image_source)
                            <span class="font-black not-italic text-neutral-400 uppercase tracking-widest shrink-0 text-[9px]">Kredit: {{ $post->image_source }}</span>
                            @endif
                        </figcaption>
                        @endif
                    </figure>

                    {{-- ARTICLE BODY --}}
                    <div class="prose prose-base md:prose-lg dark:prose-invert max-w-none transition-all duration-300
                            prose-p:text-gray-800 dark:prose-p:text-gray-300
                            prose-p:mb-4
                            prose-p:leading-[1.65]
                            prose-p:text-[15.5px] md:prose-p:text-[17px]
                            prose-headings:text-gray-900 dark:prose-headings:text-gray-100
                            prose-headings:font-[900]
                            prose-headings:tracking-tight
                            prose-headings:mb-3
                            prose-a:text-red-600 dark:prose-a:text-red-500
                            prose-a:font-bold
                            prose-a:no-underline hover:prose-a:underline
                            prose-img:rounded-lg prose-img:shadow-md prose-img:my-6
                            prose-blockquote:border-l-4
                            prose-blockquote:border-red-600
                            prose-blockquote:bg-gray-50 dark:prose-blockquote:bg-white/5
                            prose-blockquote:py-2 prose-blockquote:px-6
                            prose-blockquote:my-8
                            prose-blockquote:text-gray-700 dark:prose-blockquote:text-gray-200
                            prose-blockquote:italic prose-blockquote:text-lg">

                        {!! $post->content !!}

                    </div> <!-- Tutup Prose Div Utama -->

                    {{-- TAMPILKAN VIDEO DI BAWAH ARTIKEL --}}
                    @if(isset($videoData) && $videoData['platform'] === 'youtube' && $videoData['id'])
                    <div class="mt-12 mb-8 not-prose p-1 border border-neutral-100 dark:border-neutral-800 rounded-2xl bg-white dark:bg-[#1a1a1a] shadow-lg">
                        <div class="flex items-center gap-2 p-4 pb-3">
                            <div class="w-8 h-8 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center">
                                <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-black text-neutral-900 dark:text-white uppercase tracking-wider">Video Terkait Artikel</h3>
                                <p class="text-[10px] text-neutral-500 uppercase tracking-widest mt-0.5">Tonton ulasan selengkapnya</p>
                            </div>
                        </div>
                        <div class="relative aspect-video rounded-xl overflow-hidden bg-black">
                            <iframe class="absolute inset-0 w-full h-full"
                                src="https://www.youtube.com/embed/{{ $videoData['id'] }}?rel=0&modestbranding=1"
                                frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                    @endif

                    {{-- IN-CONTENT BACA JUGA (Sinkron dengan $relatedPosts) --}}
                    @if(isset($relatedPosts) && $relatedPosts->count() > 0)
                    <div class="not-prose mt-10 mb-14 p-8 bg-neutral-50 dark:bg-[#151515] border-y-4 border-red-600 rounded-2xl relative overflow-hidden group shadow-sm">
                        <div class="absolute -right-4 -top-4 w-32 h-32 bg-red-600/5 blur-3xl rounded-full"></div>
                        <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-red-600 mb-6 flex items-center gap-3">
                            <span class="w-8 h-[2px] bg-red-600"></span>
                            Rekomendasi Redaksi
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            @foreach($relatedPosts->take(2) as $rel)
                            <a href="{{ route('post.show', $rel->slug) }}" class="flex gap-4 group/item">
                                <div class="w-20 h-20 shrink-0 rounded-xl overflow-hidden bg-neutral-200 shadow-sm">
                                    <img src="{{ $rel->img ? asset('storage/' . $rel->img) : asset('images/default.jpg') }}" class="w-full h-full object-cover group-hover/item:scale-110 transition-transform duration-500">
                                </div>
                                <h5 class="text-sm font-bold text-neutral-900 dark:text-white group-hover/item:text-red-600 transition-colors leading-snug line-clamp-3">
                                    {{ $rel->title }}
                                </h5>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <x-ad-banner position="footer_top" class="my-16 !px-0" />

                    {{-- TAGS --}}
                    @if($post->tags->count() > 0)
                    <div class="mt-12 flex flex-wrap gap-2.5 pt-10 border-t border-neutral-100 dark:border-neutral-800">
                        @foreach($post->tags as $tag)
                        <a href="{{ route('tag.show', $tag->slug) }}" class="px-5 py-2.5 bg-neutral-50 dark:bg-white/5 text-neutral-600 dark:text-neutral-400 text-[11px] font-black uppercase tracking-widest rounded-full hover:bg-red-600 hover:text-white transition-all border border-neutral-100 dark:border-neutral-800 hover:border-red-600 shadow-sm">
                            # {{ $tag->name }}
                        </a>
                        @endforeach
                    </div>
                    @endif
                </div>

                {{-- RIGHT SIDE: Sidebar --}}
                <div class="lg:col-span-4 space-y-12 lg:sticky lg:top-28">

                    {{-- SEARCH WIDGET --}}
                    <div class="bg-neutral-50 dark:bg-[#151515] p-6 rounded-3xl border border-neutral-100 dark:border-neutral-800 shadow-sm">
                        <h3 class="text-xs font-black text-neutral-900 dark:text-white uppercase tracking-widest mb-5 flex items-center gap-2">
                            <svg class="w-4 h-4 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Cari Berita
                        </h3>
                        <form action="{{ route('search') }}" method="GET" class="relative">
                            <input type="text" name="q" placeholder="E.g: Pilkada NTT..."
                                class="w-full bg-white dark:bg-[#0c0c0c] border border-neutral-200 dark:border-neutral-700 rounded-2xl px-5 py-3.5 text-sm focus:ring-2 focus:ring-red-600/20 focus:border-red-600 outline-none transition-all placeholder:text-neutral-400">
                            <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 text-neutral-400 hover:text-red-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </button>
                        </form>
                    </div>

                    {{-- TRENDING NTT --}}
                    @if(isset($relatedPosts) && $relatedPosts->count() > 0)
                    <section>
                        <div class="flex items-center justify-between mb-8 border-b-2 border-neutral-100 dark:border-neutral-800 pb-3">
                            <h3 class="text-sm font-black text-neutral-900 dark:text-white uppercase tracking-tighter">Trending <span class="text-red-600">NTT</span></h3>
                            <div class="flex gap-1.5">
                                <div class="w-1.5 h-1.5 bg-red-600 rounded-full animate-ping"></div>
                                <div class="w-1.5 h-1.5 bg-red-600 rounded-full"></div>
                            </div>
                        </div>
                        <div class="space-y-8">
                            @foreach($relatedPosts as $index => $news)
                            <a href="{{ route('post.show', $news->slug) }}" class="group relative flex items-start gap-4">
                                <span class="trending-number text-4xl font-black italic leading-none shrink-0 group-hover:scale-110 transition-transform duration-500">
                                    {{ $index + 1 }}
                                </span>
                                <div class="flex flex-col gap-1.5">
                                    <span class="text-[9px] font-black text-red-600 uppercase tracking-widest">{{ $news->category->name ?? 'Update' }}</span>
                                    <h4 class="text-sm font-bold text-neutral-900 dark:text-neutral-200 leading-snug group-hover:text-red-600 transition-colors line-clamp-2">
                                        {{ $news->title }}
                                    </h4>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </section>
                    @endif

                    {{-- SIDEBAR AD --}}
                    <div class="bg-neutral-50 dark:bg-[#151515] p-4 rounded-3xl border border-neutral-100 dark:border-neutral-800 shadow-sm text-center">
                        <x-ad-banner position="sidebar" class="!my-0 shadow-none rounded-2xl overflow-hidden" />
                    </div>

                    {{-- NARASUMBER --}}
                    @if($post->speakers && $post->speakers->count() > 0)
                    <section>
                        <h3 class="text-xs font-black text-neutral-900 dark:text-white uppercase tracking-widest mb-6 border-l-4 border-red-600 pl-3">Narasumber Utama</h3>
                        <div class="space-y-4">
                            @foreach($post->speakers as $speaker)
                            <div class="p-5 bg-white dark:bg-[#1a1a1a] rounded-2xl border border-neutral-100 dark:border-neutral-800 shadow-sm hover:shadow-md transition-all group cursor-default">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 rounded-xl overflow-hidden grayscale group-hover:grayscale-0 transition-all duration-700 shadow-inner">
                                        <img src="{{ $speaker->photo ? asset('storage/' . $speaker->photo) : 'https://ui-avatars.com/api/?name='.urlencode($speaker->name).'&background=random' }}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex flex-col">
                                        <h4 class="text-sm font-black text-neutral-900 dark:text-white leading-tight">{{ $speaker->name }}</h4>
                                        <p class="text-[10px] text-red-600 font-bold uppercase tracking-widest mt-1">{{ $speaker->profession }}</p>
                                    </div>
                                </div>
                                @if($speaker->bio)
                                <p class="text-[11px] text-neutral-500 dark:text-neutral-400 mt-4 leading-relaxed line-clamp-2 italic">"{{ $speaker->bio }}"</p>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </section>
                    @endif

                </div>
            </div>
        </div>
    </article>

    {{-- NEXT UP: Grid Berita Rekomendasi --}}
    @if(isset($relatedPosts) && $relatedPosts->count() > 0)
    <section class="py-24 bg-neutral-50 dark:bg-[#080808] border-t border-neutral-100 dark:border-neutral-900">
        <div class="max-w-[1350px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-12">
                <h2 class="text-3xl xl:text-4xl font-[1000] text-neutral-900 dark:text-white uppercase tracking-tighter">Baca <span class="text-red-600">Selanjutnya</span></h2>
                <div class="h-[2px] flex-1 bg-neutral-200 dark:bg-neutral-800 mx-8 hidden md:block"></div>
                <a href="{{ route('home') }}" class="text-[10px] font-black uppercase tracking-[0.3em] text-neutral-400 hover:text-red-600 transition-all flex items-center gap-3 group">
                    Indeks Berita
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 xl:gap-10">
                @foreach($relatedPosts as $bottom)
                <a href="{{ route('post.show', $bottom->slug) }}" class="group flex flex-col h-full bg-white dark:bg-[#111] p-3 rounded-3xl border border-neutral-100 dark:border-neutral-800 hover:border-red-600/30 transition-all hover:shadow-xl">
                    <div class="aspect-[4/3] overflow-hidden rounded-2xl bg-neutral-100 mb-5 relative">
                        <img src="{{ $bottom->img ? asset('storage/' . $bottom->img) : asset('images/default.jpg') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute top-3 left-3">
                            <span class="bg-red-600 text-white text-[9px] font-black px-2.5 py-1 uppercase tracking-widest rounded shadow-xl border border-white/10">
                                {{ $bottom->category->name ?? 'Update' }}
                            </span>
                        </div>
                    </div>
                    <div class="px-2 pb-2 flex flex-col flex-1">
                        <h3 class="text-lg font-black text-neutral-900 dark:text-white group-hover:text-red-600 transition-colors leading-tight line-clamp-3 mb-4">
                            {{ $bottom->title }}
                        </h3>
                        <div class="mt-auto flex items-center gap-3 text-[9px] font-black text-neutral-400 uppercase tracking-widest">
                            <span>{{ $bottom->published_at ? $bottom->published_at->translatedFormat('d M Y') : '' }}</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</x-layouts.app>