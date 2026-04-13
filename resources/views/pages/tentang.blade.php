@php
    $settings = $settings ?? [];
@endphp

<x-layouts.app :settings="$settings">
    @slot('title', 'Tentang Kami | ' . ($settings['site_name'] ?? 'Teman Cerita NTT'))

    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 pt-24 lg:pt-32 pb-20">
        
        {{-- Hero Section --}}
        <header class="max-w-4xl mb-20">
            <span class="inline-block bg-red-600 text-white text-[10px] font-black px-3 py-1 rounded-sm uppercase tracking-widest mb-6 shadow-lg shadow-red-900/20">Profil Media</span>
            <h1 class="text-4xl md:text-7xl font-black text-neutral-900 dark:text-white tracking-tighter uppercase italic leading-[0.9] mb-8 transition-colors">
                Suara Independen <br> Dari <span class="text-red-600">Timur</span>
            </h1>
            <p class="text-xl text-neutral-600 dark:text-neutral-400 leading-relaxed max-w-2xl font-medium italic border-l-4 border-red-600 pl-6">
                Kami hadir untuk menceritakan NTT apa adanya—dengan kedalaman, empati, dan keberanian untuk mengangkat isu publik yang sering kali terabaikan.
            </p>
        </header>

        <div class="grid lg:grid-cols-12 gap-16 items-start">
            <div class="lg:col-span-8 space-y-12">
                {{-- Visi & Misi --}}
                <div class="prose prose-lg dark:prose-invert max-w-none 
                    prose-p:text-neutral-700 dark:prose-p:text-neutral-300 prose-p:leading-relaxed 
                    prose-headings:text-neutral-900 dark:prose-headings:text-white prose-headings:font-black prose-headings:tracking-tighter prose-headings:uppercase prose-headings:italic">
                    
                    <h3>Visi Kami</h3>
                    <p>Menjadi platform media digital terdepan di Nusa Tenggara Timur yang mengedepankan jurnalisme berbasis data, diskusi mendalam, dan pemberdayaan komunitas lokal melalui narasi yang jujur dan inspiratif.</p>

                    <h3>Misi Kami</h3>
                    <ul class="list-none space-y-4 pl-0">
                        <li class="flex gap-4">
                            <span class="text-red-600 font-black">01.</span>
                            <span>Menyajikan informasi yang diverifikasi secara ketat untuk melawan disinformasi di ruang publik.</span>
                        </li>
                        <li class="flex gap-4">
                            <span class="text-red-600 font-black">02.</span>
                            <span>Memberikan ruang bagi tokoh, ahli, dan warga untuk berdiskusi mengenai kebijakan publik.</span>
                        </li>
                        <li class="flex gap-4">
                            <span class="text-red-600 font-black">03.</span>
                            <span>Mempromosikan kekayaan budaya, pariwisata, dan potensi ekonomi kreatif NTT ke level global.</span>
                        </li>
                    </ul>

                    <h3>Nilai Jurnalisme</h3>
                    <p>Teman Cerita NTT percaya bahwa jurnalisme bukan hanya tentang melaporkan peristiwa, tetapi tentang memberikan konteks. Kami menjunjung tinggi independensi dan integritas, memastikan setiap cerita memiliki nilai edukasi bagi pembaca.</p>
                </div>
            </div>

            <aside class="lg:col-span-4 space-y-10">
                <div class="p-10 bg-neutral-900 text-white rounded-[3rem] shadow-2xl relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-red-600/20 rounded-full blur-3xl"></div>
                    <h4 class="text-xl font-black italic uppercase mb-4 relative z-10">Kenapa "Teman Cerita"?</h4>
                    <p class="text-xs text-neutral-400 leading-relaxed uppercase tracking-wider relative z-10 font-bold">
                        Karena berita terbaik lahir dari percakapan yang tulus antara sesama manusia. Kami ingin menjadi teman bagi warga NTT untuk berbagi cerita dan aspirasi.
                    </p>
                </div>
            </aside>
        </div>
    </div>
</x-layouts.app>