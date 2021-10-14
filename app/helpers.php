<?php

use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Gloudemans\Shoppingcart\Facades\Cart;

function quantity($product_id, $color_id = null, $size_id = null)
{
    $product = Product::find($product_id);
    if ($size_id) {
        $size = Size::find($size_id);
        $quantity = $size->colors->find($color_id)->pivot->quantity;
    } elseif ($color_id) {
        $quantity = $product->colors->find($color_id)->pivot->quantity;
    } else {
        $quantity = $product->quantity;
    }
    return $quantity;
}
function qty_added($product_id, $color_id = null, $size_id = null)
{

    $cart = Cart::content();

    $item = $cart->where('id', $product_id)
        ->where('options.color_id', $color_id)
        ->where('options.size_id', $size_id)
        ->first();

    if ($item) {
        return $item->qty;
    } else {
        return 0;
    }
}

function qty_available($product_id, $color_id = null, $size_id = null)
{
    return quantity($product_id, $color_id, $size_id) - qty_added($product_id, $color_id, $size_id);
}
#Funcion para descontar inventario de la base de datos una vez que se realice un pedido
function discount($item)
{
    $product = Product::find($item->id);
    $qty_available = qty_available($item->id, $item->options->color_id, $item->options->size_id);

    if ($item->options->size_id) {
        #Busca el producto que conincida con la id que le pasamos como parametro
        $size = Size::find($item->options->size_id);
        #Se elimina el registro correspondiente en la tabla color_size
        $size->colors()->detach($item->options->color_id);
        #Se vuelve a crear el producto pero agregandole la nueva información de la cantidad       disponible
        $size->colors()->attach([
            $item->options->color_id => ['quantity' => $qty_available]
        ]);
    } elseif ($item->options->color_id) {
        #Accedemos al objeto product y obtenemos el registro de la tabla intermedia
        $product->colors()->detach($item->options->color_id);
        #Se vuelve a crear el producto pero agregandole la nueva información de la cantidad disponible
        $product->colors()->attach([
            $item->options->color_id => ['quantity' => $qty_available]
        ]);
    } else {
        $product->quantity = $qty_available;
        $product->save();
    }
}
function increase($item)
{
    $product = Product::find($item->id);

    $quantity = quantity($item->id, $item->options->color_id, $item->options->size_id) + $item->qty;

    if ($item->options->size_id) {
        #Busca el producto que conincida con la id que le pasamos como parametro
        $size = Size::find($item->options->size_id);
        #Se elimina el registro correspondiente en la tabla color_size
        $size->colors()->detach($item->options->color_id);
        #Se vuelve a crear el producto pero agregandole la nueva información de la cantidad disponible anteriormente
        $size->colors()->attach([
            $item->options->color_id => ['quantity' => $quantity]
        ]);
    } elseif ($item->options->color_id) {
        #Accedemos al objeto product y obtenemos el registro de la tabla intermedia
        $product->colors()->detach($item->options->color_id);
        #Se vuelve a crear el producto pero agregandole la nueva información de la cantidad disponible anteriormente
        $product->colors()->attach([
            $item->options->color_id => ['quantity' => $quantity]
        ]);
    } else {
        $product->quantity = $quantity;
        $product->save();
    }
}
