@php
$settings = $settings ?? [];
@endphp

<x-layouts.app :settings="$settings">
    @slot('title', 'Struktur Redaksi | ' . ($settings['site_name'] ?? 'Teman Cerita NTT'))

    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 pt-24 lg:pt-32 pb-20">

        <header class="max-w-4xl mb-20">
            <span class="inline-block bg-red-600 text-white text-[10px] font-black px-3 py-1 rounded-sm uppercase tracking-widest mb-6">Informasi Resmi</span>
            <h1 class="text-4xl md:text-7xl font-black text-neutral-900 dark:text-white tracking-tighter uppercase italic leading-[0.9] mb-8 transition-colors">
                Struktur <br> <span class="text-red-600">Redaksi</span> Kami
            </h1>
        </header>

        <div class="grid lg:grid-cols-12 gap-16 items-start">

            <div class="lg:col-span-8 space-y-12">

                {{-- Grup 1: Pimpinan --}}
                @if(isset($members['pimpinan']))
                <div class="overflow-hidden border border-neutral-200 dark:border-neutral-800 rounded-[2rem] bg-white dark:bg-[#121212] shadow-sm">
                    <div class="bg-neutral-900 dark:bg-black p-6 border-b border-neutral-800">
                        <h2 class="text-xs font-black text-red-500 uppercase tracking-[0.3em] flex items-center gap-3">
                            <span class="w-2 h-2 bg-red-600 rounded-full animate-pulse"></span>
                            Pimpinan & Penanggung Jawab
                        </h2>
                    </div>
                    <div class="divide-y divide-neutral-100 dark:divide-neutral-800">
                        @foreach($members['pimpinan'] as $member)
                        <div class="grid grid-cols-1 md:grid-cols-3 p-6 hover:bg-neutral-50 dark:hover:bg-[#1a1a1a] transition-colors">
                            <div class="text-[10px] font-black text-neutral-400 uppercase tracking-widest">{{ $member->position }}</div>
                            <div class="md:col-span-2 text-sm font-black text-neutral-900 dark:text-white uppercase italic">{{ $member->name }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Grup 2: Editorial --}}
                @if(isset($members['editorial']))
                <div class="overflow-hidden border border-neutral-200 dark:border-neutral-800 rounded-[2rem] bg-white dark:bg-[#121212] shadow-sm">
                    <div class="bg-neutral-50 dark:bg-[#1a1a1a] p-6 border-b border-neutral-200 dark:border-neutral-800">
                        <h2 class="text-[10px] font-black text-neutral-900 dark:text-white uppercase tracking-[0.3em]">Tim Editorial</h2>
                    </div>
                    <div class="divide-y divide-neutral-100 dark:divide-neutral-800">
                        @foreach($members['editorial'] as $member)
                        <div class="grid grid-cols-1 md:grid-cols-3 p-6 hover:bg-neutral-50 dark:hover:bg-[#1a1a1a] transition-colors">
                            <div class="text-[10px] font-black text-neutral-400 uppercase tracking-widest">{{ $member->position }}</div>
                            <div class="md:col-span-2 text-sm font-black text-neutral-800 dark:text-neutral-200 uppercase italic">{{ $member->name }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Grup 3: IT --}}
                @if(isset($members['it_sosmed']))
                <div class="overflow-hidden border border-neutral-200 dark:border-neutral-800 rounded-[2rem] bg-white dark:bg-[#121212] shadow-sm">
                    <div class="bg-neutral-50 dark:bg-[#1a1a1a] p-6 border-b border-neutral-200 dark:border-neutral-800">
                        <h2 class="text-[10px] font-black text-neutral-900 dark:text-white uppercase tracking-[0.3em]">Teknologi & Media</h2>
                    </div>
                    <div class="divide-y divide-neutral-100 dark:divide-neutral-800">
                        @foreach($members['it_sosmed'] as $member)
                        <div class="grid grid-cols-1 md:grid-cols-3 p-6 hover:bg-neutral-50 dark:hover:bg-[#1a1a1a] transition-colors">
                            <div class="text-[10px] font-black text-neutral-400 uppercase tracking-widest">{{ $member->position }}</div>
                            <div class="md:col-span-2 text-sm font-black text-neutral-800 dark:text-neutral-200 uppercase italic">{{ $member->name }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>

            <aside class="lg:col-span-4 space-y-10">
                {{-- Widget Alamat & Legalitas (Tetap di sini) --}}
                <div class="p-8 bg-red-600 rounded-[2rem] text-white">
                    <h3 class="text-lg font-black italic uppercase tracking-tighter mb-4">Pedoman Media Siber</h3>
                    <a href="{{ route('page.show', 'pedoman-media-siber') }}" class="inline-block bg-white text-red-600 px-6 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-neutral-100 transition-colors">Buka Pedoman</a>
                </div>
            </aside>
        </div>
    </div>
</x-layouts.app>