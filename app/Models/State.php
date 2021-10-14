<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    //Relacion uno a muchos
    public function cities()
    {
        return $this->hasMany(City::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
