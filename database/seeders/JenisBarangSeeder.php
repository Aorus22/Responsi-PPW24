<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_barang')->insert([
            ['nama_jenis_barang' => 'Minuman'],
            ['nama_jenis_barang' => 'Snack'],
            ['nama_jenis_barang' => 'Bumbu Dapur'],
            ['nama_jenis_barang' => 'Sabun'],
            ['nama_jenis_barang' => 'Kosmetik'],
            ['nama_jenis_barang' => 'Roti'],
            ['nama_jenis_barang' => 'Es Krim'],
        ]);
    }
}
