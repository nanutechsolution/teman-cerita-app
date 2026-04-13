@php
    $settings = $settings ?? [];
    $date = $date ?? now()->format('Y-m-d');
@endphp

<x-layouts.app :settings="$settings">
    @slot('title', 'Indeks Berita ' . \Carbon\Carbon::parse($date)->translatedFormat('d F Y') . ' | ' . ($settings['site_name'] ?? 'Teman Cerita NTT'))

    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 pt-24 lg:pt-32 pb-20">
        
        {{-- Header Indeks --}}
        <header class="mb-12 border-b border-neutral-200 dark:border-neutral-800 pb-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-8">
                <div class="max-w-2xl">
                    <span class="inline-block bg-red-600 text-white text-[10px] font-black px-3 py-1 rounded-sm uppercase tracking-widest mb-6 shadow-lg shadow-red-900/20">Arsip Digital</span>
                    <h1 class="text-4xl md:text-6xl font-black text-neutral-900 dark:text-white tracking-tighter uppercase italic leading-none mb-4 transition-colors">
                        Indeks <span class="text-red-600 text-3xl md:text-5xl">/</span> Berita
                    </h1>
                    <p class="text-sm font-bold text-neutral-500 uppercase tracking-widest italic">Menampilkan berita yang terbit pada tanggal {{ \Carbon\Carbon::parse($date)->translatedFormat('d F Y') }}</p>
                </div>

                {{-- Filter Kalender --}}
                <div class="bg-neutral-100 dark:bg-[#121212] p-4 rounded-2xl border border-neutral-200 dark:border-neutral-800 shrink-0">
                    <form action="{{ route('indeks') }}" method="GET" class="flex items-center gap-3">
                        <div class="flex flex-col">
                            <label class="text-[9px] font-black uppercase text-neutral-400 tracking-widest mb-1">Pilih Tanggal</label>
                            <input type="date" name="date" value="{{ $date }}" class="bg-transparent text-sm font-black uppercase tracking-wider text-neutral-900 dark:text-white outline-none">
                        </div>
                        <button type="submit" class="bg-red-600 text-white p-3 rounded-xl hover:bg-red-700 transition-all shadow-lg shadow-red-900/20">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        {{-- Daftar Berita --}}
        @if($episodes->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($episodes as $ep)
                    <a href="{{ route('episode.show', $ep->slug) }}" class="group flex flex-col sm:flex-row gap-6 bg-white dark:bg-[#121212] p-5 rounded-3xl border border-neutral-200 dark:border-neutral-800 hover:border-red-600/30 transition-all shadow-sm hover:shadow-xl">
                        <div class="w-full sm:w-48 h-32 shrink-0 rounded-2xl overflow-hidden bg-neutral-100 dark:bg-[#1a1a1a]">
                            <img src="{{ $ep->img ? asset('storage/' . $ep->img) : asset('images/placeholder.jpg') }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" onerror="this.src='https://images.unsplash.com/photo-1585829365234-78d9b8129f17?q=80&w=300&auto=format&fit=crop'">
                        </div>
                        <div class="flex flex-col justify-center py-2">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-[9px] font-black text-red-600 uppercase tracking-widest">{{ $ep->category->name ?? 'Update' }}</span>
                                <span class="w-1 h-1 bg-neutral-300 rounded-full"></span>
                                <span class="text-[9px] font-black text-neutral-400 uppercase tracking-widest">{{ $ep->published_at->format('H:i') }} WITA</span>
                            </div>
                            <h3 class="text-lg font-black text-neutral-900 dark:text-white group-hover:text-red-600 transition-colors leading-tight uppercase italic mb-3">{{ $ep->title }}</h3>
                            <p class="text-xs text-neutral-500 font-bold uppercase tracking-tighter">Oleh {{ $ep->author->name ?? 'Redaksi' }}</p>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $episodes->links() }}
            </div>
        @else
            <div class="py-32 text-center bg-neutral-50 dark:bg-[#121212] rounded-[3rem] border border-dashed border-neutral-200 dark:border-neutral-800">
                <svg class="w-20 h-20 text-neutral-200 dark:text-neutral-800 mx-auto mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                <h2 class="text-2xl font-black text-neutral-900 dark:text-white uppercase italic tracking-tighter mb-2">Tidak Ada Berita</h2>
                <p class="text-neutral-500 font-bold uppercase tracking-widest text-xs">Maaf, belum ada berita yang diterbitkan pada tanggal ini.</p>
            </div>
        @endif
    </div>
</x-layouts.app>