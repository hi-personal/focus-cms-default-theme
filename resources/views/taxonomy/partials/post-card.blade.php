@php
    $html = markdownToHtml($post->content);
    $plainText = trim(
        html_entity_decode(
            strip_tags($html),
            ENT_QUOTES | ENT_HTML5,
            'UTF-8'
        )
    );
    $excerpt = Str::words($plainText,40,'');
    $hasMore = str_word_count($plainText) > 40;
@endphp

<div class="p-2">
    <p class="text-sm text-gray-400">{{ $term->title }}</p>
    <p class="mt-1 mb-0 text-black text-2xl font-semibold">
        <a href="{{ route(
        'post.show.'.cms_locale(),
        ['slug'=>$post->name]
        ) }}">{{ $post->title }}</a>
    </p>
    <p class="text-gray-600">{{ $post->created_at->format('Y-m-d') }} </p>
    <p class="my-2">
        {{ $excerpt }}
        @if($hasMore)
            <span class="ml-1 text-gray-400">[...]</span>
        @endif
    </p>
    <p>
        <a
        href="{{ route(
        'post.show.'.cms_locale(),
        ['slug'=>$post->name]
        ) }}"
        class="btn btn-sm btn-primary font-semibold">Tovább az olvasáshoz</a>
    </p>
</div>