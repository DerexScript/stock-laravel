<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(['name' => 'Estoque', 'external' => (bool) 0]);
        DB::table('categories')->insert(['name' => 'Funcionários', 'external' => (bool) 1]);
        DB::table('categories')->insert(['name' => 'Assistência', 'external' => (bool) 0]);
    }
}
