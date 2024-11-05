<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Electronics',
                'desc' => 'Alat Elektronik , Gadget dan lain sebagainya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Furniture',
                'desc' => 'Perabotan Rumah, Kantor dan lain-lain',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Books',
                'desc' => 'Buku dan E - Books',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
