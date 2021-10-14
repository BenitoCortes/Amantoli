<div>
    <!-- Formulario categorias -->
    <x-jet-form-section submit="save" class="mb-6">
        <x-slot name="title">
            Crear nueva categoria
        </x-slot>
        <x-slot name="description">
            Complete el formulario para crear una categoría
        </x-slot>
        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label value="Nombre" />
                <x-jet-input wire:model="createForm.name" type="text" class="w-full mt-1" />
                <x-jet-input-error for="createForm.name" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label value="URL amigable" />
                <x-jet-input wire:model="createForm.slug" disabled type="text" class="w-full mt-1 bg-gray-100" />
                <x-jet-input-error for="createForm.slug" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label value="Icono" />
                <x-jet-input wire:model.defer="createForm.icon" type="text" class="w-full mt-1" />
                <x-jet-input-error for="createForm.icon" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label value="Marcas" />
                <div class="grid grid-cols-4">
                    @foreach ($brands as $brand)
                        <x-jet-label>
                            <x-jet-checkbox wire:model.defer="createForm.brands" name="brands[]"
                                value="{{ $brand->id }}" />
                            {{ $brand->name }}
                        </x-jet-label>
                    @endforeach
                </div>
                <x-jet-input-error for="createForm.brands" />
                <div
                    class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in my-1">
                    <input type="checkbox" onclick="marcar(this);"
                        class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer" />
                    <label
                        class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                </div>
                <span class="ml-2 text-sm text-gray-600">{{ __('Marcar/Desmarcar Todos') }}</span>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label value="Imagen" />
                <input wire:model="createForm.image" type="file" class="mt-1" name="" id="{{ $rand }}"
                    accept="image/*">
                <x-jet-input-error for="createForm.image" />
            </div>
        </x-slot>
        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">
                <span class="bg-green-700 text-green-100 p-4 rounded-lg">
                    ¡Agregado!
                    <i class="fas fa-check"></i>
                </span>
            </x-jet-action-message>
            <x-jet-button>
                <i class="fas fa-spinner animate-spin text-white text-lg" wire:loading wire:target="save"></i>
                Agregar
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>
    <!-- Tablas categorias -->
    <x-jet-action-section>
        <x-slot name="title">
            Lista de categorias
        </x-slot>
        <x-slot name="description">
            - Aquí encontrara todas las categorias registradas
            <br>
            - Para agregar una o varias subcategrias pulse sobre una categoria de la tabla
        </x-slot>
        <x-slot name="content">
            <x-table-responsive>
                <table class="text-gray-600">
                    <thead class="border-b border-gray-300">
                        <tr class="text-left">
                            <th class="py-2 w-full">Nombre</th>
                            <th class="py-2">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300">
                        @foreach ($categories as $category)
                            <tr>
                                <td class="py-2">
                                    <span class="inline-block w-8 text-center mr-2">
                                        {!! $category->icon !!}
                                    </span>
                                    <a href="{{ route('admin.categories.show', $category) }}"
                                        class="uppercase underline hover:text-blue-600">
                                        {{ $category->name }}
                                    </a>
                                </td>
                                <td class="py-2">
                                    <div class="flex divide-x divide-gray-300">
                                        <a class="pr-2 hover:text-blue-700 cursor-pointer"
                                            wire:click="edit('{{ $category->slug }}')">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a class="pl-2 hover:text-red-700 cursor-pointer"
                                            wire:click="$emit('deleteCategory','{{ $category->slug }}')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </x-table-responsive>
            <div class="mr-3" wire:loading wire:model="delete">
                <span class="text-gray-700 p-2 rounded-lg">
                    <i class="fas fa-spinner animate-spin text-Orange-700"></i>
                    Eliminando...
                </span>
            </div>
            <x-jet-action-message class="mr-3" on="deleted">
                <span class="bg-green-700 text-green-100 p-2 rounded-lg">
                    ¡Eliminado!
                    <i class="fas fa-check"></i>
                </span>
            </x-jet-action-message>
        </x-slot>
    </x-jet-action-section>
    <!-- Modal editar categoria -->
    <x-jet-dialog-modal wire:model="editForm.open">
        <x-slot name="title">
            Editar Categorias
        </x-slot>
        <x-slot name="content">
            <div class="space-y-3">
                <div>
                    @if ($editImage)
                        <img class="w-30 sm:w-full sm:h-64 object-cover object-center"
                            src="{{ $editImage->temporaryUrl() }}" alt="img-{{ $editForm['slug'] }}"
                            wire:model="editImage">
                    @else
                        <img class="w-30 sm:w-full sm:h-64 object-cover object-center"
                            src="{{ Storage::url($editForm['image']) }}" alt="img-{{ $editForm['slug'] }}">
                    @endif
                    <div wire:loading wire:target="editImage">

                        <i class="fas fa-spinner animate-spin text-Orange-700"></i>
                        <span>Cargando imagen...</span>
                    </div>

                </div>
                <div>
                    <x-jet-label value="Nombre" />
                    <x-jet-input wire:model="editForm.name" type="text" class="w-full mt-1" />
                    <x-jet-input-error for="editForm.name" />
                </div>
                <div>
                    <x-jet-label value="URL amigable" />
                    <x-jet-input wire:model="editForm.slug" disabled type="text" class="w-full mt-1 bg-gray-100" />
                    <x-jet-input-error for="editForm.slug" />
                </div>
                <div>
                    <x-jet-label value="Icono" />
                    <x-jet-input wire:model.defer="editForm.icon" type="text" class="w-full mt-1" />
                    <x-jet-input-error for="editForm.icon" />
                </div>
                <div>
                    <x-jet-label value="Marcas" />
                    <div class="grid grid-cols-4">
                        @foreach ($brands as $brand)
                            <x-jet-label>
                                <x-jet-checkbox wire:model.defer="editForm.brands" name="brands[]"
                                    value="{{ $brand->id }}" />
                                {{ $brand->name }}
                            </x-jet-label>
                        @endforeach
                    </div>
                    <x-jet-input-error for="editForm.brands" />
                    <div
                        class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in my-1">
                        <input type="checkbox" onclick="marcar(this);"
                            class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer" />
                        <label
                            class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                    </div>
                    <span class="ml-2 text-sm text-gray-600">{{ __('Marcar/Desmarcar Todos') }}</span>
                </div>
                <div>
                    <x-jet-label value="Imagen" />
                    <input wire:model="editImage" type="file" class="mt-1" name="" {{-- id="{{ $rand }}" --}}
                        accept="image/*">
                    <x-jet-input-error for="editImage" />
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="editImage, update">
                Actualizar
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

    @push('script')
        <script>
            function marcar(source) {
                checkboxes = document.getElementsByTagName('input');
                for (i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i].type == "checkbox") {
                        checkboxes[i].checked = source
                            .checked;
                    }
                }
            }
        </script>
    @endpush
</div>
