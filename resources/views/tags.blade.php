<x-public-default
    :isMinimalViewFromController="($isMinimalViewFromController ?? null)"
    :features="$features"
>
    @foreach($tags as $tag)
        <a href="{{ route('front.tag', ['tag' => $tag->name]) }}" target="_self">{{ $tag->title }}</a><br>
    @endforeach
</x-public-default>