<x-public-default
    :isMinimalViewFromController="($isMinimalViewFromController ?? null)"
>
    @foreach($terms as $term)
        <a href="{{ route(
            "taxonomy.$taxonomy.show.".cms_locale(),
            ['term'=>$term->name]
        ) }}">{{ $term->title }}</a>
        <br>
    @endforeach
</x-public-default>