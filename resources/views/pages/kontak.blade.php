@php
$settings = $settings ?? [];
@endphp

<x-layouts.app :settings="$settings">
    @slot('title', 'Kontak Redaksi | ' . ($settings['site_name'] ?? 'Highlight NTT'))

    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 pt-28 lg:pt-36 pb-20">

        <!-- HEADER -->
        <header class="max-w-4xl mb-12 sm:mb-16 relative">
            <!-- Red Pillar Accent -->
            <div class="absolute -left-4 sm:-left-6 top-1 w-1.5 h-full bg-red-600 rounded-full"></div>

            <span class="inline-block bg-red-600 text-white text-[10px] sm:text-[11px] font-black px-3 py-1.5 rounded-sm uppercase tracking-[0.2em] mb-4">
                Pusat Layanan & Bantuan
            </span>
            <h1 class="text-4xl md:text-6xl font-[1000] text-neutral-900 dark:text-white tracking-[-0.04em] uppercase leading-[0.9] mb-6">
                Terhubung Dengan <br> <span class="text-red-600">Redaksi Kami</span>
            </h1>
            <p class="text-neutral-600 dark:text-neutral-400 font-medium max-w-2xl text-sm sm:text-base leading-relaxed">
                Punya informasi berharga, hak jawab, opini, atau tawaran kerja sama? Jangan ragu untuk menghubungi tim {{ $settings['site_name'] ?? 'Highlight NTT' }}. Kami menjunjung tinggi prinsip keterbukaan.
            </p>
        </header>

        <div class="grid lg:grid-cols-12 gap-10 lg:gap-16">

            <!-- ============================== -->
            <!-- 1. FORM KONTAK                 -->
            <!-- ============================== -->
            <div class="lg:col-span-7">
                <div class="bg-white dark:bg-[#121212] p-6 sm:p-10 lg:p-12 rounded-[2rem] border border-neutral-200 dark:border-neutral-800 shadow-xl shadow-neutral-200/50 dark:shadow-none">
                    <form action="{{ route('kontak.send') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="space-y-2.5">
                                <label for="name" class="text-[11px] font-black uppercase tracking-[0.15em] text-neutral-600 dark:text-neutral-400">Nama Lengkap</label>
                                <input type="text" id="name" name="name" required placeholder="Masukkan nama Anda"
                                    class="w-full bg-neutral-50 dark:bg-[#1a1a1a] border border-neutral-200 dark:border-neutral-800 rounded-xl px-5 py-4 outline-none focus:ring-2 focus:ring-red-600/20 focus:border-red-600 transition-all text-sm font-semibold text-neutral-900 dark:text-white placeholder-neutral-400">
                            </div>
                            <div class="space-y-2.5">
                                <label for="email" class="text-[11px] font-black uppercase tracking-[0.15em] text-neutral-600 dark:text-neutral-400">Email Anda</label>
                                <input type="email" id="email" name="email" required placeholder="alamat@email.com"
                                    class="w-full bg-neutral-50 dark:bg-[#1a1a1a] border border-neutral-200 dark:border-neutral-800 rounded-xl px-5 py-4 outline-none focus:ring-2 focus:ring-red-600/20 focus:border-red-600 transition-all text-sm font-semibold text-neutral-900 dark:text-white placeholder-neutral-400">
                            </div>
                        </div>

                        <div class="space-y-2.5">
                            <label for="subject" class="text-[11px] font-black uppercase tracking-[0.15em] text-neutral-600 dark:text-neutral-400">Tujuan Pesan</label>
                            <div class="relative">
                                <select id="subject" name="subject" required
                                    class="w-full bg-neutral-50 dark:bg-[#1a1a1a] border border-neutral-200 dark:border-neutral-800 rounded-xl px-5 py-4 appearance-none outline-none focus:ring-2 focus:ring-red-600/20 focus:border-red-600 transition-all text-sm font-bold text-neutral-900 dark:text-white cursor-pointer uppercase tracking-wider">
                                    <option value="" disabled selected>Pilih Kategori...</option>
                                    <option value="liputan">Kirim Info / Liputan Berita</option>
                                    <option value="opini">Kirim Tulisan / Opini</option>
                                    <option value="iklan">Iklan & Partnership</option>
                                    <option value="hak_jawab">Hak Jawab / Koreksi</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                                <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-neutral-500">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2.5">
                            <label for="message" class="text-[11px] font-black uppercase tracking-[0.15em] text-neutral-600 dark:text-neutral-400">Detail Pesan</label>
                            <textarea id="message" name="message" rows="6" required placeholder="Tulis rincian pesan, link, atau informasi Anda di sini..."
                                class="w-full bg-neutral-50 dark:bg-[#1a1a1a] border border-neutral-200 dark:border-neutral-800 rounded-2xl px-5 py-4 outline-none focus:ring-2 focus:ring-red-600/20 focus:border-red-600 transition-all text-sm font-medium text-neutral-900 dark:text-white placeholder-neutral-400 resize-y"></textarea>
                        </div>

                        <button type="submit" class="group relative w-full flex justify-center items-center gap-3 bg-red-600 text-white py-4 sm:py-5 rounded-xl font-black uppercase tracking-[0.2em] overflow-hidden shadow-lg shadow-red-600/20">
                            <span class="relative z-10 transition-transform group-hover:-translate-x-1">Kirim Pesan</span>
                            <svg class="w-5 h-5 relative z-10 opacity-0 -translate-x-4 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                            <div class="absolute inset-0 h-full w-0 bg-red-700 group-hover:w-full transition-all duration-500 ease-out z-0"></div>
                        </button>
                    </form>
                </div>
            </div>

            <!-- ============================== -->
            <!-- 2. SIDEBAR INFO                -->
            <!-- ============================== -->
            <aside class="lg:col-span-5">
                <div class="sticky top-28 p-8 sm:p-10 bg-neutral-900 dark:bg-[#111] text-white rounded-[2rem] shadow-2xl relative overflow-hidden">
                    <!-- Aksen Glow -->
                    <div class="absolute -right-20 -top-20 w-64 h-64 bg-red-600/30 blur-[80px] rounded-full pointer-events-none"></div>
                    <div class="absolute left-0 top-0 w-1.5 h-full bg-red-600"></div>

                    <div class="relative z-10 space-y-10">
                        <!-- Branding -->
                        <div class="pb-8 border-b border-white/10">
                            <h3 class="text-3xl font-[1000] tracking-tighter uppercase mb-2">
                                {{ Str::before($settings['site_name'] ?? 'Highlight NTT', ' ') }}
                                <span class="text-red-600">{{ Str::after($settings['site_name'] ?? 'Highlight NTT', ' ') }}</span>
                            </h3>
                            <p class="text-xs font-bold tracking-widest uppercase text-neutral-400">{{ $settings['site_tagline'] ?? 'Tajam Menyoroti Fakta, Teguh Menjaga Etika' }}</p>
                        </div>

                        <!-- WhatsApp -->
                        <div class="group">
                            <p class="text-[10px] font-black text-red-500 uppercase tracking-[0.2em] mb-2">WhatsApp Official</p>
                            <a href="https://wa.me/{{ $settings['contact_whatsapp'] ?? '628123456789' }}" target="_blank" class="inline-flex items-center gap-3 text-xl sm:text-2xl font-black group-hover:text-red-500 transition-colors">
                                <svg class="w-6 h-6 text-green-500 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                                </svg>
                                {{ $settings['contact_phone'] ?? '+62 812-3456-7890' }}
                            </a>
                        </div>

                        <!-- Email -->
                        <div class="group">
                            <p class="text-[10px] font-black text-red-500 uppercase tracking-[0.2em] mb-2">Email Redaksi</p>
                            <a href="mailto:{{ $settings['contact_email'] ?? 'redaksi@highlightntt.com' }}" class="inline-flex items-center gap-3 text-lg sm:text-xl font-bold group-hover:text-red-500 transition-colors">
                                <svg class="w-6 h-6 text-neutral-400 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                {{ $settings['contact_email'] ?? 'redaksi@highlightntt.com' }}
                            </a>
                        </div>

                        <!-- Address -->
                        <div class="pt-8 border-t border-white/10 group">
                            <p class="text-[10px] font-black text-neutral-500 uppercase tracking-[0.2em] mb-3">Kantor Pusat</p>
                            <div class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-red-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <p class="text-sm font-medium leading-relaxed text-neutral-300">
                                    {{ $settings['address'] ?? 'Jl. El Tari, Kota Kupang, Nusa Tenggara Timur, Indonesia' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

        </div>
    </div>
</x-layouts.app>