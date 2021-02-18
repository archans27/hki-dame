<?php

namespace Database\Factories;

use App\Models\DetailKeluarga;
use App\Models\Keluarga;
use App\Models\Jemaat;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

class DetailKeluargaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DetailKeluarga::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $hubunganList = ['Suami', 'Istri', 'Anak', 'Menantu', 'Cucu', 'Orang Tua', 'Mertua', 'Famili Lain'];
        $hubungan = $hubunganList[$this->faker->numberBetween(0, 7)];
        return [
            //'id' => Uuid::uuid4(),
            'keluarga_id' => Keluarga::factory(),
            'jemaat_id' => Jemaat::factory(),
            'hubungan' => $hubungan,
            'anak_ke' => $hubungan == 'Anak' ? $this->faker->numberBetween(1, 4) : '',
        ];
    }
}
