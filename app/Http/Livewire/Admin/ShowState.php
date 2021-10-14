<?php

namespace App\Http\Livewire\Admin;

use App\Models\City;
use App\Models\State;
use Livewire\Component;

class ShowState extends Component
{
    protected $listeners = ['delete'];

    public $state, $cities, $city;
    public $createForm = [
        'name' => '',
        'cost' => null
    ];
    public $editForm = [
        'open' => false,
        'name' => '',
        'cost' => null
    ];
    public $validationAttributes = [
        'createForm.name' => 'nombre',
        'editForm.name' => 'nombre',
        'createForm.cost' => 'costo',
        'editForm.cost' => 'costo'
    ];
    public function mount(State $state)
    {
        $this->state = $state;
        $this->getCities();
    }
    public function getCities()
    {
        $this->cities = City::where('state_id', $this->state->id)->orderBy('name', 'ASC')->get();
    }
    public function save()
    {
        $this->validate([
            'createForm.name' => 'required',
            'createForm.cost' => 'required|numeric|min:1|max:999'
        ]);
        $this->state->cities()->create($this->createForm);
        $this->reset('createForm');
        $this->getCities();
        $this->emit('saved');
    }
    public function edit(City $city)
    {
        $this->city = $city;
        $this->editForm['open'] = true;
        $this->editForm['name'] = $city->name;
        $this->editForm['cost'] = $city->cost;
    }
    public function update()
    {
        $this->city->name = $this->editForm['name'];
        $this->city->cost = $this->editForm['cost'];
        $this->city->save();
        $this->reset('editForm');
        $this->getCities();
        $this->emit('updated');
    }
    public function delete(City $city)
    {
        $city->delete();
        $this->getCities();
        $this->emit('deleted');
    }
    public function render()
    {
        return view('livewire.admin.show-state')->layout('layouts.admin');
    }
}
