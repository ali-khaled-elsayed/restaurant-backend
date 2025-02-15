<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $itemData = [
            'price' => 99.99,
        ];

        $item = Item::create($itemData);

        $translations = [
            'en' => [
                'name' => 'Margherita Pizza',
                'description' => 'Classic Italian pizza'
            ],
            'ar' => [
                'name' => 'بيتزا مارجريتا',
                'description' => 'بيتزا إيطالية كلاسيكية'
            ]
        ];

        foreach ($translations as $locale => $translation) {
            $item->translations()->create([
                'locale' => $locale,
                'name' => $translation['name'],
                'description' => $translation['description'],
            ]);
        }

        $categories = [1];
        $item->categories()->attach($categories);
    }
}
