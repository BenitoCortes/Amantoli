<x-admin-layout>
    <div class="container py-12">
        @livewire('admin.create-category')
    </div>
    @push('script')
        <script>
            livewire.on('deleteCategory', CategorySlug => {
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
                        livewire.emitTo('admin.create-category', 'delete', CategorySlug);
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
</x-admin-layout>
