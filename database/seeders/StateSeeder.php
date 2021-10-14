<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Colony;
use App\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        State::factory(8)->create()->each(function (State $state) {
            City::factory(8)->create([
                'state_id' => $state->id
            ])->each(function (City $city) {
                Colony::factory(8)->create([
                    'city_id' => $city->id
                ]);
            });
        });
    }
}
