<div>
    @php
        // SDK de Mercado Pago
        require base_path('/vendor/autoload.php');
        // Agrega credenciales
        MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));
        // Crea un objeto de preferencia
        $preference = new MercadoPago\Preference();
        
        $shipments = new MercadoPago\Shipments();
        $shipments->cost = $order->shipping_cost;
        $shipments->mode = 'not_specified';
        $preference->shipments = $shipments;
        
        // Crea un ítem en la preferencia
        foreach ($items as $product) {
            $item = new MercadoPago\Item();
            $item->title = $product->name;
            $item->quantity = $product->qty;
            $item->unit_price = $product->price;
            $products[] = $item;
        }
        
        $preference->back_urls = [
            'success' => route('orders.pay', $order),
            'failure' => 'http://www.tu-sitio/failure',
            'pending' => 'http://www.tu-sitio/pending',
        ];
        
        $preference->auto_return = 'approved';
        $preference->items = $products;
        $preference->save();
    @endphp
    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-5 gap-6 container py-8">
        <div class="order-2 lg:order-1 xl:col-span-3 lg:grid-cols-1 ">
            <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6">
                <p class="text-gray-700 uppercase">
                    <span class="font-semibold">
                        Número de orden: Orden-{{ $order->id }}
                    </span>
                </p>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <div class="grid grid-cols-2 gap-6 text-gray-700">
                    <div>
                        <p class="text-lg font-semibold uppercase">Envío</p>
                        @if ($order->envio_type == 1)
                            <p class="text-sm">Los productos deben se recogidos en tienda</p>
                            <p class="text-sm">Calle falsa 123</p>
                        @else
                            <p class="text-sm">Los productos se enviarán a: </p>
                            <p class="text-sm">{{ $envio->address }}</p>
                            <p>{{ $envio->state }} - {{ $envio->city }} - {{ $envio->colony }}
                            </p>
                        @endif
                    </div>
                    <div>
                        <p class="text-lg font-semibold uppercase">
                            Datos de contacto
                        </p>
                        <p class="text-sm">Persona que recibira el producto: {{ $order->contact }}</p>
                        <p class="text-sm">Tel. de contacto: {{ $order->phone }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6 text-gray-700 mb-6">
                <p class="text-xl font-semibold mb-4">
                    Resumen de compra
                </p>
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Precio</th>
                            <th>Cant</th>
                            <th>Total</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        {{-- Hay o habia un problema con esto y es que al foreach solo se le puede pasar como argumento un arry o un objeto
                                sin embargo lo que nosotros queremos pasar es una cadena json para solucionar esto hay que decodificarlo y 
                                convertirlo en un array --}}
                        @foreach ($items as $item)
                            <tr>
                                <td>
                                    <div class="flex">
                                        <img class="h-15 w-20 object-cover mr-4" src="{{ $item->options->image }}"
                                            alt="{{ $item->name }}">
                                        <article>
                                            <h1 class="font-bold">
                                                {{ $item->name }}
                                            </h1>
                                            <div class="text-xs">
                                                @isset($item->options->color)
                                                    Color: {{ __($item->options->color) }}
                                                @endisset
                                                @isset($item->options->size)
                                                    - {{ $item->options->size }}
                                                @endisset
                                            </div>
                                        </article>
                                    </div>
                                </td>
                                <td class="text-center">
                                    {{ $item->price }} MXN
                                </td>
                                <td class="text-center">
                                    {{ $item->qty }}
                                </td>
                                <td class="text-center">
                                    {{ $item->price * $item->qty }} MXN
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="order-1 lg:order-2 xl:col-span-2 lg:grid-cols-1">
            <div class="bg-white rounded-lg shadow-lg px-6 pt-6">
                <div class="flex justify-between items-center">
                    <img src="https://imgmp.mlstatic.com/org-img/banners/mx/medios/MLM_120X240_new.jpg"
                        title="Mercado Pago - Medios de pago" alt="Mercado Pago - Medios de pago" width="120"
                        height="240" />
                    <div class="text-gray-700">
                        <p class="text-sm font-semibold">
                            Subtotal: {{ $order->total - $order->shipping_cost }} MXN
                        </p>
                        <p class="text-sm font-semibold">
                            Envío: {{ $order->shipping_cost }} MXN
                        </p>
                        <p class="text-lg font-bold uppercase">
                            Pago: {{ $order->total }} MXN
                        </p>
                    </div>
                </div>
                {{-- Botón de pago de mercado pago --}}
                <div class="cho-container mb-3 mt-2"></div>
                {{-- Espacio para PayPal --}}
                <div id="paypal-button-container" class="w-full"></div>
            </div>
        </div>
    </div>

    @push('script')
        {{-- SDK Mercado Pago --}}
        <script src="https://sdk.mercadopago.com/js/v2"></script>
        <script>
            // Agrega credenciales de SDK
            const mp = new MercadoPago("{{ config('services.mercadopago.key') }}", {
                locale: 'es-AR'
            });

            // Inicializa el checkout
            mp.checkout({
                preference: {
                    id: '{{ $preference->id }}'
                },
                render: {
                    container: '.cho-container', // Indica dónde se mostrará el botón de pago
                    label: 'Pagar con mercado pago', // Cambia el texto del botón de pago (opcional)
                }
            });
        </script>

        {{-- SDK PayPal --}}
        <script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}">
        </script>
        <script>
            paypal.Buttons({
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: "{{ $order->total }}"
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        Livewire.emit('payOrder');
                        //alert('Transacción completa por:  ' + details.payer.name.given_name);
                    });
                }
            }).render('#paypal-button-container'); // Display payment options on your web page
        </script>
    @endpush
</div>
