@php
    $settings = $settings ?? [];
@endphp

<x-layouts.app :settings="$settings">
    @slot('title', 'Karir & Kontributor | ' . ($settings['site_name'] ?? 'Teman Cerita NTT'))

    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 pt-24 lg:pt-32 pb-20">
        <header class="max-w-4xl mb-16">
            <span class="inline-block bg-red-600 text-white text-[10px] font-black px-3 py-1 rounded-sm uppercase tracking-widest mb-6">Bergabung Bersama Kami</span>
            <h1 class="text-4xl md:text-7xl font-black text-neutral-900 dark:text-white tracking-tighter uppercase italic leading-[0.9] mb-8 transition-colors">
                Tumbuh <br> Bersama <span class="text-neutral-400">Cerita</span>
            </h1>
            <p class="text-lg text-neutral-500 dark:text-neutral-400 leading-relaxed max-w-2xl font-bold uppercase tracking-wide border-l-4 border-neutral-200 dark:border-neutral-800 pl-6">
                Kami mencari jurnalis, videografer, dan pemikir kreatif yang memiliki hasrat besar untuk membangun masa depan NTT.
            </p>
        </header>

        <div class="grid lg:grid-cols-3 gap-8">
            {{-- Slot Karir 1 --}}
            <div class="group p-10 bg-white dark:bg-[#121212] border border-neutral-200 dark:border-neutral-800 rounded-[2.5rem] hover:border-red-600 transition-all flex flex-col justify-between shadow-sm">
                <div>
                    <span class="bg-neutral-100 dark:bg-neutral-800 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest text-neutral-500 mb-6 inline-block">Freelance</span>
                    <h3 class="text-2xl font-black text-neutral-900 dark:text-white uppercase italic tracking-tighter mb-4">Kontributor Tulisan</h3>
                    <p class="text-xs text-neutral-500 leading-relaxed font-bold uppercase tracking-wider mb-8">Kirimkan opini atau laporan warga dari wilayah Anda (Flores, Sumba, Timor, Alor).</p>
                </div>
                <a href="#" class="text-xs font-black text-red-600 uppercase tracking-widest flex items-center gap-2 group-hover:gap-4 transition-all">Daftar Sekarang <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M9 5l7 7-7 7"/></svg></a>
            </div>

            {{-- Slot Karir 2 --}}
            <div class="group p-10 bg-neutral-900 text-white rounded-[2.5rem] border border-neutral-800 transition-all flex flex-col justify-between shadow-2xl relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-red-600/20 rounded-full blur-3xl"></div>
                <div>
                    <span class="bg-red-600 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest text-white mb-6 inline-block">Full-Time</span>
                    <h3 class="text-2xl font-black text-white uppercase italic tracking-tighter mb-4">Reporter Investigasi</h3>
                    <p class="text-xs text-neutral-400 leading-relaxed font-bold uppercase tracking-wider mb-8">Berbasis di Kupang. Memiliki kemampuan analisis data dan keberanian dalam mengangkat isu publik.</p>
                </div>
                <a href="#" class="text-xs font-black text-red-500 uppercase tracking-widest flex items-center gap-2 group-hover:gap-4 transition-all">Kirim CV & Portofolio <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M9 5l7 7-7 7"/></svg></a>
            </div>

            {{-- Slot Karir 3 --}}
            <div class="group p-10 bg-white dark:bg-[#121212] border border-neutral-200 dark:border-neutral-800 rounded-[2.5rem] hover:border-red-600 transition-all flex flex-col justify-between shadow-sm">
                <div>
                    <span class="bg-neutral-100 dark:bg-neutral-800 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest text-neutral-500 mb-6 inline-block">Remote</span>
                    <h3 class="text-2xl font-black text-neutral-900 dark:text-white uppercase italic tracking-tighter mb-4">Video Editor</h3>
                    <p class="text-xs text-neutral-500 leading-relaxed font-bold uppercase tracking-wider mb-8">Mengolah konten podcast dan shorts Teman Cerita NTT menjadi visual yang agresif dan modern.</p>
                </div>
                <a href="#" class="text-xs font-black text-red-600 uppercase tracking-widest flex items-center gap-2 group-hover:gap-4 transition-all">Lihat Kualifikasi <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M9 5l7 7-7 7"/></svg></a>
            </div>
        </div>

        <div class="mt-20 p-12 bg-neutral-50 dark:bg-[#121212] border border-neutral-200 dark:border-neutral-800 rounded-[3rem] text-center italic">
            <p class="text-neutral-500 dark:text-neutral-400 text-sm font-bold uppercase tracking-widest leading-relaxed">
                Tidak menemukan posisi yang cocok? <br>
                Kirimkan surat perkenalan diri Anda ke <a href="mailto:karir@temancerita.com" class="text-red-600 hover:underline">karir@temancerita.com</a>. Kami selalu terbuka untuk talenta hebat.
            </p>
        </div>
    </div>
</x-layouts.app>