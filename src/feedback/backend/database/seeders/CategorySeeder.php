<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'title' => 'Bug Report',
            ],
            [
                'title' => 'Feature Request',
            ],
            [
                'title' => 'Improvement',
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
