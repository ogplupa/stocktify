<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeAndStatusSeeder extends Seeder
{
    public function run()
    {
        // Seed types
        DB::table('types')->insert([
            ['name' => 'Masuk'],
            ['name' => 'Keluar'],
        ]);

        // Seed statuses
        DB::table('statuses')->insert([
            ['name' => 'Pending'],
            ['name' => 'Diterima'],
            ['name' => 'Ditolak'],
            ['name' => 'Dikeluarkan'],
        ]);
    }
} 