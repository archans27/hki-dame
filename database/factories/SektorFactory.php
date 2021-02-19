<?php

namespace Database\Factories;

use App\Models\Sektor;
use Illuminate\Database\Eloquent\Factories\Factory;

class SektorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sektor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $id = $this->faker->numberBetween(1000, 9999);
        return [
            'id' => $id,
            'nama' => 'Sektor '.$id,
            'wilayah' => $this->faker->address(''),
        ];
    }
}
