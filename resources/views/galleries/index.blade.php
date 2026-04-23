<x-layouts.app :settings="$settings ?? null">
    @slot('title', 'Lensa Flobamorata - Galeri Foto NTT')

    {{-- x-data Alpine.js diletakkan di container utama --}}
    <div x-data="{
            showModal: false,
            activeImages: [],
            currentIndex: 0,
            
            // Fungsi membuka galeri
            openGallery(images) {
                if(images.length === 0) return;
                this.activeImages = images;
                this.currentIndex = 0;
                this.showModal = true;
                document.body.style.overflow = 'hidden'; // Mencegah background scroll
            },
            
            // Fungsi menutup galeri
            closeGallery() {
                this.showModal = false;
                setTimeout(() => { this.activeImages = []; }, 300); // Bersihkan setelah animasi selesai
                document.body.style.overflow = 'auto';
            },
            
            // Navigasi Slider
            next() {
                if(this.currentIndex < this.activeImages.length - 1) {
                    this.currentIndex++;
                } else {
                    this.currentIndex = 0; // Loop kembali ke awal
                }
            },
            prev() {
                if(this.currentIndex > 0) {
                    this.currentIndex--;
                } else {
                    this.currentIndex = this.activeImages.length - 1; // Loop ke gambar terakhir
                }
            }
        }"
        @keydown.escape.window="closeGallery()"
        @keydown.right.window="if(showModal) next()"
        @keydown.left.window="if(showModal) prev()"
        class="min-h-screen bg-neutral-50 dark:bg-black transition-colors duration-300">

        <div class="max-w-[1400px] mx-auto px-4 sm:px-8 py-12 sm:py-20 relative z-10">

            <!-- Header -->
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h1 class="text-4xl sm:text-6xl font-[1000] text-neutral-900 dark:text-white uppercase tracking-tight mb-6 transition-colors">
                    Lensa <span class="text-red-600">Flobamorata</span>
                </h1>
                <p class="text-neutral-500 dark:text-neutral-400 text-lg leading-relaxed transition-colors">
                    Kumpulan momen terbaik, keindahan alam, dan dinamika sosial masyarakat Nusa Tenggara Timur yang tertangkap dalam bingkai visual.
                </p>
            </div>

            <!-- Grid Galeri -->
            @if(isset($galleries) && $galleries->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($galleries as $gallery)
                @php
                // Logika Ekstraksi Gambar (Berdasarkan Tabel gallery_images)
                // Mengambil data image_path menggunakan pluck() karena ini adalah Collection dari model relasi
                $imagesCollection = isset($gallery->images) ? $gallery->images->pluck('image_path') : collect();

                // Masukkan cover_image ke array paling depan jika belum ada di tabel gallery_images
                if ($gallery->cover_image && !$imagesCollection->contains($gallery->cover_image)) {
                $imagesCollection->prepend($gallery->cover_image);
                }

                // Ubah semua string path menjadi full URL Asset
                $imageUrls = $imagesCollection->map(fn($img) => asset('storage/' . $img))->values();
                @endphp

                <!-- Menggunakan tag <button> alih-alih <a> karena ini membuka Modal -->
                <button type="button"
                    @click="openGallery(@js($imageUrls))"
                    class="group text-left flex flex-col h-full w-full bg-white dark:bg-[#121212] rounded-3xl overflow-hidden border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 relative">

                    <div class="relative aspect-[4/5] overflow-hidden w-full bg-neutral-200 dark:bg-neutral-900">
                        <img src="{{ $gallery->cover_image ? asset('storage/' . $gallery->cover_image) : 'https://images.unsplash.com/photo-1518002171953-a080ee817e1f?auto=format&fit=crop&w=600' }}"
                            alt="{{ $gallery->title }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-[1.5s]">

                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-60"></div>

                        {{-- Icon indikator bahwa ini bisa diklik dan dibuka --}}
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="bg-black/50 backdrop-blur-sm p-4 rounded-full text-white transform scale-90 group-hover:scale-100 transition-all shadow-xl">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                                </svg>
                            </div>
                        </div>

                        <div class="absolute bottom-4 left-4 flex items-center gap-2 bg-red-600 text-white text-[10px] font-black px-3 py-1.5 rounded-full uppercase tracking-widest shadow-lg">
                            📸 {{ count($imageUrls) }} Foto
                        </div>
                    </div>

                    <div class="p-6 flex-1 flex flex-col">
                        <span class="text-[10px] font-black text-red-600 uppercase tracking-widest mb-3 block">
                            {{ $gallery->published_at ? \Carbon\Carbon::parse($gallery->published_at)->translatedFormat('d M Y') : 'Baru Saja' }}
                        </span>
                        <h3 class="text-xl font-extrabold text-neutral-900 dark:text-white leading-tight group-hover:text-red-600 transition-colors line-clamp-3">
                            {{ $gallery->title }}
                        </h3>
                    </div>
                </button>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($galleries->hasPages())
            <div class="mt-16 sm:mt-20 flex justify-center border-t border-neutral-200 dark:border-neutral-800 pt-10">
                <div class="w-full max-w-full overflow-x-auto text-neutral-600 dark:text-neutral-400 pagination-custom">
                    {{ $galleries->links() }}
                </div>
            </div>
            @endif
            @else
            {{-- Tampilan Kosong Jika Belum Ada Foto --}}
            <div class="flex flex-col items-center justify-center py-24 sm:py-32 px-4 bg-white dark:bg-neutral-900/20 rounded-3xl border border-neutral-200 dark:border-neutral-800 border-dashed relative shadow-sm dark:shadow-none">
                <div class="absolute inset-0 bg-gradient-to-b from-transparent to-neutral-50 dark:to-black/50 rounded-3xl"></div>
                <svg class="w-16 h-16 sm:w-20 sm:h-20 text-neutral-300 dark:text-neutral-700 mx-auto mb-6 relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <h3 class="text-xl sm:text-2xl font-black text-neutral-800 dark:text-neutral-400 relative z-10">BELUM ADA GALERI</h3>
                <p class="text-sm sm:text-base text-neutral-500 dark:text-neutral-600 mt-2 text-center max-w-md relative z-10">Saat ini belum ada koleksi foto yang diterbitkan.</p>
            </div>
            @endif

            {{-- ========================================== --}}
            {{-- MODAL & POPUP SLIDER FOTO (CINEMATIC)      --}}
            {{-- ========================================== --}}
            <div x-show="showModal"
                style="display: none;"
                class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/95 backdrop-blur-xl"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0">

                <!-- Header Modal (Counter & Close) -->
                <div class="absolute top-0 left-0 w-full p-4 sm:p-6 flex justify-between items-center z-[10000] bg-gradient-to-b from-black/80 to-transparent">
                    <div class="bg-neutral-900/80 backdrop-blur text-white px-4 py-2 rounded-full text-sm font-bold tracking-widest border border-neutral-700">
                        <span x-text="currentIndex + 1"></span> / <span x-text="activeImages.length"></span>
                    </div>
                    <button @click="closeGallery()" class="bg-red-600/20 hover:bg-red-600 text-red-500 hover:text-white p-2 rounded-full transition-all">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Slider Container Utama -->
                <div class="relative w-full h-full flex items-center justify-center p-4 sm:p-12 pb-24 sm:pb-32" @click.self="closeGallery()">

                    <!-- Tombol Navigasi Kiri (Prev) -->
                    <button @click.stop="prev()"
                        x-show="activeImages.length > 1"
                        class="absolute left-2 sm:left-8 z-50 p-3 sm:p-4 rounded-full bg-black/50 text-white hover:bg-red-600 transition-all border border-neutral-700 backdrop-blur group">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>

                    <!-- Gambar Aktif yang Ditampilkan -->
                    <template x-if="activeImages.length > 0">
                        <img :src="activeImages[currentIndex]"
                            class="max-w-full max-h-full object-contain rounded-xl shadow-2xl transition-all duration-300"
                            x-transition:enter="transition ease-out duration-300 transform"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            :key="currentIndex">
                    </template>

                    <!-- Tombol Navigasi Kanan (Next) -->
                    <button @click.stop="next()"
                        x-show="activeImages.length > 1"
                        class="absolute right-2 sm:right-8 z-50 p-3 sm:p-4 rounded-full bg-black/50 text-white hover:bg-red-600 transition-all border border-neutral-700 backdrop-blur group">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>

                <!-- Thumbnails Navigation (Di bagian bawah layar) -->
                <div class="absolute bottom-6 left-0 w-full px-4" x-show="activeImages.length > 1">
                    <div class="max-w-3xl mx-auto flex gap-2 sm:gap-3 overflow-x-auto py-2 px-2 snap-x scrollbar-hide justify-center">
                        <template x-for="(img, index) in activeImages" :key="index">
                            <button @click="currentIndex = index"
                                class="relative h-14 w-14 sm:h-20 sm:w-20 shrink-0 rounded-lg overflow-hidden snap-center transition-all duration-300 transform"
                                :class="currentIndex === index ? 'ring-2 ring-red-600 ring-offset-2 ring-offset-black scale-110 opacity-100 z-10' : 'opacity-40 hover:opacity-100'">
                                <img :src="img" class="w-full h-full object-cover">
                            </button>
                        </template>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- CSS Tambahan yang mendukung Light/Dark Mode (Konsisten dengan Video) --}}
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

        /* Menyembunyikan scrollbar di thumbnail bawah tapi tetap bisa discroll dengan sentuhan */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</x-layouts.app>