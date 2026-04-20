<x-layouts.app :settings="$settings">
    @slot('title', 'Lensa Flobamora - Galeri Foto NTT')

    <div class="max-w-[1400px] mx-auto px-4 sm:px-8 py-12 sm:py-20">
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h1 class="text-4xl sm:text-6xl font-[1000] text-neutral-900 dark:text-white uppercase tracking-tight mb-6">
                Lensa <span class="text-red-600">Flobamora</span>
            </h1>
            <p class="text-neutral-500 dark:text-neutral-400 text-lg leading-relaxed">
                Kumpulan momen terbaik, keindahan alam, dan dinamika sosial masyarakat Nusa Tenggara Timur yang tertangkap dalam bingkai visual.
            </p>
        </div>

        <!-- Grid Galeri -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($galleries as $gallery)
            <a href="{{ route('gallery.show', $gallery->slug) }}" class="group flex flex-col h-full bg-white dark:bg-[#121212] rounded-3xl overflow-hidden border border-neutral-100 dark:border-neutral-800 shadow-sm hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                <div class="relative aspect-[4/5] overflow-hidden">
                    <img src="{{ $gallery->cover_image ? asset('storage/' . $gallery->cover_image) : 'https://images.unsplash.com/photo-1518002171953-a080ee817e1f?auto=format&fit=crop&w=600' }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-[1.5s]">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-60"></div>
                    <div class="absolute bottom-4 left-4 flex items-center gap-2 bg-red-600 text-white text-[10px] font-black px-3 py-1.5 rounded-full uppercase tracking-widest shadow-lg">
                        📸 {{ $gallery->images_count }} Foto
                    </div>
                </div>
                <div class="p-6 flex-1 flex flex-col">
                    <span class="text-[10px] font-black text-red-600 uppercase tracking-widest mb-3 block">
                        {{ $gallery->published_at->format('d M Y') }}
                    </span>
                    <h3 class="text-xl font-extrabold text-neutral-900 dark:text-white leading-tight group-hover:text-red-600 transition-colors line-clamp-3">
                        {{ $gallery->title }}
                    </h3>
                </div>
            </a>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-20">
            {{ $galleries->links() }}
        </div>
    </div>
</x-layouts.app>