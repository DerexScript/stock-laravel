<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert(['name' => 'edit_category']);
        DB::table('permissions')->insert(['name' => 'view_category']);
        DB::table('permissions')->insert(['name' => 'delete_category']);

    }
}
