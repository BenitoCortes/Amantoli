<div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                    Productos
                </h1>
                <x-jet-danger-button wire:click="$emit('deleteProduct')">
                    Eliminar
                </x-jet-danger-button>
            </div>
        </div>
    </header>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">
        <h1 class="text-3xl text-center font-semibold mb-8">
            Rellene el formulario para actualizar el producto
        </h1>
        <div class="mb-4" wire:ignore>
            <form action="{{ route('admin.products.files', $product) }}" method="POST" class="dropzone"
                id="my-awesome-dropzone">
            </form>
        </div>
        @if ($product->images->count())
            <section class="bg-white shadow-lg rounded-lg p-6 mb-4">
                <h1 class="text-2xl text-center font-semibold mb-2">Imagenes del Producto</h1>
                <ul class="flex flex-wrap">
                    @foreach ($product->images as $image)
                        <li class="relative" wire:key="image-{{ $image->id }}">
                            <img class="w-32 h-20 object-cover" src="{{ Storage::url($image->url) }}"
                                alt="Image-{{ $image->id }}">
                            <x-jet-danger-button class="absolute right-2 top-2"
                                wire:click="deleteImage({{ $image->id }})" wire:loading.attr="disable"
                                wire:target="deleteImage">
                                <i class="fas fa-trash"></i>
                            </x-jet-danger-button>
                        </li>
                    @endforeach
                </ul>
                <br>
                <x-jet-action-message class="mr-3" on="deleted">
                    <span class="bg-green-700 text-green-100 p-4 rounded-lg">
                        ??Eliminado!
                        <i class="fas fa-check"></i>
                    </span>
                </x-jet-action-message>
            </section>
        @endif
        @livewire('admin.status-product', ['product' => $product], key('status-product-' . $product->id))
        <div class="bg-white shadow-xl rounded-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                {{-- Categor??a --}}
                <div>
                    <x-jet-label value="Categor??a" />
                    <select class="form-control w-full" wire:model="category_id">
                        <option value="" selected disabled>Seleccione una categor??a</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="category_id" />
                </div>
                {{-- Subcategor??a --}}
                <div>
                    <x-jet-label value="Subcategor??as" />
                    <select class="form-control w-full" wire:model="product.subcategory_id">
                        <option value="" selected disabled>Seleccione una subcategor??a</option>
                        @foreach ($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="product.subcategory_id" />
                </div>
            </div>
            <div class="mb-4">
                {{-- Nombre --}}
                <x-jet-label value="Nombre" />
                <x-jet-input class="w-full" type="text" wire:model="product.name"
                    placeholder="Ingrese el nombre del producto" />
                <x-jet-input-error for="product.name" />
                {{-- Slug --}}
                <x-jet-label value="Slug" />
                <x-jet-input disabled class="w-full bg-gray-200" type="text" wire:model="slug"
                    placeholder="Slug del producto" />
                <x-jet-input-error for="slug" />

            </div>
            {{-- Descripci??n --}}
            <div class="mb-4">
                <div wire:ignore>
                    <x-jet-label value="Descripci??n" />
                    <textarea class="w-full form-control" rows="4" wire:model="product.description" x-data x-init="
                    ClassicEditor
                    .create( $refs.miEditor )
                    .then(function(editor){
                        editor.model.document.on('change:data', () => {
                            @this.set('product.description',editor.getData())
                        })
                    })
                    .catch( error => {
                        console.error( error );
                    } );" x-ref="miEditor"></textarea>
                </div>
                <x-jet-input-error for="product.description" />
            </div>

            <div class="grid grid-cols-2 gap-6 mb-4">
                {{-- Marca --}}
                <div>
                    <x-jet-label value="Marca" />
                    <select class="form-control w-full" wire:model="product.brand_id">
                        <option value="" selected disabled>Seleccione una marca</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="product.brand_id" />
                </div>
                {{-- Precio --}}
                <div>
                    <x-jet-label value="Precio" />
                    <x-jet-input wire:model="product.price" type="number" class="w-full" placeholder="0.00"
                        step=".01" />
                    <x-jet-input-error for="product.price" />
                </div>
            </div>
            @if ($this->subcategory)
                @if (!$this->subcategory->color && !$this->subcategory->size)
                    <div>
                        <x-jet-label value="Cantidad" />
                        <x-jet-input wire:model="product.quantity" type="number" class="w-full" placeholder="0" />
                        <x-jet-input-error for="product.quantity" />
                    </div>

                @endif
            @endif
            <div class="flex justify-end items-center mt-4">
                <x-jet-action-message class="mr-3" on="saved">
                    <span class="bg-green-700 text-green-100 p-4 rounded-lg">
                        ??Actualizado!
                        <i class="fas fa-check"></i>
                    </span>
                </x-jet-action-message>
                <x-jet-button wire:loading.attr="disabled" wire:target="save" wire:click="save" class="ml-auto mt-4">
                    <i class="fas fa-spinner animate-spin text-white text-lg" wire:loading wire:target="save"></i>
                    Actualizar producto
                </x-jet-button>
            </div>
        </div>
        @if ($this->subcategory)

            @if ($this->subcategory->size)
                @livewire('admin.size-product', ['product' => $product], key('size-product-'.$product->id))
            @elseif($this->subcategory->color)
                @livewire('admin.color-product', ['product' => $product], key('color-product-'.$product->id))
            @endif

        @endif
    </div>
    @push('script')
        <script>
            Dropzone.options.myAwesomeDropzone = {
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                dictDefaultMessage: "Arrastre o seleccione las imagenes del producto aqu??",
                acceptedFiles: "image/*",
                paramName: "file",
                maxFilesize: 2,
                complete: function(file) {
                    this.removeFile(file);
                },
                queuecomplete: function() {
                    Livewire.emit('refreshProduct');
                }
            };
            livewire.on('deleteSize', sizeId => {
                Swal.fire({
                    title: '??Estas seguro?',
                    text: "No podras revertir esta acci??n",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Eliminar registro',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        livewire.emitTo('admin.size-product', 'delete', sizeId);
                        Swal.fire(
                            '??Eliminado!',
                            'El registro ha sido eliminado con exito.',
                            'success'
                        )
                    }
                })
            })
            livewire.on('deleteColorSize', pivot => {
                Swal.fire({
                    title: '??Estas seguro?',
                    text: "No podras revertir esta acci??n",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Eliminar registro',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        livewire.emitTo('admin.color-size', 'delete', pivot);
                        Swal.fire(
                            '??Eliminado!',
                            'El registro ha sido eliminado con exito.',
                            'success'
                        )
                    }
                })
            })
            livewire.on('deleteProduct', () => {
                Swal.fire({
                    title: '??Estas seguro?',
                    text: "No podras revertir esta acci??n",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Eliminar registro',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        livewire.emitTo('admin.edit-product', 'delete');
                        Swal.fire(
                            '??Eliminado!',
                            'El registro ha sido eliminado con exito.',
                            'success'
                        )
                    }
                })
            })
        </script>
    @endpush
</div>
