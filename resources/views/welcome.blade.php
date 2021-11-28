<x-app-layout>
    <div class="">
        @livewire('show-slider')
    </div>
    <div class="container py-8">
        @foreach ($categories as $category)
            <section class="mb-6">
                <div class="flex items-center mb-2">
                    <h1 class="text-lg uppercase font-semibold text-gray-700">
                        {{ $category->name }}
                    </h1>
                    <a href="{{ route('categories.show', $category) }}"
                        class="text-Orange-500 hover:text-Orange-400 hover:underline ml-2 font-semibold">
                        Ver más
                    </a>
                </div>
                @livewire('category-products', ['category' => $category])
            </section>
        @endforeach
    </div>
    @push('script')
        <script>
            livewire.on('glider', function(id) {
                new Glider(document.querySelector('.glider-' + id), {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    draggable: true,
                    dots: '.glider-' + id + '~ .dots',
                    arrows: {
                        prev: '.glider-' + id + '~ .glider-prev',
                        next: '.glider-' + id + '~ .glider-next'
                    },
                    responsive: [{
                            breakpoint: 640,
                            settings: {
                                slidesToShow: 2.5,
                                slidesToScroll: 2,
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 3.5,
                                slidesToScroll: 3,
                            }
                        },
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 4.5,
                                slidesToScroll: 4,
                            }
                        },
                        {
                            breakpoint: 1280,
                            settings: {
                                slidesToShow: 5.5,
                                slidesToScroll: 5,
                            }
                        },
                    ]
                });
            });
        </script>
        <script>
            //Push.Permission.request(onGranted, onDenied);
            if(Push.Permission.has(Push.Permission.GRANTED))
            {
                Push.create("Hola, saludos desde Amantoli", {
                    body: "Gracias por activar las notificacciones",
                    icon: '{{ asset('multimedia/152.jpg') }}',
                    timeout: 4000,
                    onClick: function () {
                        window.focus();
                        this.close();
                        
                    }
                });
                Push.config({
                    serviceWorker: '{{ asset('vendor/PushJs/serviceWorker.min.js') }}',
                });
            }
            
            /*
            if(Push.Permission.has(Push.Permission.DEFAULT)){
                Push.create("Gracias por activar las notificaciones", {
                body: "Ahora recibira las noticias de nuestra pagína",
                icon: '{{ asset('multimedia/152.jpg') }}',
                timeout: 4000,
                onClick: function () {
                    window.focus();
                    this.close();
                }
                });
            }
            */
        </script>
    @endpush
</x-app-layout>