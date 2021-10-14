<?php

namespace App\Http\Livewire;

use App\Models\FavoriteProduct;
use App\Models\Product;
use Livewire\Component;

class AddFavoriteItem extends Component
{
    
    public $product, $favorites, $favorite;
    /*
    public function mount()
    {
        $this->getFavorites();
    }
    public function getFavorites()
    {
        $this->favorites = FavoriteProduct::where('user_id', 1);
    }
    public function addFavorite()
    {
        FavoriteProduct::create([
            'product_id' => $this->product->id,
            'user_id' => 1,
        ]);
    }
    public function deletefavorite(FavoriteProduct $favorite)
    {
        $favorite->delete();
    }
    public function render()
    {
        return view('livewire.add-favorite-item');
    }*/
}
