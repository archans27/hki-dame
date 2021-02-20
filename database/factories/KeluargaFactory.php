<?php

namespace Database\Factories;

use App\Models\Keluarga;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

class KeluargaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Keluarga::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $statusRumah = ['Tetap', 'Sementara'];

        return [
            'id' => Uuid::uuid4(),
            'kepala_keluarga_id' => Uuid::uuid4(),
            'kepala_keluarga' => $this->faker->name(),
            'no_keluarga' => 'NKH-'.$this->faker->numberBetween(1000, 9999),
            'alamat_rumah' => $this->faker->address(''),
            'sektor_id' => $this->faker->numberBetween(1, 13),
            'status_rumah' => $statusRumah[$this->faker->numberBetween(0, 1)]
        ];
    }
}
