@php
    $settings = $settings ?? [];
@endphp

<x-layouts.app :settings="$settings">
    @slot('title', 'Karir & Kontributor | ' . ($settings['site_name'] ?? 'Teman Cerita NTT'))

    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 pt-24 lg:pt-36 pb-24">
        
        {{-- Hero Section --}}
        <header class="max-w-5xl mb-24">
            <div class="flex items-center gap-3 mb-8">
                <span class="w-12 h-[2px] bg-red-600"></span>
                <span class="text-red-600 text-[11px] font-black uppercase tracking-[0.3em]">Join Our Newsroom</span>
            </div>
            
            <h1 class="text-5xl md:text-8xl font-black text-neutral-900 dark:text-white tracking-tight leading-[0.85] uppercase mb-10 transition-colors">
                Membangun <br> 
                <span class="text-neutral-300 dark:text-neutral-700">Masa Depan</span> <br>
                Cerita NTT
            </h1>

            <div class="grid md:grid-cols-2 gap-10 items-end">
                <p class="text-lg text-neutral-500 dark:text-neutral-400 leading-relaxed font-medium transition-colors">
                    Kami tidak hanya mencari pekerja, kami mencari kolaborator yang berani mengangkat isu publik, budaya, dan harapan masyarakat Nusa Tenggara Timur dengan integritas tinggi.
                </p>
                <div class="flex gap-10 border-l border-neutral-200 dark:border-neutral-800 pl-10 hidden md:flex">
                    <div>
                        <span class="block text-2xl font-black text-neutral-900 dark:text-white">100%</span>
                        <span class="text-[10px] uppercase font-bold text-neutral-500 tracking-widest">Independen</span>
                    </div>
                    <div>
                        <span class="block text-2xl font-black text-neutral-900 dark:text-white">Digital</span>
                        <span class="text-[10px] uppercase font-bold text-neutral-500 tracking-widest">Native</span>
                    </div>
                </div>
            </div>
        </header>

        {{-- Job Grid --}}
        <div class="grid lg:grid-cols-3 gap-6">
            @forelse($careers as $career)
                @if($career->is_featured)
                    {{-- Premium Dark Card --}}
                    <div class="group relative p-12 bg-neutral-950 text-white rounded-[2.5rem] border border-neutral-800 flex flex-col justify-between shadow-2xl overflow-hidden transition-all duration-500 hover:scale-[1.02]">
                        <div class="absolute -top-12 -right-12 w-48 h-48 bg-red-600/10 rounded-full blur-[80px]"></div>
                        
                        <div>
                            <div class="flex justify-between items-start mb-10">
                                <span class="bg-red-600 text-[10px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest shadow-lg shadow-red-600/20">{{ $career->type }}</span>
                                <span class="text-neutral-500 text-[10px] font-black uppercase tracking-widest">{{ $career->location ?? 'Global' }}</span>
                            </div>
                            <h3 class="text-3xl font-black uppercase tracking-tighter leading-none mb-6">{{ $career->title }}</h3>
                            <p class="text-sm text-neutral-400 leading-relaxed font-medium mb-12 opacity-80">{{ $career->description }}</p>
                        </div>

                        <a href="{{ $career->apply_link }}" class="inline-flex items-center gap-4 text-xs font-black uppercase tracking-[0.2em] group/btn">
                            <span class="bg-white text-black w-10 h-10 rounded-full flex items-center justify-center group-hover/btn:bg-red-600 group-hover/btn:text-white transition-colors">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M9 5l7 7-7 7"/></svg>
                            </span>
                            Lamar Posisi Ini
                        </a>
                    </div>
                @else
                    {{-- Minimalist Professional Card --}}
                    <div class="group p-12 bg-white dark:bg-[#0c0c0c] border border-neutral-200 dark:border-neutral-800 rounded-[2.5rem] hover:border-red-600 transition-all duration-500 flex flex-col justify-between shadow-sm">
                        <div>
                            <div class="flex justify-between items-start mb-10">
                                <span class="bg-neutral-100 dark:bg-neutral-900 text-[10px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest text-neutral-500 group-hover:text-red-600 transition-colors">{{ $career->type }}</span>
                                <span class="text-neutral-400 text-[10px] font-black uppercase tracking-widest">{{ $career->location ?? 'Remote' }}</span>
                            </div>
                            <h3 class="text-3xl font-black text-neutral-900 dark:text-white uppercase tracking-tighter leading-none mb-6 group-hover:text-red-600 transition-colors">{{ $career->title }}</h3>
                            <p class="text-sm text-neutral-500 dark:text-neutral-400 leading-relaxed font-medium mb-12">{{ $career->description }}</p>
                        </div>

                        <a href="{{ $career->apply_link }}" class="text-[10px] font-black text-neutral-900 dark:text-white uppercase tracking-[0.2em] flex items-center gap-3 border-b-2 border-neutral-100 dark:border-neutral-900 pb-2 w-fit group-hover:border-red-600 transition-all">
                            Lihat Detail 
                            <svg class="w-3 h-3 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4"><path d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                @endif
            @empty
                <div class="col-span-3 text-center py-20 bg-neutral-50 dark:bg-[#0c0c0c] rounded-[2.5rem] border-2 border-dashed border-neutral-200 dark:border-neutral-800">
                    <p class="text-neutral-500 font-black uppercase tracking-widest text-xs">Saat ini belum ada posisi yang terbuka.</p>
                </div>
            @endforelse
        </div>

        {{-- Footer CTA --}}
        <div class="mt-24 p-16 bg-neutral-900 dark:bg-neutral-950 rounded-[3rem] text-center relative overflow-hidden">
            <div class="absolute inset-0 bg-red-600 opacity-[0.03] pointer-events-none"></div>
            <p class="text-neutral-400 text-sm font-bold uppercase tracking-[0.3em] leading-relaxed relative z-10 mb-8">
                Ingin Berkontribusi Secara Khusus?
            </p>
            <h4 class="text-white text-3xl font-black uppercase italic mb-10 relative z-10">Kirimkan Surat Perkenalan Anda</h4>
            <a href="mailto:karir@temancerita.com" class="inline-block bg-white text-neutral-900 px-10 py-4 rounded-full font-black uppercase text-[10px] tracking-[0.2em] hover:bg-red-600 hover:text-white transition-all relative z-10">karir@temancerita.com</a>
        </div>
    </div>
</x-layouts.app>