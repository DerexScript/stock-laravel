<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(TypesSeeder::class);
        \App\Models\User::factory(1)->create();
        //\App\Models\Product::factory(1)->create();
    }
}
