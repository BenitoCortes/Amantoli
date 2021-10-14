<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    const PENDIENTE = 1;
    const RECIBIDO = 2;
    const ENVIADO = 3;
    const ENTREGADO = 4;
    const ANULADO = 5;
    protected $guarded = ['id', 'created_at', 'updated_at', 'status'];
    #Relación uno a muchos inversa 
    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function colony()
    {
        return $this->belongsTo(Colony::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
