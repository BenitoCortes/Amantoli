<div class="mt-4">
    <div class=" bg-gray-100 dark:bg-gray-800 shadow-xl rounded-lg p-6">
        {{-- Color --}}
        <div class="mb-6">
            <x-jet-label value="Color" />
            <div class="grid grid-cols-6 gap-2">
                @foreach ($colors as $color)
                    <label>
                        <input type="radio" name="color_id" value="{{ $color->id }}" wire:model.defer="color_id">
                        <span class="ml-2 text-gray-700 capitalize">
                            {{ __($color->name) }}
                        </span>
                    </label>
                @endforeach
            </div>
            <x-jet-input-error for="color_id" />
        </div>
        {{-- Cantidad --}}
        <div>
            <x-jet-label value="Cantidad" />
            <x-jet-input type="number" wire:model.defer="quantity" placeholder="Ingrese una cantidad" class="w-full" />
            <x-jet-input-error for="quantity" />
        </div>
        <div class="flex justify-end items-center mt-4">
            <x-jet-action-message class="mr-3" on="saved">
                <span class="bg-green-700 text-green-100 p-4 rounded-lg">
                    ¡Agregado!
                    <i class="fas fa-check"></i>
                </span>
            </x-jet-action-message>
            <x-jet-button wire:loading.attr="disabled" wire:target="save" wire:click="save" class="ml-auto mt-4">
                <i class="fas fa-spinner animate-spin text-white text-lg" wire:loading wire:target="save"></i>
                Agregar
            </x-jet-button>
        </div>
    </div>
    @if ($size_colors->count())
        <div class="mt-8">
            <table>
                <thead>
                    <tr>
                        <th class="px-4 py-2 w-1/3">Color</th>
                        <th class="px-4 py-2 w-1/3">Cantidad</th>
                        <th class="px-4 py-2 w-1/3"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($size_colors as $size_color)
                        <tr wire:key="size_color-{{ $size_color->pivot->id }}">
                            <td class="capitalize px-4 py-2">
                                {{ __($colors->find($size_color->pivot->color_id)->name) }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $size_color->pivot->quantity }} unidades
                            </td>
                            <td class="px-4 py-2 flex">
                                {{-- No se puede ocupar un metodo magico debido a que se necesita pasar los parametros del color --}}
                                <x-jet-secondary-button class="ml-auto mr-2"
                                    wire:click="edit({{ $size_color->pivot->id }})" wire:loading.attr="disabled"
                                    wire:target="edit({{ $size_color->pivot->id }})">
                                    Actualizar
                                </x-jet-secondary-button>
                                <x-jet-danger-button
                                    wire:click="$emit('deleteColorSize', {{ $size_color->pivot->id }})">
                                    Eliminar
                                </x-jet-danger-button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Editar Color
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Color" />
                <select class="form-control w-full" wire:model="pivot_color_id">
                    <option value="" {{-- selected disabled --}}>Seleccione un color</option>
                    @foreach ($colors as $color)
                        <option value="{{ $color->id }}">{{ ucfirst(__($color->name)) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <x-jet-label value="Cantidad" />
                <x-jet-input type="number" wire:model="pivot_quantity" placeholder="Ingrese una nueva cantidad"
                    class="w-full" />
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open', false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-button wire:click="update" wire:loading.attr="disabled" wire:target="update">
                Actualizar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
