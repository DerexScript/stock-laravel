<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert(['name' => 'Notebook']);
        DB::table('types')->insert(['name' => 'Impressora']);
        DB::table('types')->insert(['name' => 'TV']);
    }
}
