<x-layouts.app :settings="$settings">
    <div class="min-h-screen bg-black py-12 sm:py-16 relative overflow-hidden">
        {{-- Efek Glow Latar Belakang --}}
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[80%] h-[500px] bg-red-600/10 blur-[150px] rounded-full pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            {{-- Bagian Header Halaman --}}
            <div class="flex items-center gap-4 border-b-[3px] border-neutral-800 pb-4 mb-10 sm:mb-14">
                <div class="w-4 h-4 bg-red-600 rounded-full animate-pulse shadow-[0_0_15px_rgba(220,38,38,0.8)]"></div>
                <h1 class="text-3xl sm:text-5xl font-black text-white uppercase tracking-tighter">
                    Galeri Video
                </h1>
            </div>

            {{-- Cek apakah ada data video --}}
            @if($videos->count() > 0)
            {{-- Grid Daftar Video --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 sm:gap-8">
                @foreach($videos as $video)
                <a href="{{ route('post.show', $video->slug) }}" class="group flex flex-col gap-4 rounded-2xl hover:bg-white/[0.02] p-3 -m-3 transition-all duration-300 border border-transparent hover:border-neutral-800">

                    {{-- Wadah Thumbnail --}}
                    <div class="w-full aspect-video relative overflow-hidden bg-neutral-900 rounded-xl border border-neutral-800 shadow-xl">
                        <img src="{{ $video->img ? asset('storage/' . $video->img) : 'https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?q=80&w=600' }}"
                            alt="{{ $video->title }}"
                            class="w-full h-full object-cover opacity-70 group-hover:scale-110 group-hover:opacity-100 transition-all duration-700 ease-out">

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
                        <h3 class="text-base font-bold text-neutral-300 group-hover:text-white leading-snug line-clamp-2 transition-colors">
                            {{ $video->title }}
                        </h3>

                        <div class="flex items-center gap-2 mt-3 text-[10px] text-neutral-500 font-bold uppercase tracking-widest">
                            <span>{{ $video->published_at ? \Carbon\Carbon::parse($video->published_at)->translatedFormat('d M Y') : 'Baru saja' }}</span>
                            <span class="w-1 h-1 bg-neutral-700 rounded-full"></span>
                            <span class="group-hover:text-neutral-400 transition-colors">{{ number_format($video->views ?? 0, 0, ',', '.') }} Tayangan</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            {{-- Navigasi Pagination --}}
            <div class="mt-16 sm:mt-20 flex justify-center border-t border-neutral-800 pt-10">
                <div class="w-full max-w-full overflow-x-auto text-neutral-400 pagination-dark">
                    {{-- Pastikan kamu mem-publish vendor tailwind pagination jika ini terlihat berantakan di UI --}}
                    {{ $videos->links() }}
                </div>
            </div>

            @else
            {{-- Tampilan Kosong Jika Belum Ada Video --}}
            <div class="flex flex-col items-center justify-center py-24 sm:py-32 px-4 bg-neutral-900/20 rounded-3xl border border-neutral-800 border-dashed relative">
                <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/50 rounded-3xl"></div>
                <svg class="w-16 h-16 sm:w-20 sm:h-20 text-neutral-700 mx-auto mb-6 relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
                <h3 class="text-xl sm:text-2xl font-black text-neutral-400 relative z-10">BELUM ADA VIDEO</h3>
                <p class="text-sm sm:text-base text-neutral-600 mt-2 text-center max-w-md relative z-10">Saat ini belum ada koleksi video yang diterbitkan. Nantikan tayangan menarik dari kami segera.</p>
            </div>
            @endif

        </div>
    </div>

    {{-- CSS Tambahan Opsional untuk mempercantik warna pagination bawaan Laravel --}}
    <style>
        .pagination-dark nav {
            @apply gap-2 flex-wrap;
        }

        .pagination-dark span[aria-current="page"] span {
            @apply bg-red-600 border-red-600 text-white font-bold;
        }

        .pagination-dark a {
            @apply bg-neutral-900 border-neutral-800 text-neutral-400 hover:bg-neutral-800 hover:text-white transition-colors;
        }
    </style>

</x-layouts.app>