<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryData = [
            'menu_id' => 1,
        ];

        $category = Category::create($categoryData);

        $translations = [
            'en' => [
                'name' => 'Main Course',
                'description' => 'Main dishes'
            ],
            'ar' => [
                'name' => 'الطبق الرئيسي',
                'description' => 'الأطباق الرئيسية'
            ]
        ];

        foreach ($translations as $locale => $translation) {
            $category->translations()->create([
                'locale' => $locale,
                'name' => $translation['name'],
                // 'description' => $translation['description'],
            ]);
        }

    }
}
