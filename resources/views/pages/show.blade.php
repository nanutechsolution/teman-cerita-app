<x-layouts.app>
    <div class="max-w-4xl mx-auto px-4 py-20">
        <h1 class="text-4xl font-black mb-8">{{ $page->title }}</h1>
        <div class="prose prose-lg dark:prose-invert max-w-none">
            {!! $page->content !!}
        </div>
    </div>
</x-layouts.app>