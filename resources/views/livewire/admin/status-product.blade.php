<div class="bg-white shadow-xl rounded-lg p-6 mb-4">
    <p class="text-2xl text-center font-semibold mb-2">Estado del producto</p>
    <div class="flex">
        <label class="mr-6">
            <x-jet-input wire:model.defer="status" type="radio" name="status" value="1" />
            Marcar producto como borrador
        </label>
        <label>
            <x-jet-input wire:model.defer="status" type="radio" name="status" value="2" />
            Marcar producto como publicado
        </label>
    </div>
    <div class="flex justify-end">
        <x-jet-action-message class="mr-3" on="saved">
            <span class="bg-green-700 text-green-100 p-4 rounded-lg">
                ¡Actualizado!
                <i class="fas fa-check"></i>
            </span>
        </x-jet-action-message>
        <x-jet-button wire:click="save" wire:loading.attr="disabled" wire:target="save">
            <i class="fas fa-spinner animate-spin text-white text-lg" wire:loading wire:target="save"></i>
            Actualizar
        </x-jet-button>
    </div>
</div>
