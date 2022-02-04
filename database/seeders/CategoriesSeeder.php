<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categories::insert([
            ['name' => 'Nature'],
            ['name' => 'People'],
            ['name' => 'Trips'],
            ['name' => 'Animals'],
            ['name' => 'Fashion'],
            ['name' => 'Tech'],
        ]);
    }
}
