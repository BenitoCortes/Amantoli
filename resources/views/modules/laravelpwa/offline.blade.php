<x-app-layout>

    <div class="container text-center py-12">
        <div class="flex flex-col items-center bg-cover">
            <x-no-connection />
        </div>
        <p class="py-6 font-semibold">Ooops, Al parecer estas fuera de linea</p>
        <a href="{{ route('orders.index') }}" class="text-white font-bold text-lg bg-indigo-500 hover:bg-indigo-600 cursor-pointer p-6 rounded-md">
            <span>
                <i class="fas fa-truck"></i> Ver mis ordenes 
            </span>
        </a>
        <div>       
            <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-4 mt-12 mb-12">
                <article>
                    <h2 class="text-2xl font-extrabold text-trueGray-700">¿Sabías qué...?</h2>
                    <section class="mt-6 grid md:grid-cols-2 lg:grid-cols-2 gap-x-6 gap-y-8">
                        <article onclick="alert1()" class="bg-white group relative rounded-lg cursor-pointer overflow-hidden shadow-lg hover:shadow-2xl transform duration-200">
                            <div class="relative w-full h-80 md:h-64 lg:h-44">
                                <img src="{{ asset('multimedia/imgoffline/arte1.jpg') }}"
                                    alt="Desk with leather desk pad, walnut desk organizer, wireless keyboard and mouse, and porcelain mug."
                                    class="w-full h-full object-center object-cover">
                            </div>
                            <div class="px-3 py-4">
                                <h3 class="text-sm text-gray-500 pb-2">
                                    <a class="bg-Orange-500 py-1 px-2 text-white rounded-lg">
                                        <span class="absolute inset-0"></span>
                                        Economia
                                    </a>
                                </h3>
                                <p class="text-base font-semibold text-trueGray-700 group-hover:text-indigo-600">
                                    La actividad artesanal era quien marcaba la tendencia del mercado de los huastecos, con una producción basta de textiles y objetos de barro, que se realizaban a través de pequeñas unidades familiares...
                                </p>
                            </div>
                        </article>
                        <article onclick="alert2()" class="bg-white group relative cursor-pointer rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transform duration-200">
                            <div class="relative w-full h-80 md:h-64 lg:h-44">
                                <img src="{{ asset('multimedia/imgoffline/arte2.jpg') }}"
                                    alt="Desk with leather desk pad, walnut desk organizer, wireless keyboard and mouse, and porcelain mug."
                                    class="w-full h-full object-center object-cover">
                            </div>
                            <div class="px-3 py-4">
                                <h3 class="text-sm text-gray-500 pb-2">
                                    <a class="bg-Orange-500 py-1 px-2 text-white rounded-lg">
                                        <span class="absolute inset-0"></span>
                                        Información
                                    </a>
                                </h3>
                                <p class="text-base font-semibold text-trueGray-700 group-hover:text-indigo-600">
                                    Gran parte de la población de artesanos, pertenece a grupos indígenas que viven en localidades rurales...
                                </p>
                            </div>
                        </article>
                    </section>
                </article>
            </section>
        </div>
        <a href="/aboutus" class="text-white font-bold text-lg bg-Orange-500 hover:bg-Orange-600 cursor-pointer p-6 rounded-md">
            <span>
                <i class="fas fa-user-friends"></i> Acerca de nosotros
            </span>
        </a>
    </div>
    <script>
        function alert1(){
            Swal.fire({
            title: '¿Sabías qué...?',
            text: 'La actividad artesanal era quien marcaba la tendencia del mercado de los huastecos, con una producción basta de textiles y objetos de barro, que se realizaban a través de pequeñas unidades familiares.'+
                    'En la actualidad pese a algunas riquezas que aun se conservan en algunas pequeñas regiones es frecuente que los huastecos migren en busca de ingresos alternativos, lo que en su mayoría implica un éxodo total de estos.'+
                    'Para complementar los ingresos los campesinos huastecos crían aves de corral y realizan actividades de artesanías, que son valoradas por las comunidades oaxaqueñas.',
            imageUrl: "{{ asset('multimedia/imgoffline/arte1.jpg') }}",
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Imagen articulo',
        })
        }
        function alert2(){
            Swal.fire({
            title: '¿Sabías qué...?',
            text: 'Gran parte de la población de artesanos, pertenece a grupos indígenas que viven en localidades rurales, de acuerdo con la información recabada del FONART a partir de la categorización por regiones elaborada por el INEGI (FONART, 2009), el mayor porcentaje de población potencial 40.3% (148,004 personas aproximadamente) habita en la región 2, comprendida por los estados de Campeche, Hidalgo, Puebla, San Luis Potosí, Tabasco y Veracruz dentro de los cuales se destacan las actividades de bordadores, hiladores a mano, alfareros, trabajadores ceramistas y tejedores de fibras.',
            imageUrl: "{{ asset('multimedia/imgoffline/arte2.jpg') }}",
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Imagen articulo',
        })
        }
    </script>
</x-app-layout>
