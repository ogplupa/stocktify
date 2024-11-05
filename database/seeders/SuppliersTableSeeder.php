<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('suppliers')->insert([
            [
                'name' => 'Fandi Geming',
                'address' => '123 Main St, Anytown, Country',
                'phone' => '08543216789',
                'email' => 'fandigeming@gmail.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hanif',
                'address' => '456 Market St, Anycity, Country',
                'phone' => '089553216758',
                'email' => 'hanifniboss@gmail.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Akira',
                'address' => '789 Broad St, Anycity, Country',
                'phone' => '089535138574',
                'email' => 'akira@gmail.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
