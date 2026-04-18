<x-layouts.app :settings="$settings">
    {{-- SEO Meta Dinamis --}}
    @slot('title', ($post->meta_title ??$post->title) . ' | ' . ($settings['site_name'] ?? 'Highlight NTT'))
    @slot('meta_description',$post->meta_description ??$post->excerpt)
    @slot('meta_keywords',$post->meta_keywords)

    <article class="relative pt-24 lg:pt-32 pb-20 bg-white dark:bg-[#121212] transition-colors duration-300">
        <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            {{-- Breadcrumbs (Gaya Editorial Bersih) --}}
            <nav class="flex items-center gap-2 text-[11px] font-semibold uppercase tracking-widest text-neutral-500 mb-6 md:mb-8 overflow-x-auto whitespace-nowrap no-scrollbar">
                <a href="{{ route('home') }}" class="hover:text-red-600 transition-colors">Beranda</a>
                <span class="text-neutral-300 dark:text-neutral-700">/</span>
                @if($post->category)
                    <a href="{{ route('category.show',$post->category->slug) }}" class="hover:text-red-600 transition-colors">{{$post->category->name }}</a>
                    <span class="text-neutral-300 dark:text-neutral-700">/</span>
                @endif
                <span class="text-neutral-900 dark:text-neutral-300 truncate max-w-[200px]">{{ Str::limit($post->title, 30) }}</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
                
                {{-- LEFT SIDE: Main Article Content --}}
                <div class="lg:col-span-8">
                    <header class="mb-8">
                        {{-- Kategori Label --}}
                        <div class="mb-4 flex items-center gap-3">
                            <a href="{{$post->category ? route('category.show',$post->category->slug) : '#' }}" 
                               class="text-red-600 text-[11px] font-black uppercase tracking-widest">
                                {{$post->category->name ?? 'News' }}
                            </a>
                            @if($post->type !== 'article')
                                <span class="text-neutral-300 dark:text-neutral-700">|</span>
                                <span class="flex items-center gap-1.5 text-[10px] font-bold text-neutral-500 uppercase tracking-widest">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-600 animate-pulse"></span>
                                    {{$post->type === 'short' ? 'Shorts' : 'Video' }}
                                </span>
                            @endif
                        </div>
                        
                        {{-- Judul Berita --}}
                        <h1 class="text-3xl sm:text-4xl md:text-[42px] font-black text-neutral-900 dark:text-white leading-[1.2] tracking-tight mb-6">
                            {{$post->title }}
                        </h1>

                        {{-- Metadata Row (Penulis & Tanggal) --}}
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 py-4 border-y border-neutral-200 dark:border-neutral-800">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-neutral-100 dark:bg-neutral-800 flex items-center justify-center overflow-hidden shrink-0 border border-neutral-200 dark:border-neutral-700">
                                    @if($post->author &&$post->author->profile_photo_path)
                                        <img src="{{ asset('storage/' .$post->author->profile_photo_path) }}" alt="{{$post->author->name }}" class="w-full h-full object-cover grayscale">
                                    @else
                                        <div class="font-black text-red-600 text-sm">{{ substr($post->author->name ?? 'TC', 0, 2) }}</div>
                                    @endif
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-bold text-neutral-900 dark:text-white text-sm">{{$post->author->name ?? 'Redaksi Highlight NTT' }}</span>
                                    <time class="text-[11px] text-neutral-500 font-medium">
                                        {{$post->published_at ?$post->published_at->translatedFormat('l, d F Y | H:i') :$post->created_at->translatedFormat('l, d F Y | H:i') }} WIB
                                    </time>
                                </div>
                            </div>

                            {{-- Share Buttons Mini --}}
                            <div class="flex items-center gap-2" x-data="{ 
                                copyTo() {
                                    navigator.clipboard.writeText(window.location.href);
                                    alert('Tautan disalin!');
                                }
                            }">
                                <span class="text-[10px] text-neutral-400 font-bold uppercase tracking-widest mr-2">Bagikan:</span>
                                <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' - ' . url()->current()) }}" target="_blank" class="w-8 h-8 rounded-full bg-green-500 text-white flex items-center justify-center hover:bg-green-600 transition-colors">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884"/></svg>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title) }}" target="_blank" class="w-8 h-8 rounded-full bg-neutral-900 dark:bg-white text-white dark:text-black flex items-center justify-center hover:opacity-80 transition-opacity">
                                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                </a>
                                <button @click="copyTo()" class="w-8 h-8 rounded-full bg-neutral-200 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 flex items-center justify-center hover:bg-neutral-300 dark:hover:bg-neutral-700 transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg>
                                </button>
                            </div>
                        </div>
                    </header>

                    {{-- MEDIA HERO AREA (Edge-to-edge di Mobile) --}}
                    <figure class="mb-8 sm:mb-12 -mx-4 sm:mx-0">
                        <div class="relative aspect-video sm:rounded-sm overflow-hidden bg-neutral-100 dark:bg-neutral-900">
                            <img src="{{$post->img ? asset('storage/' .$post->img) : asset('images/default-news.jpg') }}" 
                                 alt="{{$post->title }}" 
                                 class="w-full h-full object-cover">
                            
                            @if($post->link)
                                <div class="absolute top-4 right-4 z-20">
                                    <div class="bg-black/70 backdrop-blur-md text-white px-3 py-1.5 rounded-sm flex items-center gap-1.5">
                                        <svg class="w-4 h-4 fill-current text-red-500" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                        <span class="text-[10px] font-bold uppercase tracking-widest">Video Utama</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        {{-- Caption Gambar --}}
                        @if($post->image_caption ||$post->image_source)
                        <figcaption class="mt-2 px-4 sm:px-0 text-[11px] sm:text-xs text-neutral-500 flex flex-col sm:flex-row justify-between gap-1">
                            <span class="leading-relaxed">{{$post->image_caption ??$post->title }}</span>
                            @if($post->image_source)
                            <span class="font-semibold uppercase tracking-wider text-neutral-400 shrink-0">Kredit: {{$post->image_source }}</span>
                            @endif
                        </figcaption>
                        @endif
                    </figure>

                    {{-- ARTICLE BODY (Tipografi Jurnalistik) --}}
                    <div class="prose prose-lg dark:prose-invert max-w-none transition-all duration-300
                        prose-p:text-neutral-800 dark:prose-p:text-neutral-300 prose-p:leading-[1.8] prose-p:mb-6 prose-p:text-[17px]
                        prose-headings:text-neutral-900 dark:prose-headings:text-white prose-headings:font-bold prose-headings:tracking-tight
                        prose-a:text-red-600 dark:prose-a:text-red-500 prose-a:font-semibold prose-a:no-underline hover:prose-a:underline
                        prose-img:rounded-sm
                        prose-blockquote:border-l-4 prose-blockquote:border-red-600 prose-blockquote:bg-neutral-50 dark:prose-blockquote:bg-[#1a1a1a] prose-blockquote:py-2 prose-blockquote:px-6 prose-blockquote:my-8 prose-blockquote:text-neutral-700 dark:prose-blockquote:text-neutral-300 prose-blockquote:font-serif prose-blockquote:italic prose-blockquote:text-xl">
                        {!!$post->content !!}
                    </div>

                    {{-- VIDEO PLAYER Bawah Artikel --}}
                    @if(isset($videoData) && $videoData['platform'] === 'youtube' && $videoData['id'])
                    <div class="my-10 border border-neutral-200 dark:border-neutral-800 rounded-sm overflow-hidden">
                        <div class="p-4 bg-neutral-50 dark:bg-[#1a1a1a] border-b border-neutral-200 dark:border-neutral-800 flex items-center gap-3">
                            <svg class="w-5 h-5 text-red-600 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            <h4 class="font-bold text-sm uppercase tracking-wide dark:text-white">Tayangan Terkait</h4>
                        </div>
                        <div class="relative aspect-video">
                            <iframe class="absolute inset-0 w-full h-full" 
                                src="https://www.youtube.com/embed/{{ $videoData['id'] }}?autoplay=0&rel=0&modestbranding=1" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                    @endif

                    {{-- TAGS (Topik Terkait) --}}
                    @if($post->tags &&$post->tags->count() > 0)
                    <div class="mt-12 flex flex-wrap gap-2 pt-6 border-t border-neutral-200 dark:border-neutral-800">
                        <span class="text-[10px] font-bold text-neutral-400 uppercase tracking-widest w-full mb-1">Topik Berita:</span>
                        @foreach($post->tags as $tag)
                            <a href="{{ route('tag.show', $tag->slug) }}" class="px-4 py-1.5 bg-neutral-100 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300 text-[11px] font-semibold uppercase tracking-wider rounded-sm hover:bg-red-600 hover:text-white transition-colors">
                                {{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                    @endif

                </div>

                {{-- RIGHT SIDE: Professional Sidebar --}}
                <div class="lg:col-span-4 lg:sticky lg:top-28">
                    
                    {{-- Narasumber Profil (Lebih Bersih) --}}
                    @if($post->speakers &&$post->speakers->count() > 0)
                    <div class="mb-10">
                        <h3 class="text-sm font-black text-neutral-900 dark:text-white uppercase tracking-tight border-b-2 border-black dark:border-white pb-2 mb-5">
                            Narasumber
                        </h3>
                        <div class="space-y-6">
                            @foreach($post->speakers as $speaker)
                            <div class="flex items-start gap-4">
                                <div class="w-14 h-14 rounded-sm overflow-hidden bg-neutral-200 shrink-0">
                                    @if($speaker->photo)
                                        <img src="{{ asset('storage/' . $speaker->photo) }}" class="w-full h-full object-cover grayscale">
                                    @else
                                        <svg class="w-full h-full p-3 text-neutral-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                    @endif
                                </div>
                                <div class="flex flex-col">
                                    <h4 class="text-sm font-bold text-neutral-900 dark:text-white leading-tight">{{ $speaker->name }}</h4>
                                    <p class="text-[11px] text-red-600 font-semibold uppercase tracking-widest mt-1">{{ $speaker->profession }}</p>
                                    @if($speaker->bio)
                                    <p class="text-xs text-neutral-600 dark:text-neutral-400 mt-2 line-clamp-3 leading-relaxed">
                                        {{ $speaker->bio }}
                                    </p>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Baca Juga (Related News - Style Portal Berita) --}}
                    @if(isset($relatedEpisodes) && $relatedEpisodes->count() > 0)
                    <div class="mb-10">
                        <h3 class="text-sm font-black text-neutral-900 dark:text-white uppercase tracking-tight border-b-2 border-black dark:border-white pb-2 mb-5">
                            Berita Terkait
                        </h3>
                        <div class="flex flex-col">
                            @foreach($relatedEpisodes as $related)
                            <a href="{{ route('episode.show', $related->slug) }}" class="group flex gap-4 items-start py-4 border-b border-neutral-200 dark:border-neutral-800 last:border-0 hover:bg-neutral-50 dark:hover:bg-[#1a1a1a] transition-colors -mx-4 px-4 sm:mx-0 sm:px-2 rounded-sm">
                                <div class="w-24 h-[68px] shrink-0 overflow-hidden bg-neutral-100 dark:bg-neutral-800 rounded-sm">
                                    <img src="{{ $related->img ? asset('storage/' . $related->img) : asset('images/default.jpg') }}" 
                                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                </div>
                                <div class="flex flex-col justify-center h-full">
                                    <h4 class="text-[13px] font-bold text-neutral-900 dark:text-white leading-snug line-clamp-3 group-hover:text-red-600 transition-colors">
                                        {{ $related->title }}
                                    </h4>
                                    <p class="text-[10px] text-neutral-500 font-medium uppercase tracking-widest mt-2">{{ $related->published_at ? $related->published_at->format('d/m/Y') : '' }}</p>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Banner Promo Redaksi --}}
                    <div class="bg-neutral-50 dark:bg-[#1a1a1a] border border-neutral-200 dark:border-neutral-800 p-6 text-center rounded-sm">
                        <h4 class="text-sm font-black mb-2 uppercase tracking-wide dark:text-white">Kirim Opini / Rilis</h4>
                        <p class="text-neutral-500 text-xs mb-4 leading-relaxed">Sampaikan informasi publik, artikel opini, atau hak jawab kepada redaksi kami.</p>
                        <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}" target="_blank" class="inline-block w-full bg-neutral-900 dark:bg-white text-white dark:text-neutral-900 py-2.5 font-bold uppercase text-[11px] tracking-widest hover:bg-red-600 dark:hover:bg-red-600 dark:hover:text-white transition-colors rounded-sm">
                            Hubungi Redaksi
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </article>

    {{-- BOTTOM GRID (Rekomendasi Berita Lainnya) --}}
    <section class="py-16 bg-neutral-50 dark:bg-[#0f0f0f] border-t border-neutral-200 dark:border-neutral-800">
        <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex items-center justify-between border-b-2 border-black dark:border-white pb-3 mb-8">
                <h2 class="text-xl sm:text-2xl font-black text-neutral-900 dark:text-white uppercase tracking-tighter">Pilihan Redaksi</h2>
                <a href="{{ route('home') }}" class="text-[11px] font-bold text-neutral-500 hover:text-red-600 uppercase tracking-widest transition-colors flex items-center gap-1 group">
                    Indeks <svg class="w-3 h-3 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
                @php $bottomItems = isset($latestEpisodes) ? $latestEpisodes->take(4) : (isset($relatedEpisodes) ? $relatedEpisodes->take(4) : []); @endphp
                @foreach($bottomItems as $bottom)
                <a href="{{ route('episode.show', $bottom->slug) }}" class="group flex flex-col h-full bg-transparent">
                    <div class="aspect-[3/2] overflow-hidden bg-neutral-100 dark:bg-[#1a1a1a] mb-3 rounded-sm relative border border-neutral-200 dark:border-neutral-800">
                        <img src="{{ $bottom->img ? asset('storage/' . $bottom->img) : asset('images/default.jpg') }}" 
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute bottom-0 left-0 bg-red-600 text-white text-[9px] font-bold px-2 py-1 uppercase tracking-widest">
                            {{ $bottom->category->name ?? 'Update' }}
                        </div>
                    </div>
                    <div class="flex flex-col flex-grow">
                        <div class="text-[10px] font-medium text-neutral-500 uppercase tracking-widest mb-1">
                            {{ $bottom->published_at ? $bottom->published_at->format('d M Y') : '' }}
                        </div>
                        <h5 class="font-bold text-[15px] text-neutral-900 dark:text-white group-hover:text-red-600 transition-colors line-clamp-3 leading-snug">
                            {{ $bottom->title }}
                        </h5>
                    </div>
                </a>
                @endforeach
            </div>

        </div>
    </section>
</x-layouts.app>