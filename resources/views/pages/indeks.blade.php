@php
$settings = $settings ?? [];
$date = $date ?? now()->format('Y-m-d');
@endphp

<x-layouts.app :settings="$settings">
    @slot('title', 'Indeks Berita ' . \Carbon\Carbon::parse($date)->translatedFormat('d F Y') . ' | ' . ($settings['site_name'] ?? 'Highlight NTT'))

    <div class="px-4 sm:px-6 lg:px-8 py-10 sm:py-16">

        {{-- Header Indeks --}}
        <header class="mb-10 sm:mb-16 border-b border-neutral-200 dark:border-neutral-800 pb-8 sm:pb-12">
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-8">
                <div class="max-w-3xl">
                    <span class="inline-flex items-center gap-2 bg-red-600 text-white text-[10px] font-black px-3 py-1 rounded-sm uppercase tracking-widest mb-6 shadow-lg shadow-red-900/20">
                        <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span>
                        Arsip Digital
                    </span>
                    <h1 class="text-4xl sm:text-5xl md:text-6xl font-black text-neutral-900 dark:text-white tracking-tighter uppercase italic leading-[1.1] mb-6 transition-colors">
                        Indeks <span class="text-red-600">/</span> Berita
                    </h1>
                    <p class="text-sm sm:text-base font-bold text-neutral-500 dark:text-neutral-400 uppercase tracking-widest italic border-l-4 border-neutral-200 dark:border-neutral-800 pl-4">
                        Menampilkan arsip yang terbit pada <span class="text-neutral-900 dark:text-white">{{ \Carbon\Carbon::parse($date)->translatedFormat('d F Y') }}</span>
                    </p>
                </div>

                {{-- Filter Kalender Modern --}}
                <div class="w-full lg:w-auto bg-white dark:bg-[#121212] p-5 rounded-3xl border border-neutral-200 dark:border-neutral-800 shadow-xl shadow-neutral-200/50 dark:shadow-none shrink-0 transition-all">
                    <form action="{{ route('indeks') }}" method="GET" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
                        <div class="flex flex-col flex-1 min-w-[200px]">
                            <label class="text-[10px] font-black uppercase text-neutral-400 dark:text-neutral-500 tracking-widest mb-1.5 ml-1">Pilih Tanggal Arsip</label>
                            <div class="relative">
                                <input type="date" name="date" value="{{ $date }}"
                                    class="w-full bg-neutral-50 dark:bg-[#1a1a1a] border border-neutral-200 dark:border-neutral-700 px-4 py-3 rounded-xl text-sm font-black uppercase tracking-wider text-neutral-900 dark:text-white outline-none focus:border-red-600 transition-colors">
                            </div>
                        </div>
                        <button type="submit" class="bg-red-600 text-white px-6 py-4 sm:py-3 rounded-xl hover:bg-red-700 transition-all shadow-lg shadow-red-900/20 flex items-center justify-center gap-2 group mt-auto">
                            <span class="text-[11px] font-black uppercase tracking-widest sm:hidden">Cari Berita</span>
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        {{-- Daftar Berita --}}
        @if($posts->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-10">
            @foreach($posts as $ep)
            <article class="group">
                <a href="{{ route('post.show', $ep->slug) }}" class="flex flex-col sm:flex-row gap-5 sm:gap-6 bg-white dark:bg-[#121212] p-4 sm:p-5 rounded-[2rem] border border-neutral-100 dark:border-neutral-800/50 hover:border-red-600/30 transition-all duration-500 shadow-sm hover:shadow-2xl hover:-translate-y-1">

                    {{-- Image Container --}}
                    <div class="w-full sm:w-52 aspect-video sm:aspect-square shrink-0 rounded-2xl overflow-hidden bg-neutral-100 dark:bg-[#1a1a1a] relative shadow-inner">
                        <img src="{{ $ep->img ? asset('storage/' . $ep->img) : asset('images/placeholder.jpg') }}"
                            alt="{{ $ep->title }}"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            onerror="this.src='https://images.unsplash.com/photo-1585829365234-78d9b8129f17?q=80&w=400&auto=format&fit=crop'">

                        {{-- Overlay jam tayang di gambar (Mobile only) --}}
                        <div class="absolute bottom-2 right-2 bg-black/60 backdrop-blur-md text-[8px] font-black text-white px-2 py-1 rounded-sm uppercase tracking-widest sm:hidden">
                            {{ $ep->published_at->format('H:i') }} WITA
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="flex flex-col justify-between py-1">
                        <div>
                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-[10px] font-black text-red-600 uppercase tracking-widest">{{ $ep->category->name ?? 'Update' }}</span>
                                <span class="w-1 h-1 bg-neutral-300 dark:bg-neutral-700 rounded-full"></span>
                                <span class="hidden sm:inline text-[10px] font-black text-neutral-400 uppercase tracking-widest">{{ $ep->published_at->format('H:i') }} WITA</span>
                            </div>
                            <h3 class="text-lg sm:text-xl font-extrabold text-neutral-900 dark:text-white group-hover:text-red-600 transition-colors leading-[1.3] uppercase italic mb-4 line-clamp-3">
                                {{ $ep->title }}
                            </h3>
                        </div>
                        <div class="flex items-center justify-between mt-auto">
                            <p class="text-[10px] text-neutral-500 font-black uppercase tracking-tighter">Oleh <span class="text-neutral-900 dark:text-neutral-300">{{ $ep->author->name ?? 'Redaksi' }}</span></p>
                            <span class="text-red-600 opacity-0 group-hover:opacity-100 transition-opacity transform translate-x-2 group-hover:translate-x-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                                    <path d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>
            </article>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-16 sm:mt-24 flex justify-center">
            <div class="w-full max-w-full overflow-x-auto pb-4 custom-pagination">
                {{ $posts->links() }}
            </div>
        </div>

        @else
        {{-- Empty State (Gaya Lebih Menarik) --}}
        <div class="py-24 sm:py-32 text-center bg-white dark:bg-neutral-900/30 rounded-[3rem] border-2 border-dashed border-neutral-200 dark:border-neutral-800 px-6">
            <div class="w-20 h-20 bg-neutral-100 dark:bg-neutral-800 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-neutral-400 dark:text-neutral-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                </svg>
            </div>
            <h2 class="text-2xl sm:text-3xl font-black text-neutral-900 dark:text-white uppercase italic tracking-tighter mb-3">Arsip Tidak Ditemukan</h2>
            <p class="text-neutral-500 dark:text-neutral-400 font-bold uppercase tracking-widest text-[10px] sm:text-xs max-w-md mx-auto leading-relaxed">
                Maaf, belum ada berita yang diterbitkan pada tanggal ini. Silakan pilih tanggal lain melalui kalender di atas.
            </p>
        </div>
        @endif
    </div>

    <style>
        /* Custom Styling for Pagination agar selaras dengan tema Red/Dark */
        .custom-pagination nav svg {
            @apply w-5 h-5;
        }

        .custom-pagination nav span[aria-current="page"] span {
            @apply bg-red-600 border-red-600 text-white font-black;
        }

        .custom-pagination nav a {
            @apply font-black text-neutral-500 dark:text-neutral-400 transition-colors hover:text-red-600 dark:hover:text-red-500;
        }
    </style>
</x-layouts.app>