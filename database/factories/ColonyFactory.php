<?php

namespace Database\Factories;

use App\Models\Colony;
use Illuminate\Database\Eloquent\Factories\Factory;

class ColonyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Colony::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word()
        ];
    }
}
