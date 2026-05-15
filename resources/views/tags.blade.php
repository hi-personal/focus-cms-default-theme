<x-public-default
    :isMinimalViewFromController="($isMinimalViewFromController ?? null)"
>
    @php
        $locale = app()->getLocale();
    @endphp

    <div class="py-8">
        <h1 class="text-3xl font-bold mb-8">
            {{ __('Címkék') }}
        </h1>

        <div class="flex flex-wrap gap-3">
            @foreach($tags as $tag)

                @php
                    $tagTitle = $tag->localizedTitle(
                        $locale,
                        false
                    );

                    $tagName = $tag->localizedName(
                        $locale,
                        false
                    );
                @endphp

                @if(
                    !empty($tagTitle)
                    && !empty($tagName)
                )
                    <a
                        href="{{ route('taxonomy.tags.show.'.$locale, ['term' => $tagName]) }}"
                        target="_self"
                        class="inline-flex items-center px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-500 transition"
                    >
                        #{{ $tagTitle }}
                    </a>
                @endif

            @endforeach
        </div>
    </div>
</x-public-default>