<x-layouts.app :settings="$settings">
    @slot('title', 'Hasil Pencarian: ' . $query . ' | ' . ($settings['site_name'] ?? 'Teman Cerita NTT'))

    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 pt-10 pb-20">
        
        <div class="max-w-2xl mb-12">
            <h1 class="text-2xl font-bold text-neutral-900 dark:text-white mb-2">
                Hasil pencarian untuk: <span class="text-red-600">"{{ $query }}"</span>
            </h1>
            <p class="text-neutral-500 text-sm">Ditemukan {{ $episodes->total() }} berita yang relevan.</p>
        </div>

        @if($episodes->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($episodes as $ep)
                    <a href="{{ route('episode.show', $ep->slug) }}" class="group flex flex-col sm:flex-row gap-5 bg-white dark:bg-[#121212] p-4 rounded-2xl border border-neutral-200 dark:border-neutral-800 hover:shadow-xl transition-all">
                        <div class="w-full sm:w-48 h-32 shrink-0 rounded-xl overflow-hidden bg-neutral-100 dark:bg-[#1a1a1a]">
                            <img src="{{ $ep->img ? asset('storage/' . $ep->img) : asset('placeholder-news.jpg') }}" class="w-full h-full object-cover">
                        </div>
                        <div class="flex flex-col justify-center">
                            <span class="text-[10px] font-bold text-red-600 uppercase tracking-widest mb-1">{{ $ep->category->name ?? 'Berita' }}</span>
                            <h3 class="text-lg font-bold text-neutral-900 dark:text-white group-hover:text-red-600 transition-colors leading-snug mb-2">{{ $ep->title }}</h3>
                            <p class="text-xs text-neutral-500 font-medium">{{ $ep->published_at->diffForHumans() }} • Oleh {{ $ep->author->name ?? 'Redaksi' }}</p>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $episodes->links() }}
            </div>
        @else
            <div class="py-20 text-center bg-neutral-100 dark:bg-[#121212] rounded-3xl border border-neutral-200 dark:border-neutral-800">
                <svg class="w-16 h-16 text-neutral-300 dark:text-neutral-700 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <h2 class="text-xl font-bold text-neutral-900 dark:text-white">Maaf, berita tidak ditemukan</h2>
                <p class="text-neutral-500 mt-2">Coba gunakan kata kunci lain atau periksa ejaan Anda.</p>
            </div>
        @endif
    </div>
</x-layouts.app>