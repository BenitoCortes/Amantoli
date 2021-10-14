<div class="container py-12">
    <!-- Formulario marcas -->
    <x-jet-form-section class="mb-6" submit="save">
        <x-slot name="title">
            Agregar marca
        </x-slot>
        <x-slot name="description">
            En esta seccion podra agregar una nueva marca
        </x-slot>
        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label value="Nombre" />
                <x-jet-input type="text" wire:model="createForm.name" class="w-full" />
                <x-jet-input-error for="createForm.name" />
            </div>
        </x-slot>
        <x-slot name="actions">
            <x-jet-button>
                <i class="fas fa-spinner animate-spin text-white text-lg" wire:loading wire:target="save"></i>
                Agregar
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>
    <!-- Tabla marcas -->
    <x-jet-action-section>
        <x-slot name="title">
            Lista de marcas
        </x-slot>
        <x-slot name="description">
            Aquí encontrara todas las marcas registradas
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
                        @foreach ($brands as $brand)
                            <tr>
                                <td class="py-2">
                                    <span class="uppercase">
                                        {{ $brand->name }}
                                    </span>
                                </td>
                                <td class="py-2">
                                    <div class="flex divide-x divide-gray-300">
                                        <a class="pr-2 hover:text-blue-700 cursor-pointer"
                                            wire:click="edit('{{ $brand->id }}')">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a class="pl-2 hover:text-red-700 cursor-pointer"
                                            wire:click="$emit('deleteBrand','{{ $brand->id }}')">
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
    <!-- Modal marcas -->
    <x-jet-dialog-modal wire:model="editForm.open">
        <x-slot name="title">
            Editar marca
        </x-slot>
        <x-slot name="content">
            <x-jet-label value="Nombre" />
            <x-jet-input type="text" class="w-full" wire:model="editForm.name" />
            <x-jet-input-error for="editForm-name" />
        </x-slot>
        <x-slot name="footer">
            <x-jet-danger-button wire:click="update" wire:loadig.attr="disabled" wire:targer="update">
                <i class="fas fa-spinner animate-spin text-white text-lg" wire:loading wire:target="update"></i>
                Actualizar
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

    @push('script')
        <script>
            livewire.on('deleteBrand', brandId => {
                Swal.fire({
                    title: '¿Estas seguro?',
                    text: "No podras revertir esta acción",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Eliminar registro',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        livewire.emitTo('admin.brand-component', 'delete', brandId);
                        Swal.fire(
                            '¡Eliminado!',
                            'El registro ha sido eliminado con exito.',
                            'success'
                        )
                    }
                })
            })
        </script>
    @endpush

</div>
