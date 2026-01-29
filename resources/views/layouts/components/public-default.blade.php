@php
    $viteIsActive = check_theme_vite_is_active();

    if ($viteIsActive === true) {
        $viteAssets = [
            "Themes/{$currentTheme}/resources/js/theme.js",
            "Themes/{$currentTheme}/resources/css/theme.css",
        ];
    } else {
        $themeManifestPath = public_path("themepublic/build/manifest.json");
        $manifest = json_decode(
            file_get_contents($themeManifestPath),
            true,
            flags: JSON_THROW_ON_ERROR
        );

        $theme_vite_data = [
            'js'  => 'themepublic/build/' . ($manifest["Themes/{$currentTheme}/resources/js/theme.js"]['file'] ?? ''),
            'css' => 'themepublic/build/' . ($manifest["Themes/{$currentTheme}/resources/css/theme.css"]['file'] ?? ''),
        ];
    }

    $isMinimalView = !empty($isMinimalViewFromController)
        ? $isMinimalViewFromController
        : request()->has('minimal');
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- 3rd party / theme head inject --}}
    {!! $sidebars['ts_FocusDefaultTheme_sidebar_head_source'] !!}

    @stack('meta_tags')

    {{-- FONT: Bunny (itt maradhat preload + swap, nem layout-kritikus) --}}
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>

    <link
        rel="preload"
        as="style"
        href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
        onload="this.onload=null;this.rel='stylesheet'"
    >
    <noscript>
        <link rel="stylesheet" href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap">
    </noscript>

    {{-- Prism (nem layout-kritikus → maradhat preload) --}}
    @if($features['code'] ?? false)
        <link
            rel="preload"
            as="style"
            href="{{ asset('assets/prism.js/prism.css') }}"
            onload="this.onload=null;this.rel='stylesheet'"
        >
        <noscript>
            <link rel="stylesheet" href="{{ asset('assets/prism.js/prism.css') }}">
        </noscript>

        <script defer src="{{ asset('assets/prism.js/prism.js') }}"></script>
    @endif

    {{-- VITE / FALLBACK --}}
    @if($viteIsActive)
        {{-- Vite kezeli a CSS/JS sorrendet és preloadot --}}
        @vite($viteAssets)
    @else
        {{-- 🔴 THEME CSS: render-blocking (CLS FIX) --}}
        <link
            rel="stylesheet"
            href="{{ asset($theme_vite_data['css']) }}"
        >

        {{-- THEME JS --}}
        <script type="module" src="{{ asset($theme_vite_data['js']) }}" defer></script>
    @endif

    @stack('head_styles')
    @stack('head_scripts')
</head>

<body class="bg-white w-full min-h-screen flex flex-col">

@if($isMinimalView == false)
    <!-- Fejléc -->
    <header
        id="header"
        class="w-full max-w-[1160px] mx-auto p-4 break-words whitespace-normal hyphens-auto"
    >
        {!! $sidebars['ts_FocusDefaultTheme_sidebar_top_nav'] !!}
    </header>
@endif

<!-- Fő tartalom -->
<main
    id="content"
    class="w-full lg:bg-gray-200 py-0 md:py-1 lg:py-16 break-words whitespace-normal hyphens-auto"
>
    <div
        class="mx-auto pt-0 pb-10 lg:pt-10 lg:pb-20 px-6 bg-white lg:px-8 w-full max-w-[1160px] flex-grow shadow-xl"
    >
        {{ $slot }}
    </div>

    <!-- Scroll to top button -->
    <div x-data="{ show: false }" x-init="window.addEventListener('scroll', () => show = window.scrollY > 200)" x-show="show" x-transition:enter="transition-opacity duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed bottom-6 right-6 z-50">
    <button @click="window.scrollTo({ top: 0, behavior: 'smooth' })" aria-label="Scroll to top" class="w-10 h-10 flex items-center justify-center rounded-md border border-gray-500 bg-gray-600 text-white hover:bg-gray-500 transition-colors duration-200 shadow-md focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/></svg>
    </button>
    </div>

</main>

@if($isMinimalView == false)
    <!-- Lábléc -->
    <footer
        id="footer"
        class="w-full max-w-[1160px] mx-auto p-4 text-white mt-16 py-8 break-words whitespace-normal hyphens-auto"
    >
        <div class="container mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div>{!! $sidebars['ts_FocusDefaultTheme_sidebar_bottom_1'] !!}</div>
                <div>{!! $sidebars['ts_FocusDefaultTheme_sidebar_bottom_2'] !!}</div>
                <div>{!! $sidebars['ts_FocusDefaultTheme_sidebar_bottom_3'] !!}</div>
            </div>

            <div class="mt-6">
                {!! $sidebars['ts_FocusDefaultTheme_sidebar_bottom_4'] !!}
            </div>
        </div>
    </footer>
@endif

<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="pswp__bg"></div>
    <div class="pswp__scroll-wrap">
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>
        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close"></button>
                <button class="pswp__button pswp__button--share"></button>
                <button class="pswp__button pswp__button--zoom"></button>
            </div>
        </div>
    </div>
</div>

@stack('scripts')
</body>
</html>
