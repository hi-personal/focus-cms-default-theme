<x-public-default
    :isMinimalViewFromController="($isMinimalViewFromController ?? null)"
>
    @if(!empty($meta['head_image_url'] ?? null))
        <div class="w-full flex justify-items-center">
            <img
                class="mx-auto inline-block"
                src="{{ $meta['head_image_url'] }}"
            >
        </div>
    @endif

    <div class="mb-0 py-12 font-semibold bg-slate-100 text-black w-full flex justify-items-center">
        <h1 class="inline-block mx-auto text-3xl">{{ $term->title }}</h1>
    </div>

    @if(!empty($meta['description'] ?? null))
        <div class="mb-10 p-6 w-full border-4 border-solid border-gray-100">
            {!! markdownToHtml($meta['description']) !!}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 py-6">
        @foreach($posts as $post)
            @include('theme::taxonomy.partials.post-card')
        @endforeach
    </div>

    @if($config['hierarchical'])
        <div class="w-full p-6">
            {{ $posts->links() }}
        </div>
    @endif
</x-public-default>