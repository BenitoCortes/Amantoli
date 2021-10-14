<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Colony;
use App\Models\Order;
use App\Models\State;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class CreateOrder extends Component
{
    public $envio_type = 1;
    public $contact, $phone, $address, $references, $shipping_cost = 0;
    public $states, $cities = [], $colonies = [];
    public $state_id = "", $city_id = "", $colony_id = "";
    public $rules = [
        'contact' => 'required',
        'phone' => 'required',
        'envio_type' => 'required'
    ];

    public function mount()
    {
        #Ni bien se cargue la pagina recuperaremos todos los estado de la base de datos
        $this->states = State::orderBy('name', 'ASC')->get();
    }

    public function updatedEnvioType($value)
    {
        //Reinicia las validaciones
        if ($value == 1) {
            $this->resetValidation([
                'state_id',
                'city_id',
                'colony_id',
                'address',
                'references'
            ]);
        }
    }

    public function updatedStateId($value)
    {
        #Recuperamos las ciudades correspondientes al estado que hayamos seleccionado previamente
        $this->cities = City::where('state_id', $value)->orderBy('name', 'ASC')->get();
        #Reseteamos el select ciudad y colonias
        $this->reset(['city_id', 'colony_id']);
    }

    public function updatedCityId($value)
    {
        $city = City::find($value);
        $this->shipping_cost = $city->cost;
        #Recuperamos las ciudades correspondientes al estado que hayamos seleccionado previamente
        $this->colonies = Colony::where('city_id', $value)->orderBy('name', 'ASC')->get();
        #Reseteamos el select colonias
        $this->reset('colony_id');
    }

    public function create_order()
    {
        $rules = $this->rules;
        //Añade validaciones en caso de que el envio sea a domicilio
        if ($this->envio_type == 2) {
            $rules['state_id'] = 'required';
            $rules['city_id'] = 'required';
            $rules['colony_id'] = 'required';
            $rules['address'] = 'required';
            $rules['references'] = 'required';
        }
        $this->validate($rules);

        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->contact = $this->contact;
        $order->phone = $this->phone;
        $order->envio_type = $this->envio_type;
        $order->shipping_cost = 0;
        $order->total = $this->shipping_cost + Cart::subtotalFloat();
        $order->content = Cart::content();

        if ($this->envio_type == 2) {
            $order->shipping_cost = $this->shipping_cost;
            $order->envio = json_encode([
                'state' => State::find($this->state_id)->name,
                'city' => City::find($this->city_id)->name,
                'colony' => Colony::find($this->colony_id)->name,
                'address' => $this->address,
                'references' => $this->references
            ]);
        }
        #Guardar la orden
        $order->save();

        foreach (Cart::content() as $item) {
            discount($item);
        }
        #Eliminar el contenido del carrito de compras
        Cart::destroy();
        //Redirigir a la ruta de pago de la orden
        return redirect()->route('orders.payment', $order);
    }

    public function render()
    {
        return view('livewire.create-order');
    }
}
