<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Tienda online de artesanias mexicanas">
    <meta name="keywords" content="Artesanias, Ecommerce, Huasteca, Amantoli, Artesanos">
    <meta name="author" content="Amantoli">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ config('app.name', 'Laravel') }}
    </title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.7/glider.min.css"
        integrity="sha512-YM6sLXVMZqkCspZoZeIPGXrhD9wxlxEF7MzniuvegURqrTGV2xTfqq1v9FJnczH+5OGFl5V78RgHZGaK34ylVg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('vendor/FlexSlider/flexslider.css') }}">
    <style>
        .toggle-checkbox:checked {
            @apply: right-0 border-green-400;
            right: 0;
            border-color: #68D391;
        }

        .toggle-checkbox:checked+.toggle-label {
            @apply: bg-green-400;
            background-color: #68D391;
        }

    </style>
    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('multimedia/120.jpg') }}" type="image/x-icon" />
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('multimedia/120.jpg') }}" />
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('multimedia/152.jpg') }}" />
    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.7/glider.min.js"
        integrity="sha512-tHimK/KZS+o34ZpPNOvb/bTHZb6ocWFXCtdGqAlWYUcz+BGHbNbHMKvEHUyFxgJhQcEO87yg5YqaJvyQgAEEtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('vendor/FlexSlider/jquery.flexslider-min.js') }}"></script>
    {{-- Sweet Alert 2 --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Push jS -->
    <script src="{{ asset('vendor/PushJs/push.min.js') }}"></script>
    {{--  
        <script src="{{ asset('vendor/PushJs/push.min.js.map') }}"></script>
        <script src="{{ asset('vendor/PushJs/serviceWorker.min.js') }}"></script>
    --}}
    <!-- Amantoli PWA -->
    @laravelPWA
</head>


<body class="font-sans antialiased">
    <x-jet-banner />

    <div class="min-h-screen bg-gray-50">
        @livewire('navigation')
        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')
    <nav id="footer" class="bg-trueGray-700">
        <!-- start container -->
        <div class="container mx-auto pt-8 pb-4">
            <div class="flex flex-wrap overflow-hidden sm:-mx-1 md:-mx-px lg:-mx-2 xl:-mx-2">

                <div
                    class="w-full overflow-hidden sm:my-1 sm:px-1 sm:w-1/2 md:my-px md:px-px md:w-1/2 lg:my-2 lg:px-2 lg:w-1/4 xl:my-2 xl:px-2 xl:w-1/4 pb-6">
                    <!-- Column 1 Content -->
                    <div class="items-center justify-between text-center">
                        <div class="flex justify-center">
                            <x-jet-application-mark color="#fff" size="200" />
                        </div>
                        <div>
                            <i class="text-white">Hecho a mano, hecho con el corazón.</i>
                        </div>
                    </div>
                </div>
                <div
                    class="w-full overflow-hidden sm:my-1 sm:px-1 sm:w-1/2 md:my-px md:px-px md:w-1/2 lg:my-2 lg:px-2 lg:w-1/4 xl:my-2 xl:px-2 xl:w-1/4 pb-6">
                    <!-- Column 2 Content -->
                    <h4 class="text-white text-lg font-semibold text-center">Elige cómo pagar</h4>
                    <div class="text-center">
                        <p class="text-white leading-7 text-sm">
                            Puedes pagar con el metodo que mas te guste, con Mercado Pago, PayPal, paga con tarjeta,
                            débito o efectivo. También puedes pagar en hasta 12
                            mensualidades sin tarjeta con Mercado Crédito.
                        </p>
                        <a href="" class="text-white underline hover:text-gray-300">Ver más detalles</a>
                    </div>
                </div>
                <div
                    class="w-full overflow-hidden sm:my-1 sm:px-1 sm:w-1/2 md:my-px md:px-px md:w-1/2 lg:my-2 lg:px-2 lg:w-1/4 xl:my-2 xl:px-2 xl:w-1/4 pb-6">
                    <!-- Column 3 Content -->
                    <h4 class="text-white text-lg font-semibold text-center">Envío a todo México</h4>
                    <div class="text-center">
                        <p class="text-white leading-7 text-sm">
                            En Amantoli nos encargamos de llevar tus artesanias favoritas hasta la puerta de tu hogar.
                        </p>
                        <a href="" class="text-white underline hover:text-gray-300">Ver más detalles</a>
                    </div>
                </div>
                <div
                    class="w-full overflow-hidden sm:my-1 sm:px-1 sm:w-1/2 md:my-px md:px-px md:w-1/2 lg:my-2 lg:px-2 lg:w-1/4 xl:my-2 xl:px-2 xl:w-1/4 pb-6">
                    <!-- Column 4 Content -->
                    <h4 class="text-white text-lg font-semibold text-center">Apoya a los artesanos mexicanos</h4>
                    <div class="text-center">
                        <p class="text-white leading-7 text-sm">
                            Amantoli cree en los artesanos y la calidad de su trabajo por eso ponemos a tu disposición
                            las mejores artesanias de mexico.
                        </p>
                        <a href="" class="text-white underline hover:text-gray-300">Ver más detalles</a>
                    </div>
                </div>
            </div>
            <!-- Start footer bottom -->
            <div class="pt-4 md:flex md:items-center md:justify-center " style="border-top:1px solid white">
                <ul class="">
                    <li class="md:mx-2 md:inline leading-7 text-sm" id="footer-navi-2"><a
                            class="text-white underline text-small" href="/disclaimer">{{ __('Disclaimer') }}</a>
                    </li>
                    <li class="md:mx-2 md:inline leading-7 text-sm" id="footer-navi-2"><a
                            class="text-white underline text-small" href="/cookie">{{ __('Cookie policy') }}</a></li>
                    <li class="md:mx-2 md:inline leading-7 text-sm" id="footer-navi-2"><a
                            class="text-white underline text-small" href="/privacy">{{ __('Privacy') }}</a></li>
                    <li class="md:mx-2 md:inline leading-7 text-sm" id="footer-navi-2"><a
                            class="text-white underline text-small" href="/privacy">{{ __('Contact Us') }}</a></li>
                    <li class="md:mx-2 md:inline leading-7 text-sm" id="footer-navi-2"><a
                        class="text-white underline text-small" href="/aboutus">{{ __('About us') }}</a></li>
                </ul>
            </div>
            <!-- end container -->
        </div>
    </nav>
    @livewireScripts
    <script>
        function dropdown() {
            return {
                open: false,
                show() {
                    if (this.open) {
                        //Se cierra el menu
                        this.open = false;
                        document.getElementsByTagName('html')[0].style.overflow = 'auto'
                    } else {
                        //Abre el menu
                        this.open = true;
                        document.getElementsByTagName('html')[0].style.overflow = 'hidden'
                    }
                },
                close() {
                    this.open = false;
                    document.getElementsByTagName('html')[0].style.overflow = 'auto'
                }
            }
        }
    </script>
    @stack('script')
</body>
</html>
