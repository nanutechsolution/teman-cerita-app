@php
$settings = $settings ?? [];
@endphp

<x-layouts.app :settings="$settings">
@slot('title', 'Info Iklan & Media Kit | ' . ($settings['site_name'] ?? 'Highlight NTT'))

<div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 pt-24 sm:pt-32 lg:pt-40 pb-20">

    {{-- Section Header --}}
    <header class="max-w-4xl mb-12 sm:mb-20">
        <span class="inline-block bg-red-600 text-white text-[10px] font-black px-3 py-1 rounded-sm uppercase tracking-widest mb-6 shadow-lg shadow-red-900/20">Partnership</span>
        
        <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black text-neutral-900 dark:text-white tracking-tighter uppercase italic leading-[1] md:leading-[0.9] mb-8 transition-colors">
            Tumbuh <br class="hidden sm:block"> Bersama <span class="text-neutral-400">Target</span> Anda
        </h1>
        
        <p class="text-lg sm:text-xl text-neutral-500 dark:text-neutral-400 leading-relaxed max-w-2xl font-bold uppercase tracking-wide border-l-4 border-neutral-200 dark:border-neutral-800 pl-5 sm:pl-6">
            Jangkau audiens tertarget di Nusa Tenggara Timur melalui ekosistem digital Highlight NTT.
        </p>
    </header>

    {{-- Grid Paket Iklan --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
        @forelse($adPackages as $package)
            @if($package->is_featured)
                {{-- Desain Unggulan (Premium Dark) --}}
                <div class="group p-7 sm:p-10 bg-neutral-900 text-white rounded-[2rem] sm:rounded-[2.5rem] border border-neutral-800 transition-all shadow-2xl relative overflow-hidden flex flex-col justify-between">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-red-600/20 rounded-full blur-[80px]"></div>
                    
                    <div class="mb-8 relative z-10">
                        <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center text-red-500 mb-6">
                            {!! $package->icon ?? '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>' !!}
                        </div>
                        <h3 class="text-2xl font-black text-white uppercase italic tracking-tighter mb-4">{{ $package->name }}</h3>
                        <p class="text-xs text-neutral-400 leading-relaxed font-bold uppercase tracking-wider">{{ $package->description }}</p>
                    </div>
                    
                    <div class="pt-8 border-t border-white/5 relative z-10">
                        <span class="text-[10px] font-black text-red-500 uppercase tracking-widest">{{ $package->price_text }}</span>
                    </div>
                </div>
            @else
                {{-- Desain Standar (Light/Dark Mode Adaptive) --}}
                <div class="group p-7 sm:p-10 bg-white dark:bg-[#121212] border border-neutral-200 dark:border-neutral-800 rounded-[2rem] sm:rounded-[2.5rem] hover:border-red-600 dark:hover:border-red-600 transition-all shadow-sm flex flex-col justify-between">
                    <div class="mb-8">
                        <div class="w-12 h-12 rounded-full bg-neutral-100 dark:bg-neutral-800 flex items-center justify-center text-neutral-500 mb-6 group-hover:text-red-600 transition-colors">
                            {!! $package->icon ?? '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M4 6h16M4 12h16m-7 6h7" /></svg>' !!}
                        </div>
                        <h3 class="text-2xl font-black text-neutral-900 dark:text-white uppercase italic tracking-tighter mb-4">{{ $package->name }}</h3>
                        <p class="text-xs text-neutral-500 dark:text-neutral-400 leading-relaxed font-bold uppercase tracking-wider">{{ $package->description }}</p>
                    </div>
                    
                    <div class="pt-8 border-t border-neutral-100 dark:border-neutral-800">
                        <span class="text-[10px] font-black text-red-600 uppercase tracking-widest">{{ $package->price_text }}</span>
                    </div>
                </div>
            @endif
        @empty
            <div class="col-span-full text-center py-20 bg-neutral-50 dark:bg-neutral-900/50 rounded-[2rem] border border-dashed border-neutral-200 dark:border-neutral-800">
                <p class="text-xs font-black uppercase tracking-widest text-neutral-400">Belum ada paket iklan yang tersedia saat ini.</p>
            </div>
        @endforelse
    </div>

    {{-- Call To Action (Footer Section) --}}
    <div class="mt-16 sm:mt-24 p-8 sm:p-16 bg-neutral-900 rounded-[2rem] sm:rounded-[3rem] text-center text-white relative overflow-hidden shadow-2xl">
        <div class="absolute inset-0 bg-red-600/10 mix-blend-overlay"></div>
        
        <div class="relative z-10 max-w-2xl mx-auto">
            <h4 class="text-2xl sm:text-3xl md:text-4xl font-black italic uppercase mb-4 sm:mb-6 leading-tight">Siap Untuk Beriklan?</h4>
            <p class="text-[10px] sm:text-xs font-bold uppercase tracking-[0.2em] mb-8 sm:mb-12 opacity-70 px-4">Dapatkan Media Kit Lengkap Kami Melalui WhatsApp Redaksi.</p>
            
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '') }}" 
               target="_blank" 
               class="inline-block w-full sm:w-auto bg-white text-red-600 px-10 py-4 rounded-xl sm:rounded-2xl font-black uppercase text-xs tracking-[0.2em] hover:bg-neutral-100 transition-all transform active:scale-95 shadow-xl">
               Hubungi Marketing
            </a>
        </div>
    </div>
</div>


</x-layouts.app>