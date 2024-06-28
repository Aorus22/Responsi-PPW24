<?php

namespace Database\Factories;

use App\Models\Barang;
use App\Models\JenisBarang;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

class BarangFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Barang::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $jenis_barang_id = JenisBarang::pluck('id')->random();
        $stok = $this->faker->numberBetween(0, 100);
        $harga = $this->faker->numberBetween(1, 100) * 1000;

        return [
            'nama_barang' => $this->faker->word(),
            'deskripsi' => $this->faker->sentence(),
            'stok' => $stok,
            'harga' => $harga,
            'jenis_barang_id' => $jenis_barang_id
        ];
    }
}
