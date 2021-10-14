<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorProduct extends Model
{
    use HasFactory;

    protected $table = "color_product";
    //Relación uno a muchos inversa
    public function color()
    {
        return $this->BelongsTo(Color::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
