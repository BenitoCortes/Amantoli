<div class="container py-8 grid lg:grid-cols-2 xl:grid-cols-5 gap-6">
    <div class="order-2 lg:order-1 lg:col-span-1 xl:col-span-3">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="mb-4">
                <x-jet-label value="Nombre de contacto" />
                <x-jet-input type="text" wire:model.defer="contact"
                    placeholder="Ingrese el nombre de la persona que recibira el producto" class="w-full" />
                <x-jet-input-error for="contact" />
            </div>
            <div>
                <x-jet-label value="Telefono de contacto" />
                <x-jet-input type="number" wire:model.defer="phone" placeholder="Ingrese un número de contacto"
                    class="w-full" />
                <x-jet-input-error for="phone" />
            </div>
        </div>
        <p class="mt-6 mb-3 text-lg text-gray-700 font-semibold">
            Envíos
        </p>
        <div x-data="{envio_type: @entangle('envio_type')}">
            <label class="bg-white rounded-lg shadow px-6 py-4 flex items-center mb-4">
                <input x-model="envio_type" type="radio" value="1" name="envio_type" class="text-gray-600">
                <span class="ml-2 text-gray-700">
                    Recojer en tienda (Calle falsa 123)
                </span>
                <span class="font-semibold text-gray-700 ml-auto">
                    Gratis
                </span>
            </label>
            <div class="bg-white rounded-lg shadow">
                <label class="px-6 py-4 flex items-center">
                    <input x-model="envio_type" type="radio" value="2" name="envio_type" class="text-gray-600">
                    <span class="ml-2 text-gray-700">
                        Envío a domicilio
                    </span>
                </label>
                <div class="px-6 pb-6 grid grid-cols-2 gap-6 hidden" :class="{ 'hidden': envio_type != 2 }">
                    {{-- Estados --}}
                    <div>
                        <x-jet-label value="Estado" />
                        <select class="form-control w-full" wire:model="state_id">
                            <option value="" disabled selected>Seleccione un estado</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="state_id" />
                    </div>
                    {{-- Ciudades --}}
                    <div>
                        <x-jet-label value="Ciudad" />
                        <select class="form-control w-full" wire:model="city_id">
                            <option value="" disabled selected>Seleccione una ciudad</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="city_id" />
                    </div>
                    {{-- Colonias --}}
                    <div>
                        <x-jet-label value="Colonia" />
                        <select class="form-control w-full" wire:model="colony_id">
                            <option value="" disabled selected>Seleccione una colonia</option>
                            @foreach ($colonies as $colony)
                                <option value="{{ $colony->id }}">{{ $colony->name }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="colony_id" />
                    </div>
                    <div>
                        <x-jet-label value="Dirección" />
                        <x-jet-input wire:model="address" type="text" placeholder="Ingrese la direccion de su domicilio"
                            class="w-full" />
                        <x-jet-input-error for="address" />
                    </div>
                    <div class="col-span-2">
                        <x-jet-label value="Referencia" />
                        <x-jet-input wire:model="references" type="text"
                            placeholder="Ingrese una referencia para que podamos encontrar su domicilio mas facíl"
                            class="w-full" />
                        <x-jet-input-error for="references" />
                    </div>
                </div>
            </div>
        </div>
        <div>
            <x-jet-button wire:loading.attr="disabled" wire:target="create_order" class="mt-6 mb-4"
                wire:click="create_order">
                Continuar con la compra
            </x-jet-button>
            <hr>
            <p class="text-sm text-gray-700 mt-2">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis consectetur voluptatum officiis sit
                asperiores consequatur eius, praesentium voluptatibus, mollitia amet nihil esse tempora veniam molestiae
                id voluptas velit natus accusamus?
                <a href="" class="font-semibold text-Orange-500">Politicas y privacidad</a>
            </p>
        </div>
    </div>

    <div class="order-1 lg:order-2 lg:col-span-1 xl:col-span-2">
        <div class="bg-white rounded-lg shadow p-6">
            <ul>
                @forelse (Cart::content() as $item)
                    <li class="flex p-2 border-b border-gray-200">
                        <img class="h-15 w-20 object-cover mr-4" src="{{ $item->options->image }}" alt="img-cart">
                        <article class="flex-1">
                            <h1 class="font-bold">{{ $item->name }}</h1>
                            <div class="flex">
                                <p>Cant: {{ $item->qty }}</p>
                                @isset($item->options['color'])
                                    <p class="mx-2 capitalize">- Color: {{ __($item->options['color']) }}</p>
                                @endisset
                                @isset($item->options['size'])
                                    <p>- {{ $item->options['size'] }}</p>
                                @endisset
                            </div>
                            <p>MXN {{ $item->price }}</p>
                        </article>
                    </li>
                @empty
                    <li class="py-6 px-4">
                        <p class="text-center text-gray-700 mb-3">
                            Por el momento no tiene agregado ningún producto en su carrito.
                        </p>
                    </li>
                @endforelse
            </ul>
            <hr class="mt-4 mb-3">
            <div class="text-gray-700">
                <p class="flex justify-between items-center">
                    Subtotal:
                    <span class="font-semibold">{{ Cart::subtotal() }} MXN</span>
                </p>
                <p class="flex justify-between items-center">
                    Envío
                    <span class="font-semibold">
                        @if ($envio_type == 1 || $shipping_cost == 0)
                            ¡Gratis!
                        @else
                            $MXN {{ $shipping_cost }}
                        @endif
                    </span>
                </p>
                <hr class="mt-4 mb-3">
                <p class="flex justify-between items-center font-semibold">
                    <span class="text-lg">Total</span>
                    @if ($envio_type == 1)
                        {{ Cart::subtotalFloat() }} MXN
                    @else
                        {{ Cart::subtotalFloat() + $shipping_cost }} MXN
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>
