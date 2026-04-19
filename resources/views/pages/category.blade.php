@php
$settings = $settings ?? [];
@endphp

<x-layouts.app :settings="$settings">
    {{-- SEO Title Dinamis berdasarkan nama Kategori --}}
    @slot('title', ($category->name ?? 'Rubrik') . ' | ' . ($settings['site_name'] ?? 'Highlight NTT'))

    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 pt-28 lg:pt-36 pb-20">

        <!-- ============================== -->
        <!-- HEADER KATEGORI                -->
        <!-- ============================== -->
        <header class="mb-10 lg:mb-16 relative">
            <!-- Breadcrumbs -->
            <nav class="flex flex-wrap items-center text-[10px] sm:text-[11px] font-bold uppercase tracking-widest text-neutral-500 mb-6">
                <a href="{{ route('home') }}" class="hover:text-red-600 transition-colors">Beranda</a>
                <span class="mx-2.5">/</span>
                <span class="text-neutral-400">Rubrik</span>
                <span class="mx-2.5">/</span>
                <span class="text-neutral-900 dark:text-white">{{ $category->name ?? 'Kategori' }}</span>
            </nav>

            <!-- Judul Kategori dengan Red Pillar Style -->
            <div class="flex items-center gap-4 sm:gap-5">
                <div class="w-1.5 sm:w-2 h-10 sm:h-14 bg-red-600 rounded-full"></div>
                <h1 class="text-4xl md:text-5xl lg:text-[64px] font-[1000] tracking-[-0.04em] uppercase text-neutral-900 dark:text-white leading-none drop-shadow-sm">
                    {{ $category->name ?? 'Nama Kategori' }}
                </h1>
            </div>

            <!-- Deskripsi Kategori (Opsional) -->
            @if(isset($category->description) && $category->description)
            <div class="mt-5 max-w-3xl ml-6 sm:ml-7">
                <p class="text-sm sm:text-base font-medium text-neutral-600 dark:text-neutral-400 leading-relaxed border-l-2 border-neutral-200 dark:border-neutral-800 pl-4">
                    {{ $category->description }}
                </p>
            </div>
            @endif
        </header>

        <!-- ============================== -->
        <!-- GRID KONTEN (8 Kiri / 4 Kanan) -->
        <!-- ============================== -->
        <div class="grid lg:grid-cols-12 gap-12 lg:gap-16">

            <!-- MAIN CONTENT: Daftar Berita -->
            <main class="lg:col-span-8">

                @if(isset($posts) && $posts->count() > 0)
                <!-- List Artikel Vertikal -->
                <div class="space-y-8 sm:space-y-12">
                    @foreach($posts as $post)
                    <article class="group grid sm:grid-cols-12 gap-5 sm:gap-8 items-start border-b border-neutral-200 dark:border-neutral-800 pb-8 sm:pb-12 last:border-0">

                        <!-- Thumbnail Gambar -->
                        <a href="{{ route('post.show', $post->slug) }}" class="sm:col-span-5 block overflow-hidden rounded-2xl relative aspect-video sm:aspect-[4/3] bg-neutral-100 dark:bg-[#1a1a1a]">
                            <img src="{{ asset('storage/' . ($post->image ?? 'default.jpg')) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">

                            <!-- Label Waktu (Live indicator) -->
                            <div class="absolute top-3 left-3 bg-red-600 text-white text-[9px] font-black uppercase tracking-wider px-2.5 py-1 rounded-md shadow-md">
                                {{ $post->created_at->diffForHumans() }}
                            </div>
                        </a>

                        <!-- Detail Konten -->
                        <div class="sm:col-span-7 flex flex-col h-full py-1">
                            <!-- Meta Data -->
                            <div class="flex flex-wrap items-center gap-3 mb-3">
                                <span class="text-[10px] font-black text-red-600 uppercase tracking-[0.2em]">{{ $category->name ?? 'Rubrik' }}</span>
                                <span class="w-1 h-1 rounded-full bg-neutral-300 dark:bg-neutral-700"></span>
                                <span class="text-[10px] font-bold text-neutral-500 uppercase tracking-widest">{{ $post->created_at->format('d M Y') }}</span>
                            </div>

                            <!-- Judul Artikel -->
                            <h2 class="text-xl sm:text-2xl font-[1000] tracking-tight text-neutral-900 dark:text-white leading-[1.2] mb-3 group-hover:text-red-600 transition-colors line-clamp-3">
                                <a href="{{ route('post.show', $post->slug) }}">
                                    {{ $post->title }}
                                </a>
                            </h2>

                            <!-- Cuplikan Teks (Excerpt) -->
                            <p class="text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed font-medium line-clamp-2 mb-5">
                                {{ Str::limit(strip_tags($post->excerpt ?? $post->content), 130) }}
                            </p>

                            <!-- Author Info -->
                            <div class="flex items-center gap-2.5 mt-auto pt-4 border-t border-neutral-100 dark:border-neutral-800/50">
                                <div class="w-6 h-6 rounded-full bg-neutral-200 dark:bg-neutral-800 flex items-center justify-center text-[10px] font-black text-neutral-600 dark:text-neutral-400 uppercase">
                                    {{ substr($post->author->name ?? 'R', 0, 1) }}
                                </div>
                                <span class="text-[11px] font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider">
                                    {{ $post->author->name ?? 'Tim Redaksi' }}
                                </span>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12 lg:mt-16">
                    {{ $posts->links() }} <!-- Pastikan Anda menggunakan Tailwind pagination views di Laravel -->
                </div>
                @else
                <!-- State Data Kosong -->
                <div class="py-24 flex flex-col items-center justify-center text-center bg-neutral-50 dark:bg-[#121212] rounded-[2rem] border border-neutral-200 dark:border-neutral-800">
                    <div class="w-20 h-20 bg-neutral-200 dark:bg-neutral-800 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-10 h-10 text-neutral-400 dark:text-neutral-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-[1000] text-neutral-900 dark:text-white uppercase tracking-tight mb-2">Belum Ada Berita</h3>
                    <p class="text-sm text-neutral-500 font-medium max-w-md px-6">Redaksi belum mempublikasikan artikel apapun ke dalam rubrik {{ $category->name ?? '' }} saat ini. Silakan periksa kembali nanti.</p>
                </div>
                @endif
            </main>

            <!-- ============================== -->
            <!-- SIDEBAR WIDGETS                -->
            <!-- ============================== -->
            <aside class="lg:col-span-4 space-y-10 lg:space-y-12">

                <!-- WIDGET 1: Berita Terpopuler -->
                <div class="bg-neutral-50 dark:bg-[#121212] rounded-[2rem] p-6 sm:p-8 border border-neutral-200 dark:border-neutral-800">
                    <div class="flex items-center gap-3 mb-8 border-b border-neutral-200 dark:border-neutral-800 pb-4">
                        <div class="w-1.5 h-6 bg-red-600 rounded-full"></div>
                        <h3 class="text-[13px] font-black uppercase tracking-[0.2em] text-neutral-900 dark:text-white">Sedang Tren</h3>
                    </div>

                    <div class="space-y-6">
                        <!-- Mockup Berita Populer (Bisa diganti loop data dari controller) -->
                        @if(isset($popularPosts) && $popularPosts->count() > 0)
                        @foreach($popularPosts as $index => $pop)
                        <a href="{{ route('post.show', $pop->slug) }}" class="group flex items-start gap-4">
                            <!-- Angka Urutan Elegan -->
                            <span class="text-4xl font-[1000] text-neutral-200 dark:text-neutral-800 group-hover:text-red-600 transition-colors leading-[0.8] -mt-1 tracking-tighter">
                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </span>
                            <div>
                                <h4 class="text-sm font-bold leading-snug text-neutral-800 dark:text-neutral-200 group-hover:text-red-600 transition-colors line-clamp-3 mb-2">
                                    {{ $pop->title }}
                                </h4>
                                <span class="text-[9px] font-black text-neutral-400 uppercase tracking-widest">{{ $pop->created_at->format('d M Y') }}</span>
                            </div>
                        </a>
                        @endforeach
                        @else
                        <p class="text-xs font-medium text-neutral-500 italic">Data tren berita belum tersedia.</p>
                        @endif
                    </div>
                </div>

                <!-- WIDGET 2: Langganan Berita / Iklan -->
                <div class="bg-red-600 rounded-[2rem] p-8 text-white relative overflow-hidden group">
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-1000"></div>
                    <div class="relative z-10">
                        <span class="inline-block bg-white/20 text-white text-[9px] font-black uppercase tracking-[0.2em] px-2.5 py-1 rounded mb-4 backdrop-blur-sm">Highlight Update</span>
                        <h3 class="text-2xl font-[1000] uppercase tracking-tight mb-3 drop-shadow-md leading-tight">Berita Harian ke WhatsApp Anda</h3>
                        <p class="text-[13px] font-medium text-red-100 mb-8 leading-relaxed opacity-90">Jadilah yang pertama tahu. Dapatkan ringkasan isu terhangat NTT setiap pagi.</p>

                        <a href="https://wa.me/{{ $settings['contact_whatsapp'] ?? '' }}?text=Halo%20Redaksi,%20saya%20ingin%20berlangganan%20update%20berita%20Highlight%20NTT" target="_blank" class="flex justify-center items-center gap-2 w-full py-4 bg-white text-red-600 text-xs font-black uppercase tracking-[0.15em] rounded-xl hover:bg-neutral-100 hover:shadow-lg transition-all active:scale-95">
                            Daftar Gratis
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>

            </aside>
        </div>
    </div>
</x-layouts.app>