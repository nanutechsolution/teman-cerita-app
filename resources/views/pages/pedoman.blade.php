@php
    $settings = $settings ?? [];
@endphp

<x-layouts.app :settings="$settings">
    @slot('title', 'Pedoman Pemberitaan Media Siber | ' . ($settings['site_name'] ?? 'Teman Cerita NTT'))

    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 pt-24 lg:pt-32 pb-20 italic font-medium">
        <header class="max-w-4xl mb-16">
            <span class="inline-block bg-neutral-900 dark:bg-white text-white dark:text-black text-[10px] font-black px-3 py-1 rounded-sm uppercase tracking-widest mb-6">Regulasi & Standar</span>
            <h1 class="text-4xl md:text-6xl font-black text-neutral-900 dark:text-white tracking-tighter uppercase leading-[0.9] mb-8 transition-colors">
                Pedoman <br> Pemberitaan <span class="text-red-600">Media Siber</span>
            </h1>
            <p class="text-sm text-neutral-500 dark:text-neutral-400 uppercase tracking-widest font-black border-l-4 border-red-600 pl-4">
                Ditetapkan oleh Dewan Pers melalui Peraturan Dewan Pers Nomor: 1/Peraturan-DP/III/2012
            </p>
        </header>

        <div class="grid lg:grid-cols-12 gap-16">
            <div class="lg:col-span-8">
                <div class="prose prose-lg dark:prose-invert max-w-none 
                    prose-p:text-neutral-700 dark:prose-p:text-neutral-300 prose-p:leading-relaxed prose-p:mb-8
                    prose-headings:text-neutral-900 dark:prose-headings:text-white prose-headings:font-black prose-headings:tracking-tighter prose-headings:uppercase prose-headings:italic
                    prose-ol:font-bold prose-li:mb-4">
                    
                    <p>Kemerdekaan berpendapat, kemerdekaan berekspresi, dan kemerdekaan pers adalah hak asasi manusia yang dilindungi Pancasila, Undang-Undang Dasar 1945, dan Deklarasi Universal Hak Asasi Manusia PBB. Keberadaan media siber di Indonesia juga merupakan bagian dari kemerdekaan berpendapat, kemerdekaan berekspresi, dan kemerdekaan pers.</p>

                    <h3>1. Ruang Lingkup</h3>
                    <p>Media Siber adalah segala bentuk media yang menggunakan wahana teknologi informasi dan komunikasi untuk melakukan kegiatan jurnalistik, serta memenuhi persyaratan Undang-Undang Pers dan Standar Perusahaan Pers yang ditetapkan Dewan Pers.</p>

                    <h3>2. Verifikasi dan Keberimbangan Berita</h3>
                    <ol>
                        <li>Pada prinsipnya setiap berita harus melalui verifikasi.</li>
                        <li>Berita yang dapat merugikan pihak lain memerlukan verifikasi pada kesempatan pertama atau pada waktu yang bersamaan.</li>
                        <li>Khusus untuk berita siber yang memerlukan kecepatan (Breaking News), verifikasi dapat dilakukan setelah berita ditayangkan dengan syarat mencantumkan keterangan bahwa berita belum diverifikasi.</li>
                    </ol>

                    <h3>3. Isi Buatan Pengguna (User Generated Content)</h3>
                    <p>Media siber wajib mencantumkan syarat dan ketentuan mengenai isi buatan pengguna yang tidak bertentangan dengan Undang-Undang No. 40 Tahun 1999 tentang Pers dan Kode Etik Jurnalistik.</p>

                    <h3>4. Ralat, Koreksi, dan Hak Jawab</h3>
                    <p>Ralat, koreksi, dan hak jawab mengacu pada Undang-Undang Pers, Kode Etik Jurnalistik, dan Pedoman Hak Jawab yang ditetapkan Dewan Pers.</p>

                    <h3>5. Pencabutan Berita</h3>
                    <p>Berita yang sudah dipublikasikan tidak dapat dicabut karena alasan penyensoran dari pihak luar redaksi, kecuali terkait masalah rasisme, asusila, masa depan anak, atau sesuai ketetapan Dewan Pers.</p>

                    <h3>6. Iklan</h3>
                    <p>Media siber wajib membedakan dengan tegas antara produk berita dan iklan. Setiap iklan harus mencantumkan keterangan "Iklan" atau "Advertorial".</p>
                </div>
            </div>

            <aside class="lg:col-span-4">
                <div class="sticky top-28 space-y-8">
                    <div class="p-8 bg-neutral-100 dark:bg-[#121212] rounded-[2rem] border border-neutral-200 dark:border-neutral-800">
                        <h4 class="text-[10px] font-black text-neutral-400 uppercase tracking-widest mb-4">Informasi Penting</h4>
                        <p class="text-xs text-neutral-600 dark:text-neutral-300 leading-relaxed font-bold uppercase tracking-wider italic">
                            Halaman ini merupakan dokumen hukum wajib bagi setiap media siber yang beroperasi di wilayah hukum Negara Kesatuan Republik Indonesia.
                        </p>
                    </div>

                    <div class="p-8 bg-red-600 rounded-[2rem] text-white shadow-xl shadow-red-900/20">
                        <h4 class="text-xl font-black italic uppercase tracking-tighter mb-4">Sengketa Informasi?</h4>
                        <p class="text-[11px] leading-relaxed mb-6 opacity-90 font-bold uppercase tracking-wider">Jika Anda merasa dirugikan oleh pemberitaan kami, silakan gunakan Hak Jawab Anda melalui saluran resmi redaksi.</p>
                        <a href="mailto:redaksi@temancerita.com" class="inline-block bg-white text-red-600 px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-neutral-100 transition-all">Hubungi Redaksi</a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</x-layouts.app>