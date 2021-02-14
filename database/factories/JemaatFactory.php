<?php

namespace Database\Factories;

use App\Models\Jemaat;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

class JemaatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Jemaat::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $jenisKelamin = ['Laki-laki', 'Perempuan'];
        $golonganDarah = ['A','B', 'AB', 'O'];
        $pendidikan = ['-', 'SD', 'SMP', 'SMA', 'Diploma 1-3', 'S1/D4', 'S2', 'S3'];
        $statusRumah = ['Pribadi', 'Orang Tua', 'Sewa'];

        return [
            'id' => Uuid::uuid4(),
            'no_anggota' => 'AHD-'.$this->faker->numberBetween($min = 1000, $max = 9000),
            'sektor_id' => $this->faker->numberBetween(1, 3),
            'kepala_keluarga_id' => Uuid::uuid4(), //Todo buat relasi dengan kepala keluarga
            'nama' => $this->faker->name,
            'jenis_kelamin' => $jenisKelamin[$this->faker->numberBetween(0, 1)],
            'tempat_lahir' => $this->faker->city,
            'tanggal_lahir' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'golongan_darah' => $golonganDarah[$this->faker->numberBetween(0, 3)],
            'alamat_rumah' => $this->faker->address,
            'status_rumah' => $statusRumah[$this->faker->numberBetween(0, 2)],
            'nomor_telepon' => $this->faker->e164PhoneNumber,
            'pendidikan' => $pendidikan[$this->faker->numberBetween(0, 7)],
            'pekerjaan' => $this->faker->jobTitle,
            'tanggal_anggota' => $this->faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now', $timezone = null),
            'hidup' => $this->faker->numberBetween(0, 1),
            'foto' => ''
        ];
    }
}
