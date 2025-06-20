<?php

namespace Database\Seeders;

use App\Models\Poli;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $polis = collect([
            'Poli Umum',
            'Poli Gigi',
            'Poli Anak',
            'Poli Kandungan',
            'Poli THT',
            'Poli Mata',
        ]);

        $polis->each(function ($poli) {
            Poli::factory()->create([
                'nama' => $poli,
                'deskripsi' => "Deskripsi untuk $poli",
            ]);
        });
    }
}
