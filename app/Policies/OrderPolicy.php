<?php

namespace App\Policies;

use App\Models\FavoriteProduct;
use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    #Policia para controlar los accesos a las ordenes creadas
    public function author(User $user, Order $order)
    {
        if ($order->user_id == $user->id) {
            return true;
        } else {
            return false;
        }
    }
    #Policia para controlar los accesos a las ordenes creadas
    public function userfav(User $user, FavoriteProduct $favorite)
    {
        if ($favorite->user_id == $user->id) {
            return true;
        } else {
            return false;
        }
    }
    #Policia para controlar los estados de pago de las ordenes generadas
    public function payment(User $user, Order $order)
    {
        if ($order->status == 2) {
            return false;
        } else {
            return true;
        }
    }
}
