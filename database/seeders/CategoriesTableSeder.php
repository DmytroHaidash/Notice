<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()->times(5)->create();
        for($i = 1; $i< 5; $i++){
            Category::factory()->times(rand(1, 4))->create([
                'parent_id' => $i
            ]);
        }
    }
}
