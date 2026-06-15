<div class="flex items-center gap-6">
    <div class="flex items-center gap-3">
        <span class="text-[10px] font-black uppercase tracking-widest text-neutral-400">Reaksi Pembaca:</span>
        
        <div class="flex items-center bg-neutral-50 dark:bg-neutral-900 rounded-full border border-neutral-200 dark:border-neutral-800 p-1 shadow-sm">
            
            {{-- Tombol LIKE --}}
            <button wire:click="react('like')" 
                class="flex items-center gap-2 px-4 py-2 rounded-full transition-all duration-300 {{ $userReaction === 'like' ? 'bg-red-600 text-white shadow-md shadow-red-600/20' : 'text-neutral-500 hover:bg-neutral-200 dark:hover:bg-neutral-800 hover:text-neutral-900 dark:hover:text-white' }}">
                <svg class="w-5 h-5 {{ $userReaction === 'like' ? 'fill-current' : 'fill-none' }}" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                </svg>
                <span class="text-xs font-black">{{ $likesCount > 0 ? $likesCount : 'Suka' }}</span>
            </button>

            <div class="w-[1px] h-4 bg-neutral-300 dark:bg-neutral-700 mx-1"></div>

            {{-- Tombol DISLIKE --}}
            <button wire:click="react('dislike')" 
                class="flex items-center gap-2 px-4 py-2 rounded-full transition-all duration-300 {{ $userReaction === 'dislike' ? 'bg-neutral-800 dark:bg-neutral-700 text-white shadow-md' : 'text-neutral-500 hover:bg-neutral-200 dark:hover:bg-neutral-800 hover:text-neutral-900 dark:hover:text-white' }}">
                <svg class="w-5 h-5 {{ $userReaction === 'dislike' ? 'fill-current' : 'fill-none' }}" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5" />
                </svg>
                <span class="text-xs font-black">{{ $dislikesCount > 0 ? $dislikesCount : 'Tidak' }}</span>
            </button>

        </div>
    </div>
</div>