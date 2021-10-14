<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ShowProducts extends Component
{
    //Declaramos que queremos usar explicitamente la paginación y nos permite realizar la paginación asincronamente
    use WithPagination;

    public $search;

    //Retorna a la pagina 1 de la paginación
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $products = Product::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('price', 'LIKE', '%' . $this->search . '%')
            ->paginate(10);
        return view('livewire.admin.show-products', compact('products'))->layout('layouts/admin');
    }
}
