@php
    $settings = $settings ?? [];
@endphp

<x-layouts.app :settings="$settings">
    @slot('title', 'Kontak Redaksi | ' . ($settings['site_name'] ?? 'Teman Cerita NTT'))
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 pt-24 lg:pt-32 pb-20">
        <header class="max-w-4xl mb-16">
            <span class="inline-block bg-neutral-900 dark:bg-white text-white dark:text-black text-[10px] font-black px-3 py-1 rounded-sm uppercase tracking-widest mb-6">Hubungi Kami</span>
            <h1 class="text-4xl md:text-6xl font-black text-neutral-900 dark:text-white tracking-tighter uppercase leading-[0.9] mb-8 transition-colors italic">
                Terhubung Dengan <br> <span class="text-red-600">Redaksi</span>
            </h1>
        </header>

        <div class="grid lg:grid-cols-12 gap-16">
            {{-- Form Kontak --}}
            <div class="lg:col-span-7">
                <div class="bg-white dark:bg-[#121212] p-8 md:p-12 rounded-[2.5rem] border border-neutral-200 dark:border-neutral-800 shadow-xl transition-colors">
                    <form action="#" method="POST" class="space-y-6">
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-[0.2em] text-neutral-500">Nama Lengkap</label>
                                <input type="text" name="name" class="w-full bg-neutral-50 dark:bg-[#1a1a1a] border border-neutral-200 dark:border-neutral-700 rounded-xl px-5 py-3.5 outline-none focus:border-red-600 transition-all text-sm font-bold">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-[0.2em] text-neutral-500">Email Anda</label>
                                <input type="email" name="email" class="w-full bg-neutral-50 dark:bg-[#1a1a1a] border border-neutral-200 dark:border-neutral-700 rounded-xl px-5 py-3.5 outline-none focus:border-red-600 transition-all text-sm font-bold">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-[0.2em] text-neutral-500">Subjek / Kategori Pesan</label>
                            <select class="w-full bg-neutral-50 dark:bg-[#1a1a1a] border border-neutral-200 dark:border-neutral-700 rounded-xl px-5 py-3.5 outline-none focus:border-red-600 transition-all text-sm font-bold uppercase tracking-widest">
                                <option>Liputan Berita</option>
                                <option>Iklan & Partnership</option>
                                <option>Opini & Kirim Tulisan</option>
                                <option>Kritik & Saran</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-[0.2em] text-neutral-500">Pesan Anda</label>
                            <textarea rows="5" class="w-full bg-neutral-50 dark:bg-[#1a1a1a] border border-neutral-200 dark:border-neutral-700 rounded-2xl px-5 py-4 outline-none focus:border-red-600 transition-all text-sm font-medium"></textarea>
                        </div>
                        <button class="bg-red-600 text-white w-full py-4 rounded-xl font-black uppercase tracking-[0.3em] hover:bg-red-700 transition-all shadow-lg shadow-red-900/30">Kirim Pesan</button>
                    </form>
                </div>
            </div>

            {{-- Sidebar Info --}}
            <aside class="lg:col-span-5 space-y-8">
                <div class="p-10 bg-neutral-900 text-white rounded-[2.5rem] space-y-8">
                    <div>
                        <p class="text-[10px] font-black text-red-500 uppercase tracking-widest mb-2">WhatsApp Official</p>
                        <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}" target="_blank" class="text-2xl font-black italic hover:text-red-500 transition-colors">{{ $settings['whatsapp_number'] ?? '+62 821-xxxx-xxxx' }}</a>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-red-500 uppercase tracking-widest mb-2">Email Redaksi</p>
                        <a href="mailto:redaksi@temancerita.com" class="text-xl font-black italic hover:text-red-500 transition-colors uppercase">redaksi@temancerita.com</a>
                    </div>
                    <div class="pt-8 border-t border-white/10">
                        <p class="text-[10px] font-black text-neutral-400 uppercase tracking-widest mb-4">Lokasi Kantor</p>
                        <p class="text-sm font-bold leading-relaxed uppercase tracking-wider italic text-neutral-300">
                            {{ $settings['address'] ?? 'Jl. El Tari No. 1, Kota Kupang, Nusa Tenggara Timur' }}
                        </p>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</x-layouts.app>