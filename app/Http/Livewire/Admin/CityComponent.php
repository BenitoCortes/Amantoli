<?php

namespace App\Http\Livewire\Admin;

use App\Models\City;
use App\Models\Colony;
use Livewire\Component;

class CityComponent extends Component
{
    protected $listeners = ['delete'];

    public $city, $colonies, $colony;

    public $createForm = [
        'name' => '',
    ];
    public $editForm = [
        'open' => false,
        'name' => ''
    ];
    public $validationAttributes = [
        'createForm.name' => 'nombre',
        'editForm.name' => 'nombre',
    ];

    public function mount(City $city)
    {
        $this->city = $city;
        $this->getColonies();
    }
    public function getColonies()
    {
        $this->colonies = Colony::where('city_id', $this->city->id)->orderBy('name', 'ASC')->get();
    }
    public function save()
    {
        $this->validate([
            'createForm.name' => 'required',
        ]);
        $this->city->colonies()->create($this->createForm);
        $this->reset('createForm');
        $this->getColonies();
        $this->emit('saved');
    }
    public function edit(Colony $colony)
    {
        $this->colony = $colony;
        $this->editForm['open'] = true;
        $this->editForm['name'] = $colony->name;
    }
    public function update()
    {
        $this->colony->name = $this->editForm['name'];
        $this->colony->save();
        $this->reset('editForm');
        $this->getColonies();
        $this->emit('updated');
    }
    public function delete(Colony $colony)
    {
        $colony->delete();
        $this->getColonies();
        $this->emit('deleted');
    }
    public function render()
    {
        return view('livewire.admin.city-component')->layout('layouts.admin');
    }
}
