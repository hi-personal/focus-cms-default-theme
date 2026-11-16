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
        :homePageId="$homePageId"
    />

    @if (!request()->routeIs('front.home.hu'))
        <h1 class="text-4xl font-bold mb-3 dark:text-white">{{ $post->title }}</h1>
    @endif

    <div class="post-content">
        {!! $post->content !!}
    </div>
</x-public-default>