<?php

namespace Database\Seeders;

use App\Models\EventCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PredefinedCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = json_decode(File::get(__DIR__.'/PredefinedData/categories.json'), true);

        $this->processCategories($categories);
    }

    public function processCategories(array $categories, ?EventCategory $parentEventCategory = null) : void
    {
        foreach ($categories as $category) {
            $createdCategory = EventCategory::updateOrCreate(
                ['slug' => Str::slug($category['name'])],
                [
                    'name' => $category['name'],
                    'parent_id' => $parentEventCategory?->id,
                ]
            );
            if(!empty($category['children'])) {
                $this->processCategories($category['children'], $createdCategory);
            }
        }
    }
}
