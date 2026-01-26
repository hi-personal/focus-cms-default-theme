@php
    $viteIsActive = check_theme_vite_is_active();

    if( $viteIsActive == true) {
        $viteAssets = [
            "Themes/{$currentTheme}/resources/js/theme.js",
            "Themes/{$currentTheme}/resources/css/theme.css"
        ];
    } else {
        $themeManifestPath = public_path("themepublic/build/manifest.json");
        $manifest = json_decode(
            file_get_contents($themeManifestPath),
            true,
            flags: JSON_THROW_ON_ERROR
        );

        $theme_vite_data = [
            "js" => "themepublic/build/".$manifest["Themes/{$currentTheme}/resources/js/theme.js"]['file'] ?? '',
            "css" => "themepublic/build/".$manifest["Themes/{$currentTheme}/resources/css/theme.css"]['file'] ?? ''
        ];
    }

    $isMinimalView = !empty($isMinimalViewFromController) ? $isMinimalViewFromController : request()->has('minimal');
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

        {{-- FONT: Bunny (nem render-blocking) --}}
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

        {{-- Prism CSS & Prism JS --}}
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
            {{-- Vite automatikusan kezeli a module + preloadot --}}
            @vite($viteAssets)
        @else
            {{-- CSS NEM BLOKKOLÓ --}}
            <link
                rel="preload"
                as="style"
                href="{{ asset($theme_vite_data['css']) }}"
                onload="this.onload=null;this.rel='stylesheet'"
            >
            <noscript>
                <link rel="stylesheet" href="{{ asset($theme_vite_data['css']) }}">
            </noscript>

            {{-- JS --}}
            <script type="module" src="{{ asset($theme_vite_data['js']) }}" defer></script>
        @endif

        @stack('head_styles')
        @stack('head_scripts')
    </head>

    <body class="bg-white w-full min-h-screen flex flex-col">
        @if($isMinimalView == false)
            <!-- Fejléc -->
            <header id="header" class="w-full  max-w-[1160px] mx-auto p-4 break-words whitespace-normal hyphens-auto">
                {!! $sidebars['ts_FocusDefaultTheme_sidebar_top_nav'] !!}
            </header>
        @endif

        <!-- Fő tartalom -->
        <main id="content" class="w-full lg:bg-gray-200 py-0 md:py-1 lg:py-16 break-words whitespace-normal hyphens-auto">
            <div class="mx-auto pt-0 pb-10 lg:pt-10 lg:pb-20 px-6 bg-white lg:px-8 w-full max-w-[1160px] flex-grow shadow-xl">
                {{ $slot }}
            </div>
        </main>

        <!-- Lábléc -->
        @if($isMinimalView == false)
            <footer id="footer" class="w-full max-w-[1160px] mx-auto p-4 text-white mt-16 py-8 break-words whitespace-normal hyphens-auto">
                <div class="container mx-auto">
                    <!-- Sidebarok grid-ben -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                        <div>
                            <div>
                                {!! $sidebars['ts_FocusDefaultTheme_sidebar_bottom_1'] !!}
                            </div>
                        </div>
                        <div>
                            <div>
                                {!! $sidebars['ts_FocusDefaultTheme_sidebar_bottom_2'] !!}
                            </div>
                        </div>
                        <div>
                            <div>
                                {!! $sidebars['ts_FocusDefaultTheme_sidebar_bottom_3'] !!}
                            </div>
                        </div>
                    </div>

                    <!-- Copyright szöveg -->
                    <div class="">
                        {!! $sidebars['ts_FocusDefaultTheme_sidebar_bottom_4'] !!}
                    </div>
                </div>
            </footer>
        @endif

        <script>


        </script>

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
                        <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                        <button class="pswp__button pswp__button--share" title="Share"></button>
                        <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                        <div class="pswp__preloader">
                            <div class="pswp__preloader__icn">
                                <div class="pswp__preloader__cut">
                                    <div class="pswp__preloader__donut"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                        <div class="pswp__share-tooltip"></div>
                    </div>
                    <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
                    <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
                    <div class="pswp__caption">
                        <div class="pswp__caption__center"></div>
                    </div>
                </div>
            </div>
        </div>

        @stack('scripts')
    </body>
</html>