<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReactController extends Controller
{
    public function registernewuser(Request $request)
    {
        $user = User::where('email', '=', $request->email)->first();
        if ($user != null) {
            return response()->json(['message' => 'Este usuario ya existe']);
        } else {
            return User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'created_at'=>now(),
                'updated_at'=>now()
            ]); 
        }
    }
    public function login(Request $request)
    {
        $logindetails = $request->only('email', 'password');

        if (Auth::attempt($logindetails)) {

            $userdata = [
                'id' => Auth::user()->id,
                'email' => Auth::user()->email,
                'password' => Auth::user()->password,
                'name' => Auth::user()->name,
                'email_verified_at' => Auth::user()->email_verified_at,
                'two_factor_secret' => Auth::user()->two_factor_secret,
                'two_factor_recovery_codes' => Auth::user()->two_factor_recovery_codes,
                'remember_token' => Auth::user()->remember_token,
                'profile_photo_path' => Auth::user()->profile_photo_path,
                'created_at' => Auth::user()->created_at,
                'updated_at' => Auth::user()->updated_at
            ];
            return response()->json($userdata);
        } else {
            return response()->json(['message' => 'login fallido']);
        }
    }

    public function products()
    {
        $proucts = Product::all()->where('status', 2)->take(10);
        return json_encode($proucts);
    }
    public function searchproducts(Request $request)
    {
        $name = $request->name;
        $products = Product::where('name', 'LIKE', '%' . $name . '%')
            ->where('status', 2)->get();
        return json_encode($products);
    }

    public function ordersUsers(Order $order)
    {
        if ($order->user_id == Auth()->user()->id) {
            $items = json_decode($order->content);
            return $items;
        } else {
            return false;
        }
    }
    public function showOrder(Order $order)
    {
        $this->authorize('author', $order);
        $items = json_decode($order->content);
        return view('orders.show', compact('order', 'items'));
    }
}
