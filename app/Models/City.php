<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'cost', 'state_id'];
    //Relacion uno a muchos
    public function colonies()
    {
        return $this->hasMany(Colony::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
