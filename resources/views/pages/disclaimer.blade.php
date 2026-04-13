@php
    $settings = $settings ?? [];
@endphp

<x-layouts.app :settings="$settings">
    @slot('title', 'Penafian (Disclaimer) | ' . ($settings['site_name'] ?? 'Teman Cerita NTT'))

    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 pt-24 lg:pt-32 pb-20 italic">
        <header class="max-w-4xl mb-16">
            <span class="inline-block bg-neutral-900 dark:bg-white text-white dark:text-black text-[10px] font-black px-3 py-1 rounded-sm uppercase tracking-widest mb-6">Legalitas</span>
            <h1 class="text-4xl md:text-6xl font-black text-neutral-900 dark:text-white tracking-tighter uppercase leading-[0.9] mb-8 transition-colors">
                Penafian <br> <span class="text-red-600 text-3xl md:text-5xl">&</span> Disclaimer
            </h1>
        </header>

        <div class="grid lg:grid-cols-12 gap-16">
            <div class="lg:col-span-8">
                <div class="prose prose-lg dark:prose-invert max-w-none 
                    prose-p:text-neutral-700 dark:prose-p:text-neutral-300 prose-p:leading-relaxed prose-p:mb-8
                    prose-headings:text-neutral-900 dark:prose-headings:text-white prose-headings:font-black prose-headings:tracking-tighter prose-headings:uppercase prose-headings:italic">
                    
                    <p>Informasi yang disediakan oleh {{ $settings['site_name'] ?? 'Teman Cerita NTT' }} di situs ini hanya untuk tujuan informasi umum. Semua informasi di Situs disediakan dengan itikad baik, namun kami tidak memberikan pernyataan atau jaminan apa pun, tersurat maupun tersirat, mengenai keakuratan, kecukupan, validitas, keandalan, ketersediaan, atau kelengkapan informasi apa pun di Situs.</p>

                    <h3>1. Konten Pihak Ketiga</h3>
                    <p>Situs ini mungkin berisi tautan ke situs web lain atau konten milik atau berasal dari pihak ketiga. Tautan luar tersebut tidak diselidiki, dipantau, atau diperiksa keakuratannya oleh kami. Kami tidak bertanggung jawab atas isi dari komentar atau konten buatan pengguna (Citizen Journalism).</p>

                    <h3>2. Tanggung Jawab Profesional</h3>
                    <p>Situs ini tidak dapat dan tidak berisi nasihat hukum, medis, atau nasihat ahli lainnya. Informasi disediakan untuk tujuan pendidikan dan informasi saja dan bukan pengganti nasihat profesional.</p>

                    <h3>3. Perubahan Kebijakan</h3>
                    <p>Kami berhak untuk mengubah atau memperbarui Disclaimer ini kapan saja tanpa pemberitahuan sebelumnya. Dengan menggunakan situs ini, Anda dianggap menyetujui penafian ini secara keseluruhan.</p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>