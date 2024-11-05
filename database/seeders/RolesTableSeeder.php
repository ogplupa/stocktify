<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'admin'],
            ['name' => 'super_admin'],
            ['name' => 'staff'],
        ]);
    }
}
