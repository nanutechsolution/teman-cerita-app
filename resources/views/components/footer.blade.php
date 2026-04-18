<footer class="bg-white dark:bg-[#0f0f0f] pt-20 pb-10 border-t border-neutral-200 dark:border-neutral-800 transition-colors duration-300 relative">

    {{-- Tombol Kembali ke Atas (Back to Top) --}}
    <div class="absolute -top-5 left-1/2 -translate-x-1/2">
        <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="bg-white dark:bg-[#1a1a1a] border border-neutral-200 dark:border-neutral-800 text-neutral-500 hover:text-red-600 dark:hover:text-red-500 p-2.5 rounded-full shadow-lg hover:-translate-y-1 transition-all focus:outline-none" aria-label="Kembali ke atas">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
            </svg>
        </button>
    </div>

    <div class="max-w-[1400px] mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-16 mb-16">

            {{-- Kolom 1: Branding & Philosophy --}}
            <div class="lg:col-span-4 space-y-6">
                
                {{-- KOMPONEN LOGO VERTIKAL FOOTER --}}
                <a href="/" class="group inline-flex flex-col items-center gap-3 transition-transform duration-300 hover:scale-[1.02] origin-left">
                    
                    <!-- Wrapper Logo -->
                    <div class="relative w-16 h-16 sm:w-20 sm:h-20 flex-shrink-0 bg-neutral-100 dark:bg-[#1a1a1a] rounded-full flex items-center justify-center border border-neutral-200 dark:border-neutral-800 shadow-sm group-hover:border-red-600 group-hover:shadow-red-500/20 transition-all duration-300">
                        @if(isset($settings['site_logo']))
                            <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="Logo HighlightNTT" class="w-full h-full object-cover rounded-full">
                        @else
                            <!-- Fallback Icon jika logo kosong -->
                            <svg class="w-8 h-8 sm:w-10 sm:h-10 text-neutral-800 dark:text-neutral-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 006-6v-1.5m-6 7.5a6 6 0 01-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 01-3-3V4.5a3 3 0 116 0v8.25a3 3 0 01-3 3z" />
                            </svg>
                        @endif
                    </div>

                    <!-- Wrapper Teks Typography (Logo Vertikal) -->
                    <div class="flex flex-col items-end select-none mt-1 sm:mt-0">
                        
                        <!-- Baris "Highlight NTT" -->
                        <div class="flex items-baseline leading-none">
                            <span class="text-3xl sm:text-[34px] font-black tracking-tight 
                                         text-white [-webkit-text-stroke:1px_#000] 
                                         dark:text-[#121212] dark:[-webkit-text-stroke:1px_#fff]">
                                Highlight
                            </span>

                            <span class="text-3xl sm:text-[34px] font-black tracking-tight text-red-600 uppercase ml-0.5">
                                NTT
                            </span>
                        </div>

                        <!-- Baris ".com" menempel tepat di bawah NTT -->
                        <span class="text-[12px] sm:text-[14px] font-black tracking-[0.15em] -mt-1 sm:-mt-1.5 leading-none 
                                     text-[#041E42] dark:text-[#e2e8f0]">
                            .com
                        </span>
                        
                    </div>
                </a>
                {{-- END LOGO --}}


                <p class="text-neutral-600 dark:text-neutral-400 leading-relaxed text-sm md:pr-10 font-medium transition-colors">
                    {{ $settings['site_description'] ?? 'Platform jurnalisme independen dari sudut pandang lokal untuk audiens global. Mengangkat isu publik, kebijakan, dan budaya NTT dengan kedalaman dan empati.' }}
                </p>

                {{-- Lencana Dewan Pers (Penting untuk media resmi) --}}
                <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-neutral-100 dark:bg-[#121212] border border-neutral-200 dark:border-neutral-800 rounded-md transition-colors">
                    <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10zm-2.5-6.5l-3-3 1.41-1.41L10 12.67l6.59-6.59L18 7.5l-8.5 8.5z" />
                    </svg>
                    <span class="text-[10px] font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider">Terverifikasi Dewan Pers</span>
                </div>

                {{-- Social Media --}}
                <div class="space-y-3 pt-2">
                    <span class="text-[11px] font-bold text-neutral-900 dark:text-white uppercase tracking-wider">Ikuti Kami</span>
                    <div class="flex flex-wrap gap-2">
                        {{-- YouTube --}}
                        <a href="{{ $settings['youtube_url'] ?? '#' }}" target="_blank" class="w-10 h-10 rounded-full bg-neutral-100 dark:bg-[#121212] border border-neutral-200 dark:border-neutral-800 flex items-center justify-center text-neutral-600 dark:text-neutral-400 hover:bg-red-600 dark:hover:bg-red-600 hover:text-white dark:hover:text-white hover:border-transparent transition-all" title="YouTube">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                            </svg>
                        </a>
                        {{-- Instagram --}}
                        <a href="{{ $settings['instagram_url'] ?? '#' }}" target="_blank" class="w-10 h-10 rounded-full bg-neutral-100 dark:bg-[#121212] border border-neutral-200 dark:border-neutral-800 flex items-center justify-center text-neutral-600 dark:text-neutral-400 hover:bg-gradient-to-tr hover:from-yellow-400 hover:via-pink-500 hover:to-purple-600 hover:text-white dark:hover:text-white hover:border-transparent transition-all" title="Instagram">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.981 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z" />
                            </svg>
                        </a>
                        {{-- Facebook --}}
                        <a href="{{ $settings['facebook_url'] ?? '#' }}" target="_blank" class="w-10 h-10 rounded-full bg-neutral-100 dark:bg-[#121212] border border-neutral-200 dark:border-neutral-800 flex items-center justify-center text-neutral-600 dark:text-neutral-400 hover:bg-blue-600 hover:text-white dark:hover:text-white hover:border-transparent transition-all" title="Facebook">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.323-.593 1.323-1.325V1.325C24 .593 23.407 0 22.675 0z" />
                            </svg>
                        </a>
                        {{-- TikTok --}}
                        <a href="{{ $settings['tiktok_url'] ?? '#' }}" target="_blank" class="w-10 h-10 rounded-full bg-neutral-100 dark:bg-[#121212] border border-neutral-200 dark:border-neutral-800 flex items-center justify-center text-neutral-600 dark:text-neutral-400 hover:bg-neutral-900 dark:hover:bg-white hover:text-white dark:hover:text-black hover:border-transparent transition-all" title="TikTok">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-1.13-.32-2.43-.2-3.41.49-.88.61-1.33 1.71-1.3 2.75 0 .59.1 1.19.39 1.71.55.97 1.66 1.61 2.77 1.63 1.16.03 2.37-.53 2.97-1.52.4-.64.53-1.41.51-2.16-.01-4.29-.01-8.58-.01-12.87z" />
                            </svg>
                        </a>
                        {{-- WhatsApp --}}
                        <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}" target="_blank" class="w-10 h-10 rounded-full bg-neutral-100 dark:bg-[#121212] border border-neutral-200 dark:border-neutral-800 flex items-center justify-center text-neutral-600 dark:text-neutral-400 hover:bg-green-600 hover:text-white dark:hover:text-white hover:border-transparent transition-all" title="WhatsApp">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                            </svg>
                        </a>
                        {{-- RSS Feed --}}
                        <a href="/rss" target="_blank" class="w-10 h-10 rounded-full bg-neutral-100 dark:bg-[#121212] border border-neutral-200 dark:border-neutral-800 flex items-center justify-center text-neutral-600 dark:text-neutral-400 hover:bg-orange-500 hover:text-white dark:hover:text-white hover:border-transparent transition-all" title="RSS Feed">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path d="M4 11a9 9 0 0 1 9 9H9c0-2.76-2.24-5-5-5v-4zm0-7a16 16 0 0 1 16 16h-4a12 12 0 0 0-12-12V4zm2 14a2 2 0 1 1-4 0 2 2 0 0 1 4 0z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Kolom 2: Categories --}}
            <div class="lg:col-span-2">
                <h4 class="text-neutral-900 dark:text-white font-bold uppercase tracking-wider text-sm mb-6 border-b border-neutral-200 dark:border-neutral-800 pb-2 transition-colors">
                    Kategori
                </h4>
                <ul class="space-y-3">
                    @if(isset($categories) && count($categories) > 0)
                    @foreach($categories as $cat)
                    <li>
                        <a href="#" class="text-neutral-600 dark:text-neutral-400 hover:text-red-600 dark:hover:text-red-500 transition-colors text-sm font-medium flex items-center gap-2 group">
                            <span class="w-1 h-1 bg-red-600 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span>
                            {{ $cat->name }}
                        </a>
                    </li>
                    @endforeach
                    @else
                    <li><a href="#" class="text-neutral-600 dark:text-neutral-400 hover:text-red-600 dark:hover:text-red-500 transition-colors text-sm font-medium">Berita Utama</a></li>
                    <li><a href="#" class="text-neutral-600 dark:text-neutral-400 hover:text-red-600 dark:hover:text-red-500 transition-colors text-sm font-medium">Opini Publik</a></li>
                    <li><a href="#" class="text-neutral-600 dark:text-neutral-400 hover:text-red-600 dark:hover:text-red-500 transition-colors text-sm font-medium">Budaya & Sosok</a></li>
                    <li><a href="#" class="text-neutral-600 dark:text-neutral-400 hover:text-red-600 dark:hover:text-red-500 transition-colors text-sm font-medium">Podcast</a></li>
                    @endif
                </ul>
            </div>

            {{-- Kolom 3: Navigation (Diperluas dengan standar media) --}}
            <div class="lg:col-span-2">
                <h4 class="text-neutral-900 dark:text-white font-bold uppercase tracking-wider text-sm mb-6 border-b border-neutral-200 dark:border-neutral-800 pb-2 transition-colors">
                    Informasi
                </h4>
                <ul class="space-y-3 font-medium text-sm">
                    <li><a href="/" class="text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-white transition-colors">Beranda</a></li>
                    <li><a href="#" class="text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-white transition-colors">Indeks Berita</a></li>
                    <li><a href="{{ route('redaksi') }}" class="text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-white transition-colors">Tentang Redaksi</a></li>
                    <li><a href="{{ route('iklan') }}" class="text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-white transition-colors">Info Iklan</a></li>
                    <li><a href="{{ route('karir') }}" class="text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-white transition-colors">Karir / Lowongan</a></li>
                    <li><a href="{{ route('suara-warga') }}" class="text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-white transition-colors">Kirim Tulisan</a></li>
                    <li><a href="{{ route('kontak') }}" class="text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-white transition-colors">Kontak Kami</a></li>
                </ul>
            </div>

            {{-- Kolom 4: Newsletter & Presence --}}
            <div class="lg:col-span-4 space-y-8">
                <div class="bg-neutral-50 dark:bg-[#121212] border border-neutral-200 dark:border-neutral-800 p-6 rounded-xl transition-colors duration-300">
                    <h4 class="text-neutral-900 dark:text-white font-bold uppercase tracking-wider text-sm mb-2">Langganan Buletin</h4>
                    <p class="text-neutral-600 dark:text-neutral-400 text-sm mb-5 leading-relaxed">Dapatkan kurasi berita dan cerita NTT terbaik langsung ke email Anda.</p>
                    <form action="#" class="flex gap-2">
                        <input type="email" placeholder="Alamat Email" class="flex-1 bg-white dark:bg-[#0f0f0f] border border-neutral-300 dark:border-neutral-800 rounded-md px-4 py-2.5 text-sm text-neutral-900 dark:text-white focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors">
                        <button type="submit" class="bg-red-600 text-white px-5 rounded-md hover:bg-red-700 transition-colors flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </form>
                </div>

                <div class="flex items-start gap-4 border-b border-neutral-200 dark:border-neutral-800 pb-6 transition-colors">
                    <div class="w-10 h-10 rounded-full bg-neutral-100 dark:bg-[#1a1a1a] border border-neutral-200 dark:border-neutral-800 flex items-center justify-center flex-shrink-0 transition-colors">
                        <svg class="w-4 h-4 text-neutral-600 dark:text-neutral-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-neutral-900 dark:text-white text-sm font-bold mb-1 transition-colors">Kantor Redaksi</p>
                        <p class="text-neutral-600 dark:text-neutral-400 text-xs leading-relaxed transition-colors">{{ $settings['address'] ?? 'Jl. El Tari No. 1, Oebobo, Kota Kupang, Nusa Tenggara Timur' }}</p>
                    </div>
                </div>

                {{-- App Download Placeholder --}}
                <div>
                    <p class="text-neutral-900 dark:text-white text-sm font-bold mb-3 transition-colors">Aplikasi Mobile</p>
                    <div class="flex gap-3">
                        <a href="#" class="flex items-center gap-2 bg-neutral-100 dark:bg-[#1a1a1a] border border-neutral-200 dark:border-neutral-800 hover:border-red-600 dark:hover:border-red-600 px-3 py-2 rounded-lg transition-colors group">
                            <svg class="w-6 h-6 text-neutral-700 dark:text-white group-hover:text-red-600 transition-colors" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M3.6 3.1c-.2.2-.3.6-.3 1.1v15.6c0 .5.1.9.3 1.1l.1.1 8.8-8.8v-.2L3.7 3l-.1.1z M12.8 12l2.8-2.8 3.3 1.9c.9.5.9 1.4 0 1.9l-3.3 1.9-2.8-2.9v0z M13.1 12.3l-8.3 8.3c.5.5 1.3.6 2.2.1l6.1-3.5-0-4.9z M13.1 11.7l0-4.9-6.1-3.5C6.1 2.8 5.3 2.9 4.8 3.4l8.3 8.3z" />
                            </svg>
                            <div class="flex flex-col">
                                <span class="text-[8px] uppercase tracking-wider text-neutral-500">Get it on</span>
                                <span class="text-xs font-bold text-neutral-900 dark:text-white leading-none">Google Play</span>
                            </div>
                        </a>
                        <a href="#" class="flex items-center gap-2 bg-neutral-100 dark:bg-[#1a1a1a] border border-neutral-200 dark:border-neutral-800 hover:border-red-600 dark:hover:border-red-600 px-3 py-2 rounded-lg transition-colors group">
                            <svg class="w-6 h-6 text-neutral-700 dark:text-white group-hover:text-red-600 transition-colors" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12.152 6.896c-.948 0-2.415-1.078-3.96-1.04-2.04.027-3.91 1.183-4.961 3.014-2.117 3.675-.546 9.103 1.519 12.09 1.013 1.454 2.208 3.09 3.792 3.039 1.52-.065 2.09-.987 3.935-.987 1.831 0 2.35.987 3.96.948 1.637-.026 2.676-1.48 3.676-2.948 1.156-1.688 1.636-3.325 1.662-3.415-.039-.013-3.182-1.221-3.22-4.857-.026-3.04 2.48-4.494 2.597-4.559-1.429-2.09-3.623-2.324-4.39-2.376-2-.156-3.675 1.09-4.61 1.09zM15.53 3.83c.843-1.012 1.4-2.427 1.245-3.83-1.207.052-2.662.805-3.532 1.818-.78.896-1.454 2.338-1.273 3.714 1.338.104 2.715-.688 3.56-1.702z" />
                            </svg>
                            <div class="flex flex-col">
                                <span class="text-[8px] uppercase tracking-wider text-neutral-500">Download on the</span>
                                <span class="text-xs font-bold text-neutral-900 dark:text-white leading-none">App Store</span>
                            </div>
                        </a>
                    </div>
                </div>

            </div>

        </div>

        {{-- Bottom Footer: Legal & Copyright --}}
        <div class="pt-8 border-t border-neutral-200 dark:border-neutral-800 flex flex-col lg:flex-row justify-between items-center gap-6 text-center lg:text-left transition-colors duration-300">
            <div class="flex flex-col gap-1">
                <div class="text-neutral-900 dark:text-neutral-300 text-sm font-semibold transition-colors">
                    {{ $settings['footer_text'] ?? '© ' . date('Y') . ' Highlight NTT. Seluruh Hak Cipta Dilindungi.' }}
                </div>
                <p class="text-neutral-600 dark:text-neutral-500 text-xs font-medium transition-colors">
                    Suara Independen dari Timur untuk Indonesia.
                </p>
            </div>

            <div class="flex flex-col md:flex-row items-center gap-6">
                <nav class="flex flex-wrap justify-center gap-4 text-neutral-600 dark:text-neutral-500 text-xs font-semibold uppercase tracking-wider transition-colors">
                    <a href="#" class="hover:text-red-600 dark:hover:text-red-500 transition-colors">Pedoman Siber</a>
                    <a href="#" class="hover:text-red-600 dark:hover:text-red-500 transition-colors">Kode Etik Jurnalistik</a>
                    <a href="#" class="hover:text-red-600 dark:hover:text-red-500 transition-colors">Penafian</a>
                    <a href="#" class="hover:text-red-600 dark:hover:text-red-500 transition-colors">Privasi</a>
                </nav>
                <div class="h-4 w-px bg-neutral-300 dark:bg-neutral-800 hidden md:block transition-colors"></div>

                {{-- Live Indicator --}}
                <div class="flex items-center gap-2 px-3 py-1.5 bg-neutral-100 dark:bg-[#121212] border border-neutral-200 dark:border-neutral-800 rounded-md text-neutral-700 dark:text-neutral-400 text-xs font-bold uppercase tracking-wider transition-colors">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-500 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                    </span>
                    Sistem Online
                </div>
            </div>
        </div>
    </div>
</footer>