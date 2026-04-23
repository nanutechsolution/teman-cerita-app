<div>
    @if (session()->has('message'))
        <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 text-green-600 dark:text-green-400 text-xs font-bold rounded-xl border border-green-100 dark:border-green-800">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-5">
        @honeypot {{-- Honeypot untuk mencegah spam --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            {{-- Input Nama --}}
            <div>
                <input type="text" wire:model="name" placeholder="Nama Lengkap" 
                    class="w-full bg-white dark:bg-[#0c0c0c] border border-neutral-200 dark:border-neutral-800 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-red-600/20 focus:border-red-600 outline-none transition-all dark:text-white">
                @error('name') <span class="text-[10px] text-red-600 font-bold mt-1 uppercase">{{ $message }}</span> @enderror
            </div>

            {{-- Input Email --}}
            <div>
                <input type="email" wire:model="email" placeholder="Alamat Email" 
                    class="w-full bg-white dark:bg-[#0c0c0c] border border-neutral-200 dark:border-neutral-800 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-red-600/20 focus:border-red-600 outline-none transition-all dark:text-white">
                @error('email') <span class="text-[10px] text-red-600 font-bold mt-1 uppercase">{{ $message }}</span> @enderror
            </div>
        </div>

        {{-- Isi Komentar --}}
        <div>
            <textarea wire:model="body" rows="4" placeholder="Tulis komentar Anda..." 
                class="w-full bg-white dark:bg-[#0c0c0c] border border-neutral-200 dark:border-neutral-800 rounded-2xl px-4 py-3 text-sm focus:ring-2 focus:ring-red-600/20 focus:border-red-600 outline-none transition-all dark:text-white"></textarea>
            @error('body') <span class="text-[10px] text-red-600 font-bold mt-1 uppercase">{{ $message }}</span> @enderror
        </div>

        <button type="submit" 
            class="w-full sm:w-auto px-8 py-3 bg-red-600 hover:bg-red-700 text-white text-xs font-black uppercase tracking-widest rounded-xl transition-all shadow-lg shadow-red-600/20 disabled:opacity-50"
            wire:loading.attr="disabled">
            <span wire:loading.remove>Kirim Komentar</span>
            <span wire:loading>Mengirim...</span>
        </button>
    </form>

    <hr class="my-10 border-neutral-100 dark:border-neutral-800">

    {{-- Daftar Komentar --}}
    <div class="space-y-8">
        @forelse($comments as $comment)
            <div class="flex gap-4">
                <div class="w-10 h-10 rounded-full bg-neutral-100 dark:bg-neutral-800 shrink-0 overflow-hidden">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->name) }}&background=random" class="w-full h-full object-cover">
                </div>
                <div class="flex flex-col">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-sm font-black text-neutral-900 dark:text-white uppercase tracking-tight">{{ $comment->name }}</span>
                        <span class="text-[9px] text-neutral-400 font-bold uppercase tracking-widest">• {{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed italic">
                        "{{ $comment->body }}"
                    </p>
                </div>
            </div>
        @empty
            <p class="text-center text-xs text-neutral-400 uppercase tracking-widest py-10">Belum ada komentar. Jadilah yang pertama!</p>
        @endforelse
    </div>
</div>