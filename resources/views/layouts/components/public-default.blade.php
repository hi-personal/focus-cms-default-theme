@php
    $isMinimalView = !empty($isMinimalViewFromController) ? $isMinimalViewFromController : request()->has('minimal');
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {!! $sidebars['ts_FocusDefaultTheme_sidebar_head_source'] ?? null !!}

    @stack('meta_tags')

    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>

    <link
        rel="preload"
        as="style"
        href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
        onload="this.onload=null;this.rel='stylesheet'"
    >
    <noscript>
        <link
            rel="stylesheet"
            href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
        >
    </noscript>

    @viteApp('front')

    @if($features['code'] ?? false)
        <link
            rel="preload"
            as="style"
            href="{{ asset('assets/prism.js/prism.css') }}"
            onload="this.onload=null;this.rel='stylesheet'"
        >
        <noscript>
            <link
                rel="stylesheet"
                href="{{ asset('assets/prism.js/prism.css') }}"
            >
        </noscript>

        <script defer src="{{ asset('assets/prism.js/prism.js') }}"></script>
    @endif

    @stack('head_styles')
    @stack('head_scripts')
</head>

<body class="bg-white text-black w-full min-h-screen flex flex-col">

@if(!$isMinimalView)

    <header
        id="header"
        class="w-full mx-auto p-4 wrap-break-word whitespace-normal hyphens-auto"
    >
        {!! $sidebars['ts_FocusDefaultTheme_sidebar_top_nav'] ?? null !!}
    </header>

@endif

<main
    id="content"
    class="w-full lg:bg-gray-200 flex-1 py-0 md:py-1 lg:py-16 wrap-break-word whitespace-normal hyphens-auto"
>
    <div
        class="w-full max-w-290 mx-auto bg-base-100 px-6 pt-0 pb-10 shadow-xl lg:px-8 lg:pt-10 lg:pb-20"
    >
        {{ $slot }}
    </div>

    {{-- Scroll to top --}}
    <div
        x-data="{ show: false }"
        x-init="window.addEventListener('scroll', () => show = window.scrollY > 200)"
        x-show="show"
        x-cloak
        x-transition:enter="transition-all duration-300 ease-out"
        x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition-all duration-300 ease-in"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-4"
        class="fixed right-6 bottom-6 z-50"
    >
        <button
            id="scrollTopBtn"
            type="button"
            aria-label="Scroll to top"
            class="btn btn-circle btn-neutral shadow-md"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="size-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M5 15l7-7 7 7"
                />
            </svg>
        </button>
    </div>
</main>

@if(!$isMinimalView)

    <footer
        id="footer"
        class="w-full max-w-290 mx-auto mt-16 py-8 text-base-content wrap-break-word whitespace-normal hyphens-auto"
    >
        <div class="w-full">
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <div>
                    {!! $sidebars['ts_FocusDefaultTheme_sidebar_bottom_1'] ?? null !!}
                </div>

                <div>
                    {!! $sidebars['ts_FocusDefaultTheme_sidebar_bottom_2'] ?? null !!}
                </div>

                <div>
                    {!! $sidebars['ts_FocusDefaultTheme_sidebar_bottom_3'] ?? null !!}
                </div>
            </div>

            <div class="mt-6">
                {!! $sidebars['ts_FocusDefaultTheme_sidebar_bottom_4'] ?? null !!}
            </div>
        </div>
    </footer>

@endif

@stack('scripts')

</body>
</html>