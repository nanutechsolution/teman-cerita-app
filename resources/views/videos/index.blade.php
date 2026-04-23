<x-layouts.app :settings="$settings ?? null">
    {{-- Wrapper utama dengan Alpine.js untuk fitur Modal Video --}}
    <div x-data="{ showModal: false, activeVideo: null }" class="min-h-screen bg-neutral-50 dark:bg-black py-12 sm:py-16 relative overflow-hidden transition-colors duration-300">

        {{-- Efek Glow Latar Belakang --}}
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[80%] h-[500px] bg-red-600/10 blur-[150px] rounded-full pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            {{-- Bagian Header Halaman --}}
            <div class="flex items-center gap-4 border-b-[3px] border-neutral-200 dark:border-neutral-800 pb-4 mb-10 sm:mb-14">
                <div class="w-4 h-4 bg-red-600 rounded-full animate-pulse shadow-[0_0_15px_rgba(220,38,38,0.8)]"></div>
                <h1 class="text-3xl sm:text-5xl font-black text-neutral-900 dark:text-white uppercase tracking-tighter">
                    Galeri Video
                </h1>
            </div>

            {{-- Cek apakah ada data video --}}
            @if(isset($videos) && $videos->count() > 0)
            {{-- Grid Daftar Video --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 sm:gap-8">
                @foreach($videos as $video)
                @php
                // Logika untuk mengubah Link YouTube biasa menjadi Link Embed (agar bisa diputar di iFrame)
                $embedUrl = $video->link;
                $hasVideoUrl = !empty($embedUrl);

                if ($hasVideoUrl && str_contains($embedUrl, 'youtube.com/watch')) {
                preg_match('/v=([^&]+)/', $embedUrl, $matches);
                if (!empty($matches[1])) {
                $embedUrl = "https://www.youtube.com/embed/" . $matches[1] . "?autoplay=1";
                }
                } elseif ($hasVideoUrl && str_contains($embedUrl, 'youtu.be/')) {
                $videoId = basename(parse_url($embedUrl, PHP_URL_PATH));
                if ($videoId) {
                $embedUrl = "https://www.youtube.com/embed/" . $videoId . "?autoplay=1";
                }
                }
                @endphp

                {{-- Card Video. Jika ada URL video, buka modal. Jika tidak, ke halaman detail. --}}
                <a href="{{ route('post.show', $video->slug) }}"
                    @if($hasVideoUrl)
                    @click.prevent="showModal = true; activeVideo = '{{ $embedUrl }}'"
                    @endif
                    class="group flex flex-col gap-4 rounded-2xl hover:bg-neutral-100 dark:hover:bg-white/[0.02] p-3 -m-3 transition-all duration-300 border border-transparent hover:border-neutral-200 dark:hover:border-neutral-800 cursor-pointer">

                    {{-- Wadah Thumbnail --}}
                    <div class="w-full aspect-video relative overflow-hidden bg-neutral-200 dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-md dark:shadow-xl">
                        <img src="{{ $video->img ? asset('storage/' . $video->img) : 'https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?q=80&w=600' }}"
                            alt="{{ $video->title }}"
                            class="w-full h-full object-cover opacity-80 dark:opacity-70 group-hover:scale-110 group-hover:opacity-100 transition-all duration-700 ease-out">

                        {{-- Ikon Play di Tengah --}}
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-12 h-12 bg-red-600/90 rounded-full flex items-center justify-center backdrop-blur-sm group-hover:bg-red-500 group-hover:scale-110 transition-all duration-300 shadow-lg shadow-red-600/40">
                                <svg class="w-5 h-5 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z" />
                                </svg>
                            </div>
                        </div>

                        {{-- Durasi (Jika ada) --}}
                        @if($video->duration)
                        <div class="absolute bottom-2 right-2 bg-black/80 text-white text-[10px] font-bold px-2 py-1 rounded-md backdrop-blur-md border border-neutral-700/50">
                            {{ $video->duration }}
                        </div>
                        @endif

                        {{-- Badge Tipe Konten --}}
                        @if($video->type === 'short')
                        <div class="absolute top-2 left-2 bg-red-600 text-white text-[9px] font-black px-2 py-1 uppercase tracking-wider rounded-sm shadow-md">
                            Shorts
                        </div>
                        @endif
                    </div>

                    {{-- Teks & Info Video --}}
                    <div class="flex flex-col px-1">
                        <h3 class="text-base font-bold text-neutral-800 dark:text-neutral-300 group-hover:text-red-600 dark:group-hover:text-white leading-snug line-clamp-2 transition-colors">
                            {{ $video->title }}
                        </h3>

                        <div class="flex items-center gap-2 mt-3 text-[10px] text-neutral-500 font-bold uppercase tracking-widest">
                            <span>{{ $video->published_at ? \Carbon\Carbon::parse($video->published_at)->translatedFormat('d M Y') : 'Baru saja' }}</span>
                            <span class="w-1 h-1 bg-neutral-300 dark:bg-neutral-700 rounded-full"></span>
                            <span class="group-hover:text-neutral-700 dark:group-hover:text-neutral-400 transition-colors">{{ number_format($video->views ?? 0, 0, ',', '.') }} Tayangan</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            {{-- Navigasi Pagination --}}
            <div class="mt-16 sm:mt-20 flex justify-center border-t border-neutral-200 dark:border-neutral-800 pt-10">
                <div class="w-full max-w-full overflow-x-auto text-neutral-600 dark:text-neutral-400 pagination-custom">
                    {{ $videos->links() }}
                </div>
            </div>

            @else
            {{-- Tampilan Kosong Jika Belum Ada Video --}}
            <div class="flex flex-col items-center justify-center py-24 sm:py-32 px-4 bg-white dark:bg-neutral-900/20 rounded-3xl border border-neutral-200 dark:border-neutral-800 border-dashed relative shadow-sm dark:shadow-none">
                <div class="absolute inset-0 bg-gradient-to-b from-transparent to-neutral-50 dark:to-black/50 rounded-3xl"></div>
                <svg class="w-16 h-16 sm:w-20 sm:h-20 text-neutral-300 dark:text-neutral-700 mx-auto mb-6 relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
                <h3 class="text-xl sm:text-2xl font-black text-neutral-800 dark:text-neutral-400 relative z-10">BELUM ADA VIDEO</h3>
                <p class="text-sm sm:text-base text-neutral-500 dark:text-neutral-600 mt-2 text-center max-w-md relative z-10">Saat ini belum ada koleksi video yang diterbitkan. Nantikan tayangan menarik dari kami segera.</p>
            </div>
            @endif

        </div>

        {{-- MODAL PLAYER VIDEO (Alpine.js) - Tetap Gelap/Cinematic Mode --}}
        <div x-show="showModal"
            style="display: none;"
            class="fixed inset-0 z-[999] flex items-center justify-center bg-black/95 backdrop-blur-md"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">

            {{-- Tombol Close (Silang) --}}
            <button @click="showModal = false; activeVideo = null" class="absolute top-6 right-6 sm:top-10 sm:right-10 text-white hover:text-red-500 transition-colors z-[1000] drop-shadow-xl">
                <svg class="w-10 h-10 sm:w-12 sm:h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            {{-- Kontainer Iframe Video --}}
            <div @click.away="showModal = false; activeVideo = null"
                class="w-full max-w-5xl aspect-video bg-black rounded-2xl sm:rounded-3xl overflow-hidden shadow-[0_0_50px_rgba(220,38,38,0.15)] mx-4 relative border border-neutral-800"
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100">

                {{-- Gunakan <template> agar iframe hanya di-load saat modal dibuka --}}
                <template x-if="activeVideo">
                    <iframe :src="activeVideo" class="w-full h-full border-0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </template>
            </div>
        </div>

    </div>

    {{-- CSS Tambahan yang mendukung Light/Dark Mode --}}
    <style>
        .pagination-custom nav {
            @apply gap-2 flex-wrap;
        }

        .pagination-custom span[aria-current="page"] span {
            @apply bg-red-600 border-red-600 text-white font-bold;
        }

        .pagination-custom a {
            @apply bg-white dark:bg-neutral-900 border-neutral-200 dark:border-neutral-800 text-neutral-600 dark:text-neutral-400 hover:bg-neutral-100 dark:hover:bg-neutral-800 hover:text-neutral-900 dark:hover:text-white transition-colors shadow-sm dark:shadow-none;
        }

        .pagination-custom span[aria-disabled="true"] span {
            @apply bg-neutral-50 dark:bg-neutral-900/50 border-neutral-200 dark:border-neutral-800 text-neutral-400 dark:text-neutral-600 shadow-sm dark:shadow-none;
        }
    </style>
</x-layouts.app>