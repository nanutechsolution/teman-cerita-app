<x-layouts.app :settings="$settings">
    {{-- SEO Meta Dinamis --}}
    @slot('title', ($episode->meta_title ?? $episode->title) . ' | ' . ($settings['site_name'] ?? 'Teman Cerita NTT'))
    @slot('meta_description', $episode->meta_description ?? $episode->excerpt)
    @slot('meta_keywords', $episode->meta_keywords)

    <article class="relative pt-24 lg:pt-32 pb-20 transition-colors duration-300">
        <div class="max-w-[1440px] mx-auto px-4 sm:px-6 relative z-10">
            
            {{-- Breadcrumbs (Gaya Minimalis) --}}
            <nav class="flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-neutral-400 mb-8 overflow-x-auto whitespace-nowrap pb-2 no-scrollbar">
                <a href="{{ route('home') }}" class="hover:text-red-600 transition-colors">Beranda</a>
                <span class="opacity-30">/</span>
                @if($episode->category)
                    <a href="{{ route('category.show', $episode->category->slug) }}" class="hover:text-red-600 transition-colors">{{ $episode->category->name }}</a>
                    <span class="opacity-30">/</span>
                @endif
                <span class="text-neutral-900 dark:text-white truncate max-w-[200px] italic">{{ $episode->title }}</span>
            </nav>

            <div class="grid lg:grid-cols-12 gap-10 xl:gap-20 items-start">
                
                {{-- LEFT SIDE: Main Article Content --}}
                <div class="lg:col-span-8">
                    <header class="mb-10">
                        {{-- Kategori & Label --}}
                        <div class="flex items-center gap-3 mb-6">
                            <a href="{{ $episode->category ? route('category.show', $episode->category->slug) : '#' }}" 
                               class="bg-red-600 text-white text-[10px] font-black px-3 py-1 rounded-sm uppercase tracking-widest shadow-lg shadow-red-900/20">
                                {{ $episode->category->name ?? 'News' }}
                            </a>
                            @if($episode->type !== 'article')
                                <span class="flex items-center gap-1.5 text-[10px] font-black text-neutral-500 dark:text-neutral-400 uppercase tracking-widest">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-600 animate-pulse"></span>
                                    {{ $episode->type === 'short' ? 'Shorts' : 'Video' }}
                                </span>
                            @endif
                        </div>
                        
                        <h1 class="text-3xl md:text-5xl lg:text-6xl font-black text-neutral-900 dark:text-white leading-[1.1] tracking-tighter mb-8 transition-colors">
                            {{ $episode->title }}
                        </h1>

                        {{-- Metadata Row --}}
                        <div class="flex flex-wrap items-center gap-5 py-6 border-y border-neutral-200 dark:border-neutral-800 text-sm transition-colors duration-300">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-full bg-neutral-100 dark:bg-[#1a1a1a] border border-neutral-200 dark:border-neutral-700 flex items-center justify-center overflow-hidden shadow-sm">
                                    @if($episode->author && $episode->author->profile_photo_path)
                                        <img src="{{ asset('storage/' . $episode->author->profile_photo_path) }}" alt="{{ $episode->author->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="font-black text-red-600 uppercase text-sm tracking-tighter">{{ substr($episode->author->name ?? 'TC', 0, 2) }}</div>
                                    @endif
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-black text-neutral-900 dark:text-white text-xs uppercase tracking-wider italic">{{ $episode->author->name ?? 'Redaksi Teman Cerita' }}</span>
                                    <span class="text-[10px] text-neutral-500 uppercase font-bold tracking-widest">Penulis Media Siber</span>
                                </div>
                            </div>
                            
                            <div class="hidden sm:block h-10 w-px bg-neutral-200 dark:bg-neutral-800"></div>
                            
                            <div class="flex flex-col">
                                <span class="text-[10px] text-neutral-400 uppercase font-black tracking-widest mb-0.5">Diterbitkan</span>
                                <time class="text-xs font-bold text-neutral-600 dark:text-neutral-300">
                                    {{ $episode->published_at ? $episode->published_at->translatedFormat('d F Y | H:i') : $episode->created_at->translatedFormat('d F Y | H:i') }} WITA
                                </time>
                            </div>

                            <div class="ml-auto flex items-center gap-2 bg-neutral-100 dark:bg-[#1a1a1a] px-4 py-2 rounded-full border border-neutral-200 dark:border-neutral-800">
                                <svg class="w-4 h-4 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                <span class="text-[11px] font-black text-neutral-700 dark:text-neutral-300 uppercase tracking-widest">{{ number_format($episode->views ?? 0) }} Views</span>
                            </div>
                        </div>
                    </header>

                    {{-- MEDIA HERO AREA (Image Only - UX Best Practice) --}}
                    <div class="mb-12 group">
                        <div class="relative aspect-video rounded-3xl overflow-hidden bg-neutral-100 dark:bg-[#121212] border border-neutral-200 dark:border-neutral-800 shadow-2xl transition-all duration-500">
                            <img src="{{ $episode->img ? asset('storage/' . $episode->img) : asset('images/default-news.jpg') }}" 
                                 alt="{{ $episode->title }}" 
                                 class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                 onerror="this.src='https://images.unsplash.com/photo-1504711434969-e33886168f5c?q=80&w=1200&auto=format&fit=crop'">
                            {{-- Visual Badge for Video if available --}}
                            @if($episode->link)
                                <div class="absolute top-6 right-6 z-20">
                                    <div class="bg-red-600/90 backdrop-blur-md text-white px-4 py-2 rounded-2xl flex items-center gap-2 shadow-xl border border-red-500">
                                        <svg class="w-4 h-4 fill-current animate-pulse" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                        <span class="text-[10px] font-black uppercase tracking-widest">Video Tersedia</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        {{-- Caption & Credit --}}
                        @if($episode->image_caption || $episode->image_source)
                        <div class="mt-5 flex flex-col sm:flex-row justify-between items-start gap-3 px-2">
                            <div class="flex items-start gap-3 flex-1">
                                <div class="w-1 h-10 bg-red-600 shrink-0"></div>
                                <p class="text-xs text-neutral-500 dark:text-neutral-400 italic leading-relaxed">{{ $episode->image_caption ?? $episode->title }}</p>
                            </div>
                            @if($episode->image_source)
                            <div class="bg-neutral-100 dark:bg-[#1a1a1a] border border-neutral-200 dark:border-neutral-800 px-3 py-1.5 rounded-lg shrink-0">
                                <span class="text-[9px] font-black text-neutral-400 uppercase tracking-[0.2em]">Kredit: {{ $episode->image_source }}</span>
                            </div>
                            @endif
                        </div>
                        @endif
                    </div>

                    {{-- ARTICLE BODY --}}
                    <div class="prose prose-lg dark:prose-invert max-w-none transition-all duration-300
                        prose-p:text-neutral-700 dark:prose-p:text-neutral-300 prose-p:leading-[1.9] prose-p:mb-8
                        prose-headings:text-neutral-900 dark:prose-headings:text-white prose-headings:font-black prose-headings:tracking-tighter
                        prose-a:text-red-600 dark:prose-a:text-red-500 prose-a:font-black prose-a:no-underline hover:prose-a:underline
                        prose-img:rounded-3xl prose-img:shadow-2xl
                        prose-blockquote:border-l-4 prose-blockquote:border-red-600 prose-blockquote:bg-neutral-50 dark:prose-blockquote:bg-[#121212] prose-blockquote:py-4 prose-blockquote:px-10 prose-blockquote:rounded-r-3xl prose-blockquote:not-italic prose-blockquote:text-neutral-600 dark:prose-blockquote:text-neutral-400 prose-blockquote:font-bold prose-blockquote:italic">
                        {!! $episode->content !!}
                    </div>

                    {{-- VIDEO PLAYER AT THE BOTTOM (Post-Narrative Discovery) --}}
                    @if(isset($videoData) && $videoData['platform'] === 'youtube' && $videoData['id'])
                    <div class="mt-16 mb-12 p-1 bg-neutral-900 dark:bg-[#1a1a1a] rounded-[2.5rem] shadow-2xl overflow-hidden group">
                        <div class="p-8 md:p-10 flex flex-col md:flex-row items-center justify-between gap-6 border-b border-white/5">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-red-600 flex items-center justify-center text-white shadow-lg shadow-red-900/40">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                </div>
                                <div class="flex flex-col">
                                    <h4 class="text-white font-black uppercase tracking-tighter italic text-xl">Simak Diskusi Lengkapnya</h4>
                                    <p class="text-neutral-400 text-xs font-bold uppercase tracking-widest">Teman Cerita Digital Channel</p>
                                </div>
                            </div>
                            <a href="{{ $episode->link }}" target="_blank" class="text-white/50 hover:text-red-500 transition-colors">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                            </a>
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
                    @elseif($episode->link)
                    {{-- Fallback link jika platform tidak terdeteksi untuk embed --}}
                    <div class="mt-16 p-8 bg-neutral-100 dark:bg-[#1a1a1a] rounded-3xl border-2 border-dashed border-neutral-300 dark:border-neutral-800 text-center">
                        <h4 class="font-black uppercase tracking-tighter text-lg mb-4 dark:text-white">Tonton Video Terkait Cerita Ini</h4>
                        <a href="{{ $episode->link }}" target="_blank" class="inline-flex items-center gap-3 bg-red-600 text-white px-8 py-4 rounded-2xl font-black uppercase text-xs tracking-widest hover:bg-red-700 transition-all shadow-xl">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                            Buka di YouTube
                        </a>
                    </div>
                    @endif

                    {{-- TAGS CLOUD --}}
                    @if($episode->tags && $episode->tags->count() > 0)
                    <div class="mt-16 flex flex-wrap gap-2 pt-10 border-t border-neutral-200 dark:border-neutral-800">
                        <span class="text-[10px] font-black text-neutral-400 uppercase tracking-widest w-full mb-2">Topik Terkait</span>
                        @foreach($episode->tags as $tag)
                            <a href="{{ route('tag.show', $tag->slug) }}" class="px-5 py-2 bg-white dark:bg-[#1a1a1a] text-neutral-600 dark:text-neutral-300 text-[11px] font-black uppercase tracking-widest rounded-full hover:bg-red-600 hover:text-white hover:border-red-600 transition-all border border-neutral-200 dark:border-neutral-800 shadow-sm">
                                #{{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                    @endif

                    {{-- PROFESSIONAL ENGAGEMENT CARD --}}
                    <div class="mt-16 p-8 md:p-12 rounded-[2rem] bg-neutral-900 dark:bg-[#121212] text-white flex flex-col lg:flex-row items-center justify-between gap-10 shadow-2xl relative overflow-hidden border border-neutral-800">
                        <div class="absolute top-0 right-0 w-96 h-96 bg-red-600/10 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/2"></div>
                        
                        <div class="relative z-10 text-center lg:text-left max-w-md">
                            <h4 class="text-2xl md:text-3xl font-black mb-3 italic tracking-tighter uppercase leading-none">Aspirasi Anda Berharga</h4>
                            <p class="text-neutral-400 text-sm leading-relaxed">Bantu kami menjangkau lebih banyak orang dengan membagikan informasi ini ke komunitas Anda.</p>
                        </div>

                        <div class="relative z-10 flex flex-wrap justify-center gap-4" x-data="{ 
                            copied: false,
                            copyToClipboard() {
                                if (navigator.clipboard) {
                                    navigator.clipboard.writeText(window.location.href);
                                } else {
                                    const el = document.createElement('textarea');
                                    el.value = window.location.href;
                                    document.body.appendChild(el);
                                    el.select();
                                    document.execCommand('copy');
                                    document.body.removeChild(el);
                                }
                                this.copied = true;
                                setTimeout(() => this.copied = false, 2000);
                            }
                        }">
                            {{-- WhatsApp --}}
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($episode->title . ' - Baca lengkap di: ' . url()->current()) }}" 
                               target="_blank" class="w-14 h-14 rounded-2xl bg-green-600 flex items-center justify-center hover:scale-110 transition-all shadow-xl group" title="WhatsApp">
                                <svg class="w-7 h-7 fill-current text-white" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                            </a>

                            {{-- Facebook --}}
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                               target="_blank" class="w-14 h-14 rounded-2xl bg-blue-700 flex items-center justify-center hover:scale-110 transition-all shadow-xl" title="Facebook">
                                <svg class="w-7 h-7 fill-current text-white" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>

                            {{-- X (Twitter) --}}
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($episode->title) }}" 
                               target="_blank" class="w-14 h-14 rounded-2xl bg-black border border-neutral-800 flex items-center justify-center hover:scale-110 transition-all shadow-xl" title="X">
                                <svg class="w-6 h-6 fill-current text-white" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            </a>

                            {{-- Copy Link Cerdas --}}
                            <button @click="copyToClipboard()" 
                                    class="flex items-center gap-3 px-6 rounded-2xl border transition-all shadow-xl min-h-[56px]"
                                    :class="copied ? 'bg-green-600 border-green-500 text-white' : 'bg-white/10 border-white/20 text-white hover:bg-white/20'">
                                <svg x-show="!copied" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                                <svg x-show="copied" class="w-5 h-5 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M5 13l4 4L19 7" /></svg>
                                <span class="text-[11px] font-black uppercase tracking-[0.2em]" x-text="copied ? 'Berhasil!' : 'Salin Link'"></span>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- RIGHT SIDE: Professional Sidebar --}}
                <div class="lg:col-span-4 lg:sticky lg:top-28 max-h-[calc(100vh-140px)] overflow-y-auto no-scrollbar pb-10">
                    <div class="space-y-12">
                        
                        {{-- Narasumber Profil --}}
                        @if($episode->speakers && $episode->speakers->count() > 0)
                        <div class="bg-white dark:bg-[#121212] border border-neutral-200 dark:border-neutral-800 p-8 rounded-[2rem] shadow-sm transition-colors overflow-hidden relative">
                            <h3 class="text-[10px] font-black text-neutral-900 dark:text-white mb-8 flex items-center gap-3 border-b border-neutral-100 dark:border-neutral-800 pb-5 uppercase tracking-[0.4em]">
                                <span class="w-2.5 h-2.5 bg-red-600 rounded-full"></span>
                                NARASUMBER
                            </h3>
                            <div class="space-y-10">
                                @foreach($episode->speakers as $speaker)
                                <div class="group flex flex-col gap-5">
                                    <div class="flex items-center gap-5">
                                        <div class="relative shrink-0">
                                            <div class="absolute inset-0 bg-red-600 rounded-2xl rotate-6 group-hover:rotate-0 transition-transform duration-300"></div>
                                            @if($speaker->photo)
                                                <img src="{{ asset('storage/' . $speaker->photo) }}" class="relative w-16 h-16 rounded-2xl object-cover border-2 border-white dark:border-neutral-800 shadow-md">
                                            @else
                                                <div class="relative w-16 h-16 rounded-2xl bg-neutral-100 dark:bg-[#1a1a1a] flex items-center justify-center border-2 border-white dark:border-neutral-800 shadow-md">
                                                    <svg class="w-8 h-8 text-neutral-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex flex-col">
                                            <h4 class="text-sm font-black text-neutral-900 dark:text-white group-hover:text-red-600 transition-colors uppercase tracking-tight italic">{{ $speaker->name }}</h4>
                                            <p class="text-[10px] text-red-600 font-black uppercase tracking-widest mt-1">{{ $speaker->profession }}</p>
                                        </div>
                                    </div>
                                    @if($speaker->bio)
                                        <div class="relative">
                                            <svg class="absolute -top-2 -left-2 w-6 h-6 text-neutral-100 dark:text-neutral-800 opacity-50" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017V14C19.017 11.7909 17.2261 10 15.017 10H14.017V8H15.017C18.3307 8 21.017 10.6863 21.017 14V21H14.017ZM3.017 21L3.017 18C3.017 16.8954 3.91243 16 5.017 16H8.017V14C8.017 11.7909 6.22612 10 4.017 10H3.017V8H4.017C7.33072 8 10.017 10.6863 10.017 14V21H3.017Z"/></svg>
                                            <p class="text-[11px] text-neutral-500 dark:text-neutral-400 leading-relaxed pl-5 line-clamp-4 italic">
                                                {{ $speaker->bio }}
                                            </p>
                                        </div>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        {{-- Baca Juga (Related News) --}}
                        @if(isset($relatedEpisodes) && $relatedEpisodes->count() > 0)
                        <div class="space-y-6">
                            <h3 class="text-[10px] font-black text-neutral-900 dark:text-white flex items-center gap-3 border-b border-neutral-100 dark:border-neutral-800 pb-5 uppercase tracking-[0.4em]">
                                <span class="w-2.5 h-2.5 bg-red-600 rounded-full"></span>
                                BACA JUGA
                            </h3>
                            <div class="grid gap-6">
                                @foreach($relatedEpisodes as $related)
                                <a href="{{ route('episode.show', $related->slug) }}" class="group flex gap-4 items-start">
                                    <div class="w-28 h-20 shrink-0 rounded-2xl overflow-hidden bg-neutral-100 dark:bg-[#1a1a1a] border border-neutral-200 dark:border-neutral-800 shadow-sm relative">
                                        <img src="{{ $related->img ? asset('storage/' . $related->img) : asset('images/placeholder.jpg') }}" 
                                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                             onerror="this.src='https://images.unsplash.com/photo-1585829365234-78d9b8129f17?q=80&w=300&auto=format&fit=crop'">
                                        @if($related->type !== 'article')
                                            <div class="absolute inset-0 flex items-center justify-center bg-black/20">
                                                <div class="w-6 h-6 bg-red-600 text-white rounded-full flex items-center justify-center shadow-lg"><svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg></div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex flex-col">
                                        <h4 class="text-xs font-black text-neutral-900 dark:text-white leading-snug line-clamp-2 group-hover:text-red-600 transition-colors uppercase tracking-tight italic">
                                            {{ $related->title }}
                                        </h4>
                                        <p class="text-[9px] text-neutral-500 font-bold uppercase tracking-widest mt-2">{{ $related->published_at ? $related->published_at->format('d M Y') : $related->created_at->format('d M Y') }}</p>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        {{-- Sidebar CTA --}}
                        <div class="bg-red-600 rounded-[2.5rem] p-10 text-white relative overflow-hidden group shadow-2xl">
                            <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 group-hover:scale-150 transition-transform duration-700"></div>
                            <h4 class="text-2xl font-black mb-4 relative z-10 italic uppercase tracking-tighter leading-none">Punya Info Menarik?</h4>
                            <p class="text-white/80 text-[11px] mb-8 relative z-10 leading-relaxed font-bold uppercase tracking-wider">Kirimkan rilis berita, opini, atau informasi publik NTT kepada redaksi kami.</p>
                            <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}" target="_blank" class="inline-block w-full text-center bg-white text-red-600 py-4 rounded-2xl font-black uppercase text-[11px] tracking-[0.2em] hover:shadow-xl hover:-translate-y-1 transition-all relative z-10">Hubungi Redaksi</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </article>

    {{-- BOTTOM GRID (Rekomendasi Berita Lainnya) --}}
    <section class="py-24 bg-neutral-50 dark:bg-[#0f0f0f] border-t border-neutral-200 dark:border-neutral-800 transition-colors duration-300">
        <div class="max-w-[1440px] mx-auto px-4 sm:px-6">
            <div class="flex items-center justify-between border-b-2 border-neutral-200 dark:border-neutral-800 pb-5 mb-12">
                <div class="flex items-center gap-4">
                    <span class="w-5 h-5 bg-red-600 rounded-full"></span>
                    <h2 class="text-3xl font-black text-neutral-900 dark:text-white uppercase tracking-tighter italic leading-none">REKOMENDASI</h2>
                </div>
                <a href="{{ route('home') }}" class="text-[10px] font-black text-red-600 uppercase tracking-[0.3em] hover:text-neutral-900 dark:hover:text-white transition-colors flex items-center gap-2 group">
                    INDERS BERITA 
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @php $bottomItems = isset($latestEpisodes) ? $latestEpisodes->take(4) : (isset($relatedEpisodes) ? $relatedEpisodes->take(4) : []); @endphp
                @foreach($bottomItems as $bottom)
                <a href="{{ route('episode.show', $bottom->slug) }}" class="group block bg-white dark:bg-[#121212] border border-neutral-200 dark:border-neutral-800 rounded-[2rem] overflow-hidden hover:shadow-2xl transition-all h-full">
                    <div class="aspect-[16/10] overflow-hidden bg-neutral-100 dark:bg-[#1a1a1a] relative">
                        <img src="{{ $bottom->img ? asset('storage/' . $bottom->img) : asset('images/default.jpg') }}" 
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                             onerror="this.src='https://images.unsplash.com/photo-1585829365234-78d9b8129f17?q=80&w=400&auto=format&fit=crop'">
                        <div class="absolute top-4 left-4 bg-red-600 text-white text-[9px] font-black px-3 py-1 rounded uppercase tracking-[0.2em] shadow-lg">
                            {{ $bottom->category->name ?? 'Update' }}
                        </div>
                    </div>
                    <div class="p-8 flex flex-col justify-between h-auto">
                        <h5 class="font-black text-sm text-neutral-900 dark:text-white group-hover:text-red-600 transition-colors line-clamp-2 uppercase tracking-tight italic mb-6 leading-snug">
                            {{ $bottom->title }}
                        </h5>
                        <div class="flex items-center justify-between text-[9px] font-black text-neutral-400 uppercase tracking-widest border-t border-neutral-100 dark:border-neutral-800 pt-5">
                            <span>{{ $bottom->published_at ? $bottom->published_at->format('d M Y') : $bottom->created_at->format('d M Y') }}</span>
                            <span class="text-red-600">Selengkapnya</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
</x-layouts.app>