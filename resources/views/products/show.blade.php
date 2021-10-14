<x-app-layout>
    <div class="container py-8">
        <nav class="p-3 rounded font-sans w-full" aria-label="breadcrumb">
            <ol class="flex leading-none text-indigo-600 divide-x divide-indigo-400">
                <li class="pr-4"><a href="#">Inicio</a></li>
                <li class="px-4 text-gray-700" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
            {{-- Imagenes de los productos --}}

            <div>
                <div class="flexslider">
                    <ul class="slides">
                        @foreach ($product->images as $image)
                            @if ($product->images->count())
                                <li data-thumb="{{ Storage::url($image->url) }}">
                                    <img src="{{ Storage::url($image->url) }}" />
                                </li>
                            @else
                                <x-icon-product-deafult />
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="-mt-10 text-gray-700">
                    <h2 class="font-bold text-lg">Descripción</h2>
                    {!! $product->description !!}
                </div>
            </div>
            {{-- Contenido derecho --}}
            <div>
                <h1 class="text-xl font-bold text-trueGray-700">{{ $product->name }}</h1>
                <div class="flex">
                    <p class="text-trueGray-700">Marca: <a class="underline capitalize hover:text-Orange-500"
                            href="">{{ $product->brand->name }}</a>
                    </p>
                    <p class="text-trueGray-700 mx-6">5 <i class="fas fa-star text-sm text-yellow-400"></i></p>
                    <a class="text-Orange-500 hover:text-Orange-600 underline" href="">39 reseñas</a>
                    @livewire('add-favorite-item', ['product' => $product])
                </div>
                <p class="text-2xl font-semibold text-trueGray-700 my-4">$MXN {{ $product->price }}</p>
                <div class="bg-white rounded-lg shadow-lg mb-6">
                    <div class="p-4 flex items-center">
                        <span class="flex items-center justify-center h-10 w-10 rounded-full bg-greenLime-600">
                            <i class="fas fa-truck text-sm text-white"></i>
                        </span>
                        <div class="ml-4">
                            <p class="text-lg font-semibold text-greenLime-600">Se hacen envíos a todo México</p>
                            <p>Recibelo el {{ Date::now()->addDay(7)->locale('es')->format('l j F') }}</p>
                        </div>
                    </div>
                </div>
                @if ($product->subcategory->size)
                    @livewire('add-cart-item-size', ['product' => $product])
                @elseif($product->subcategory->color)
                    @livewire('add-cart-item-color', ['product' => $product])
                @else
                    @livewire('add-cart-item', ['product' => $product])
                @endif
            </div>
        </div>
    </div>
    @push('script')
        <script>
            $(document).ready(function() {
                $('.flexslider').flexslider({
                    animation: "slide",
                    controlNav: "thumbnails"
                });
            });
        </script>
    @endpush
</x-app-layout>
