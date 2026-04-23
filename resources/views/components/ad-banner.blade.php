@props(['position'])

@php
    // Memanggil Service untuk mendapatkan iklan yang sesuai posisi
    $ad = \App\Services\AdService::getAd($position);

    // Jika iklan ditemukan, catat satu tayangan (view)
    if($ad) {
        \App\Services\AdService::incrementView($ad->id);
    }
@endphp

@if($ad)
<div {{ $attributes->merge(['class' => 'ad-space my-8 sm:my-16 w-full px-4 lg:px-0']) }}>
    <div class="max-w-[1200px] mx-auto">
        <a href="{{ $ad->link_url ?? '#' }}" 
            target="_blank" 
            rel="nofollow" 
            class="group relative block overflow-hidden rounded-xl sm:rounded-2xl border border-neutral-200 dark:border-neutral-800 bg-white dark:bg-[#121212] transition-all hover:shadow-xl sm:hover:shadow-2xl">
            
            <!-- Badge Penanda Iklan (Responsive Size) -->
            <div class="absolute top-2 right-2 sm:top-3 sm:right-3 z-10 flex items-center gap-1 bg-black/60 backdrop-blur-md text-[7px] sm:text-[8px] font-black text-white px-2 sm:px-2.5 py-0.5 sm:py-1 rounded-sm uppercase tracking-[0.1em] sm:tracking-[0.2em] border border-white/10 shadow-lg">
                <div class="w-1 h-1 sm:w-1.5 sm:h-1.5 bg-red-500 rounded-full animate-pulse shadow-[0_0_5px_rgba(239,68,68,0.8)]"></div>
                Sponsored
            </div>

            <!-- Gambar Banner -->
            <div class="relative overflow-hidden aspect-auto">
                <img src="{{ asset('storage/' . $ad->image_path) }}" 
                    alt="{{ $ad->title }}" 
                    class="w-full h-auto min-h-[50px] object-cover object-center transition-transform duration-[2000ms] group-hover:scale-[1.02]">
                
                <!-- Hover Effect Gradient -->
                <div class="absolute inset-0 bg-gradient-to-t from-red-600/5 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            </div>
        </a>

        <!-- Footer Iklan (Responsive Flex) -->
        <div class="mt-3 flex flex-wrap justify-between items-center gap-y-2 px-1 sm:px-2">
            <div class="flex items-center gap-2 flex-wrap">
                <span class="text-[8px] sm:text-[9px] font-bold text-neutral-400 uppercase tracking-widest whitespace-nowrap">Sponsored Content</span>
                <span class="hidden sm:block w-1 h-1 bg-neutral-300 dark:bg-neutral-700 rounded-full"></span>
                <span class="text-[8px] sm:text-[9px] font-medium text-neutral-400 uppercase tracking-widest line-clamp-1 max-w-[150px] sm:max-w-none">
                    {{ $ad->title }}
                </span>
            </div>
            <a href="/info-iklan" class="text-[8px] sm:text-[9px] font-black text-neutral-500 dark:text-neutral-400 hover:text-red-600 dark:hover:text-red-500 transition-colors uppercase tracking-widest flex items-center gap-1 group/link">
                Pasang Iklan
                <svg class="w-2 sm:w-2.5 h-2 sm:h-2.5 transform group-hover/link:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
    </div>
</div>
@endif