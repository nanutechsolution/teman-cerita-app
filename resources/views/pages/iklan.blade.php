@php
$settings = $settings ?? [];
@endphp

<x-layouts.app :settings="$settings">
    @slot('title', 'Info Iklan & Media Kit | ' . ($settings['site_name'] ?? 'Teman Cerita NTT'))

    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 pt-24 lg:pt-32 pb-20">

        <header class="max-w-4xl mb-20">
            <span class="inline-block bg-red-600 text-white text-[10px] font-black px-3 py-1 rounded-sm uppercase tracking-widest mb-6 shadow-lg shadow-red-900/20">Partnership</span>
            <h1 class="text-4xl md:text-7xl font-black text-neutral-900 dark:text-white tracking-tighter uppercase italic leading-[0.9] mb-8 transition-colors">
                Tumbuh <br> Bersama <span class="text-neutral-400">Target</span> Anda
            </h1>
            <p class="text-xl text-neutral-500 dark:text-neutral-400 leading-relaxed max-w-2xl font-bold uppercase tracking-wide border-l-4 border-neutral-200 dark:border-neutral-800 pl-6">
                Jangkau audiens tertarget di Nusa Tenggara Timur melalui ekosistem digital Teman Cerita NTT.
            </p>
        </header>

        <div class="grid lg:grid-cols-3 gap-8">
            @forelse($adPackages as $package)
            @if($package->is_featured)
            {{-- Desain Unggulan (Gelap/Dark Mode) --}}
            <div class="group p-10 bg-neutral-900 text-white rounded-[2.5rem] border border-neutral-800 transition-all shadow-2xl relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-red-600/20 rounded-full blur-3xl"></div>
                <div class="mb-8 relative z-10">
                    <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center text-red-500 mb-6">
                        {!! $package->icon ?? '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>' !!}
                    </div>
                    <h3 class="text-2xl font-black text-white uppercase italic tracking-tighter mb-4">{{ $package->name }}</h3>
                    <p class="text-xs text-neutral-400 leading-relaxed font-bold uppercase tracking-wider">{{ $package->description }}</p>
                </div>
                <div class="pt-8 border-t border-white/5 relative z-10">
                    <span class="text-[10px] font-black text-red-500 uppercase tracking-widest">{{ $package->price_text }}</span>
                </div>
            </div>
            @else
            {{-- Desain Standar (Terang/Light Mode) --}}
            <div class="group p-10 bg-white dark:bg-[#121212] border border-neutral-200 dark:border-neutral-800 rounded-[2.5rem] hover:border-red-600 transition-all shadow-sm">
                <div class="mb-8">
                    <div class="w-12 h-12 rounded-full bg-neutral-100 dark:bg-neutral-800 flex items-center justify-center text-neutral-500 mb-6">
                        {!! $package->icon ?? '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>' !!}
                    </div>
                    <h3 class="text-2xl font-black text-neutral-900 dark:text-white uppercase italic tracking-tighter mb-4">{{ $package->name }}</h3>
                    <p class="text-xs text-neutral-500 leading-relaxed font-bold uppercase tracking-wider">{{ $package->description }}</p>
                </div>
                <div class="pt-8 border-t border-neutral-100 dark:border-neutral-800">
                    <span class="text-[10px] font-black text-red-600 uppercase tracking-widest">{{ $package->price_text }}</span>
                </div>
            </div>
            @endif
            @empty
            <div class="col-span-3 text-center py-10 text-neutral-500">
                Belum ada paket iklan yang tersedia saat ini.
            </div>
            @endforelse
        </div>

        <div class="mt-20 p-12 bg-neutral-900 rounded-[3rem] text-center text-white relative overflow-hidden">
            <div class="absolute inset-0 bg-red-600/10 mix-blend-overlay"></div>
            <h4 class="text-3xl font-black italic uppercase mb-6 relative z-10">Siap Untuk Beriklan?</h4>
            <p class="text-sm font-bold uppercase tracking-[0.2em] mb-10 opacity-70 relative z-10">Dapatkan Media Kit Lengkap Kami Melalui WhatsApp Redaksi.</p>
            <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}" target="_blank" class="bg-white text-red-600 px-12 py-4 rounded-2xl font-black uppercase text-xs tracking-[0.2em] hover:bg-neutral-100 transition-all relative z-10">Hubungi Marketing</a>
        </div>
    </div>
</x-layouts.app>