<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-preloader="enable">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
            <canvas class="particles-js-canvas-el" width="3166" height="760"
                style="width: 100%; height: 100%;"></canvas>
        </div>
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="index.html" class="d-inline-block auth-logo">
                                    <img src="assets/images/logo-light.png" alt="" height="20">
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

                {{ $slot }}
            </div>
        </div>

    </div>
    <script src="{{ Vite::asset('resources/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ Vite::asset('resources/assets/libs/particles.js/particles.js') }}"></script>
    <script src="{{ Vite::asset('resources/assets/js/pages/particles.app.js') }}"></script>
    {{-- <script src="{{ Vite::asset('resources/assets/js/pages/password-addon.init.js') }}"></script> --}}
    <script src="{{ Vite::asset('resources/assets/js/pages/form-validation.init.js') }}"></script>
    <script src="{{ Vite::asset('resources/assets/js/pages/passowrd-create.init.js') }}"></script>

</body>

</html>
