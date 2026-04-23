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

        @if($posts->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($posts as $ep)
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
                                <a href="{{ route('post.show', $ep->slug) }}">{{ $ep->title }}</a>
                            </h2>
                            <p class="text-sm text-neutral-600 dark:text-neutral-400 line-clamp-2 leading-relaxed">
                                {{ $ep->excerpt }}
                            </p>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-16">
                {{ $posts->links() }}
            </div>
        @else
            <div class="py-20 text-center">
                <p class="text-neutral-500">Tidak ada konten dengan tagar ini.</p>
            </div>
        @endif
    </div>
</x-layouts.app>