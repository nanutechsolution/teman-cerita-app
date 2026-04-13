<x-layouts.app :settings="$settings">
    @slot('title', 'Kategori: ' . $category->name . ' | ' . ($settings['site_name'] ?? 'Teman Cerita NTT'))

    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 pt-10 pb-20">
        
        {{-- Header Kategori --}}
        <div class="mb-12 border-l-4 border-red-600 pl-6">
            <p class="text-xs font-bold text-neutral-500 uppercase tracking-[0.2em] mb-2">Arsip Kategori</p>
            <h1 class="text-4xl md:text-5xl font-black text-neutral-900 dark:text-white uppercase tracking-tight">
                {{ $category->name }}
            </h1>
        </div>

        @if($episodes->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($episodes as $ep)
                    <a href="{{ route('episode.show', $ep->slug) }}" class="group flex flex-col bg-white dark:bg-[#121212] border border-neutral-200 dark:border-neutral-800 rounded-2xl overflow-hidden hover:border-red-600/30 transition-all h-full shadow-sm">
                        <div class="relative aspect-[16/10] overflow-hidden bg-neutral-100 dark:bg-[#1a1a1a]">
                            <img src="{{ $ep->img ? asset('storage/' . $ep->img) : asset('placeholder-news.jpg') }}" alt="{{ $ep->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            
                            @if($ep->type !== 'article' && $ep->duration)
                            <div class="absolute bottom-2 right-2 bg-black/80 text-white text-[10px] font-bold px-2 py-0.5 rounded">
                                {{ $ep->duration }}
                            </div>
                            @endif
                        </div>
                        
                        <div class="p-5 flex flex-col flex-grow">
                            <h3 class="text-lg font-bold text-neutral-900 dark:text-white line-clamp-3 leading-snug group-hover:text-red-600 transition-colors mb-4">
                                {{ $ep->title }}
                            </h3>
                            
                            <div class="mt-auto pt-4 border-t border-neutral-100 dark:border-neutral-800 flex items-center justify-between text-[11px] text-neutral-500 font-bold uppercase tracking-wider">
                                <span>{{ $ep->published_at->format('d M Y') }}</span>
                                <span class="text-red-600">Baca Selengkapnya</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-16">
                {{ $episodes->links() }}
            </div>
        @else
            <div class="py-20 text-center border-2 border-dashed border-neutral-200 dark:border-neutral-800 rounded-3xl">
                <p class="text-neutral-500 font-medium">Belum ada berita di kategori ini.</p>
                <a href="{{ route('home') }}" class="mt-4 inline-block text-red-600 font-bold hover:underline">Kembali ke Beranda</a>
            </div>
        @endif
    </div>
</x-layouts.app>