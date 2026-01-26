<x-public-default
    :isMinimalViewFromController="($isMinimalViewFromController ?? null)"
    :features="$features"
>
    <x-seo.meta
        :post="$post"
        :title="$meta_title ?? null"
        :description="$meta_description ?? null"
        :content="$post->content"
        :image="$headImageUrl ?? null"
        :section="$category->title ?? null"
        :tags="$tags?->pluck('title')->toArray() ?? []"
        :isHome="$is_home"
    />

    <div class="">
        <h1 class="text-4xl font-bold mb-3">{{ $post->title }}</h1>

        <div class="prose">
            {!! $post->content !!}
        </div>
    </div>
</x-public-default>