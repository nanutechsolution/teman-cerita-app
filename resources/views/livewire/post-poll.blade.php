<div>
    @if($post->poll)
    <div class="bg-neutral-50 dark:bg-[#151515] p-8 rounded-3xl border border-neutral-100 dark:border-neutral-800 shadow-sm my-8">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-full bg-red-600 text-white flex items-center justify-center shadow-lg shadow-red-600/20">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-[1000] text-neutral-900 dark:text-white uppercase tracking-tighter">Polling Artikel</h3>
                <p class="text-[10px] text-neutral-500 font-bold uppercase tracking-[0.2em]">Ikut Suarakan Pendapatmu</p>
            </div>
        </div>

        <h4 class="text-base font-bold text-neutral-800 dark:text-neutral-200 mb-6 leading-relaxed">
            {{ $post->poll->question }}
        </h4>

        @if(!$hasVoted)
        <form wire:submit.prevent="vote" class="space-y-3">
            @foreach($post->poll->options as $option)
            <label class="flex items-center gap-3 p-4 bg-white dark:bg-[#0c0c0c] border border-neutral-200 dark:border-neutral-800 rounded-2xl cursor-pointer hover:border-red-500 dark:hover:border-red-600 transition-all group">
                <input type="radio" wire:model="selectedOption" value="{{ $option->id }}" class="w-4 h-4 text-red-600 focus:ring-red-500 border-neutral-300 dark:border-neutral-700 dark:bg-neutral-900">
                <span class="text-sm font-semibold text-neutral-700 dark:text-neutral-300 group-hover:text-neutral-900 dark:group-hover:text-white transition-colors">
                    {{ $option->name }}
                </span>
            </label>
            @endforeach

            <div class="pt-2">
                <button type="submit" wire:loading.attr="disabled" class="px-6 py-3 bg-red-600 text-white text-xs font-black uppercase tracking-widest rounded-xl hover:bg-red-700 transition-all shadow-md shadow-red-600/10">
                    Kirim Suara
                </button>
            </div>
        </form>
        @else
        <div class="space-y-4">
            @foreach($post->poll->options as $option)
            @php
            $percentage = $totalVotes > 0 ? round(($option->votes_count / $totalVotes) * 100, 1) : 0;
            @endphp
            <div class="space-y-2">
                <div class="flex justify-between text-sm font-bold text-neutral-700 dark:text-neutral-300">
                    <span>{{ $option->name }}</span>
                    <span class="text-red-600">{{ $percentage }}% <span class="text-xs text-neutral-400 font-normal">({{ $option->votes_count }} suara)</span></span>
                </div>
                <div class="w-full h-3 bg-neutral-200 dark:bg-neutral-800 rounded-full overflow-hidden">
                    <div class="h-full bg-red-600 rounded-full transition-all duration-500" style="width: {{ $percentage }}%"></div>
                </div>
            </div>
            @endforeach

            <p class="text-[11px] text-neutral-400 dark:text-neutral-500 italic pt-2">
                * Terima kasih, kamu sudah berpartisipasi dalam polling ini.
            </p>
        </div>
        @endif
    </div>
    @endif
</div>