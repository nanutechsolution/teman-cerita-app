@php
    $settings = $settings ?? [];
@endphp

<x-layouts.app :settings="$settings">
    @slot('title', 'Suara Warga & Citizen Journalism | ' . ($settings['site_name'] ?? 'Teman Cerita NTT'))

    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 pt-24 lg:pt-32 pb-20">
        
        <header class="max-w-4xl mb-20">
            <span class="inline-block bg-neutral-900 dark:bg-white text-white dark:text-black text-[10px] font-black px-3 py-1 rounded-sm uppercase tracking-widest mb-6">Kolaborasi Publik</span>
            <h1 class="text-4xl md:text-7xl font-black text-neutral-900 dark:text-white tracking-tighter uppercase italic leading-[0.9] mb-8 transition-colors">
                Jadilah <br> Bagian Dari <span class="text-red-600">Cerita</span>
            </h1>
            <p class="text-xl text-neutral-600 dark:text-neutral-400 leading-relaxed max-w-2xl font-medium italic border-l-4 border-red-600 pl-6">
                Punya laporan warga, keluhan fasilitas publik, atau artikel opini mengenai NTT? Kirimkan tulisan Anda dan biarkan dunia mendengar aspirasi Anda.
            </p>
        </header>

        <div class="grid lg:grid-cols-12 gap-16">
            <div class="lg:col-span-8 space-y-12">
                <div class="prose prose-lg dark:prose-invert max-w-none 
                    prose-p:text-neutral-700 dark:prose-p:text-neutral-300 prose-p:leading-relaxed 
                    prose-headings:text-neutral-900 dark:prose-headings:text-white prose-headings:font-black prose-headings:tracking-tighter prose-headings:uppercase prose-headings:italic">
                    
                    <h3>Apa itu Suara Warga?</h3>
                    <p>Suara Warga adalah ruang terbuka bagi seluruh masyarakat Nusa Tenggara Timur untuk menyampaikan informasi, opini, kritik, maupun apresiasi terkait kehidupan sosial di NTT. Kami percaya jurnalisme warga adalah kunci keterbukaan informasi.</p>

                    <h3>Ketentuan Menulis:</h3>
                    <ul class="list-none space-y-4 pl-0">
                        <li class="flex gap-4">
                            <span class="text-red-600 font-black">01.</span>
                            <span><strong>Keaslian:</strong> Tulisan harus asli, bukan plagiat, dan tidak pernah diterbitkan di media lain.</span>
                        </li>
                        <li class="flex gap-4">
                            <span class="text-red-600 font-black">02.</span>
                            <span><strong>No Hoax & SARA:</strong> Tidak mengandung unsur kebencian, fitnah, atau memicu konflik SARA.</span>
                        </li>
                        <li class="flex gap-4">
                            <span class="text-red-600 font-black">03.</span>
                            <span><strong>Identitas Jelas:</strong> Pengirim wajib melampirkan identitas (KTP/SIM) yang hanya digunakan untuk keperluan verifikasi redaksi.</span>
                        </li>
                    </ul>

                    <h3>Cara Mengirim:</h3>
                    <p>Anda dapat mengirimkan naskah dalam format Word disertai foto pendukung ke email atau melalui tombol kirim cepat di bawah ini.</p>
                </div>

                <div class="bg-red-600 p-10 rounded-[3rem] text-white shadow-2xl flex flex-col md:flex-row items-center justify-between gap-8 group">
                    <div class="max-w-sm">
                        <h4 class="text-2xl font-black italic uppercase tracking-tighter mb-2">Kirim Sekarang</h4>
                        <p class="text-[11px] font-bold uppercase tracking-wider opacity-80">Redaksi akan meninjau tulisan Anda dalam maksimal 2x24 jam.</p>
                    </div>
                    <a href="mailto:suarawarga@temancerita.com" class="bg-white text-red-600 px-10 py-4 rounded-2xl font-black uppercase text-xs tracking-[0.2em] shadow-xl group-hover:scale-105 transition-all">Kirim Via Email</a>
                </div>
            </div>

            <aside class="lg:col-span-4 space-y-8">
                <div class="p-10 bg-neutral-100 dark:bg-[#121212] border border-neutral-200 dark:border-neutral-800 rounded-[2.5rem]">
                    <h4 class="text-[10px] font-black text-neutral-400 uppercase tracking-widest mb-6">Butuh Liputan Segera?</h4>
                    <p class="text-sm font-bold leading-relaxed uppercase tracking-wider italic text-neutral-600 dark:text-neutral-300 mb-8">
                        Jika ada kejadian darurat atau isu publik yang mendesak untuk diliput jurnalis kami, hubungi pusat aduan warga.
                    </p>
                    <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}" target="_blank" class="flex items-center gap-3 text-red-600 font-black uppercase text-[10px] tracking-widest hover:gap-5 transition-all">
                        Hubungi via WhatsApp <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </aside>
        </div>
    </div>
</x-layouts.app>