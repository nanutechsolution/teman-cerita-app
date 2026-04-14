<x-layouts.app :settings="$settings">
    @slot('title', 'Topik: #' . $tag->name . ' | ' . ($settings['site_name'] ?? 'Teman Cerita NTT'))

    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 pt-5">
        
        <div class="mb-12 text-center">
            <span class="inline-block bg-neutral-100 dark:bg-[#1a1a1a] text-neutral-500 text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-widest mb-4 border border-neutral-200 dark:border-neutral-800">
                Jelajahi Topik
            </span>
            <h1 class="text-4xl md:text-6xl font-black text-neutral-900 dark:text-white tracking-tighter italic">
                #{{ $tag->name }}
            </h1>
        </div>

        @if($episodes->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($episodes as $ep)
                    <article class="group relative flex flex-col">
                        <div class="aspect-video rounded-xl overflow-hidden mb-4 border border-neutral-200 dark:border-neutral-800">
                            <img src="{{ $ep->img ? asset('storage/' . $ep->img) : 'https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80' }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                        </div>
                        <div class="space-y-2">
                            <div class="flex items-center gap-2 text-[10px] font-black text-red-600 uppercase tracking-widest">
                                <span>{{ $ep->category->name ?? 'Update' }}</span>
                                <span class="text-neutral-300 dark:text-neutral-700">•</span>
                                <span class="text-neutral-500">{{ $ep->published_at->format('d M Y') }}</span>
                            </div>
                            <h2 class="text-xl font-bold text-neutral-900 dark:text-white leading-tight group-hover:text-red-600 transition-colors">
                                <a href="{{ route('episode.show', $ep->slug) }}">{{ $ep->title }}</a>
                            </h2>
                            <p class="text-sm text-neutral-600 dark:text-neutral-400 line-clamp-2 leading-relaxed">
                                {{ $ep->excerpt }}
                            </p>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-16">
                {{ $episodes->links() }}
            </div>

            {{-- Share & Support Section --}}
            <div class="mt-20 p-8 md:p-10 rounded-3xl bg-neutral-900 text-white flex flex-col lg:flex-row items-center justify-between gap-8 shadow-2xl relative overflow-hidden">
                {{-- Decorative Background --}}
                <div class="absolute top-0 right-0 w-64 h-64 bg-red-600/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
                
                <div class="relative z-10 text-center lg:text-left">
                    <h4 class="text-2xl font-black mb-2 italic tracking-tight uppercase">Dukung Jurnalisme Independen</h4>
                    <p class="text-neutral-400 text-sm max-w-md">Bagikan topik <strong>#{{ $tag->name }}</strong> ini agar lebih banyak suara dan aspirasi dari NTT yang terdengar luas.</p>
                </div>

                <div class="relative z-10 flex flex-wrap justify-center gap-4" x-data="{ 
                    copied: false,
                    copyToClipboard() {
                        const el = document.createElement('textarea');
                        el.value = window.location.href;
                        document.body.appendChild(el);
                        el.select();
                        document.execCommand('copy');
                        document.body.removeChild(el);
                        this.copied = true;
                        setTimeout(() => this.copied = false, 2000);
                    }
                }">
                    {{-- WhatsApp --}}
                    <a href="https://api.whatsapp.com/send?text={{ urlencode('Cek kumpulan berita menarik tentang #' . $tag->name . ' di Teman Cerita NTT: ' . url()->current()) }}" 
                       target="_blank" 
                       class="w-12 h-12 rounded-full bg-green-600 flex items-center justify-center hover:scale-110 transition-all shadow-lg"
                       title="Bagikan ke WhatsApp">
                        <svg class="w-6 h-6 fill-current text-white" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    </a>

                    {{-- Facebook --}}
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                       target="_blank" 
                       class="w-12 h-12 rounded-full bg-blue-700 flex items-center justify-center hover:scale-110 transition-all shadow-lg"
                       title="Bagikan ke Facebook">
                        <svg class="w-6 h-6 fill-current text-white" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>

                    {{-- X (Twitter) --}}
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode('Jelajahi berita tentang #' . $tag->name . ' di Teman Cerita NTT.') }}" 
                       target="_blank" 
                       class="w-12 h-12 rounded-full bg-black border border-neutral-700 flex items-center justify-center hover:scale-110 transition-all shadow-lg"
                       title="Bagikan ke X">
                        <svg class="w-5 h-5 fill-current text-white" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>

                    {{-- Copy Link --}}
                    <button @click="copyToClipboard()" 
                            class="group relative flex items-center gap-2 bg-white/10 hover:bg-white/20 px-5 rounded-full border border-white/20 transition-all shadow-lg"
                            title="Salin Tautan">
                        <span class="w-12 h-12 flex items-center justify-center -ml-5">
                            <svg x-show="!copied" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                            <svg x-show="copied" class="w-5 h-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" x-cloak><path d="M5 13l4 4L19 7" /></svg>
                        </span>
                        <span class="text-sm font-bold uppercase tracking-wider pr-1" x-text="copied ? 'Tersalin!' : 'Salin Link'"></span>
                    </button>
                </div>
            </div>
        @else
            <div class="py-20 text-center">
                <p class="text-neutral-500">Tidak ada konten dengan tagar ini.</p>
            </div>
        @endif
    </div>
</x-layouts.app>