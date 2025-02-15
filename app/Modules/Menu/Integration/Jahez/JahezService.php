<?php

namespace App\Modules\Menu\Integration\Jahez;

class JahezService
{
    public function __construct(private JahezCommunicator $jahezCommunicator)
    {
    }

    public function deliver($menu_id, $items, $provider){
        $mappedRequest = $this->mapRequest($menu_id, $items, $provider);
        
        //$deliveryRequest = $this->jahezCommunicator->createDeliver($mappedRequest);
        //return $deliveryRequest;

        return $mappedRequest;
    }

    public function mapRequest($menu_id, $items, $provider){

        return [
            'integration' => $provider,
            'menu_id' => $menu_id,
            'mappings' => $this->mapItems($items),
        ];
    }

    public function mapItems($items){
        $mapped = [
            'items' => [],
            'categories' => []
        ];

        $uniqueCategories = [];

        foreach ($items as $item) {
            $itemTranslations = [];

            foreach ($item->translations as $translation) {
                $itemTranslations[$translation['locale']] = [
                    'name' => $translation['name'],
                    'description' => $translation['description']
                ];
            }

            $mapped['items'][] = [
                'id' => $item->id ,
                'translations' => $itemTranslations,
                'price' => $item->price,
            ];

            foreach($item->categories as $category) {
                if (!isset($uniqueCategories[$category->id])) {
                    $categoryTranslations = [];
    
                    foreach ($category->translations as $translation) {
                        $categoryTranslations[$translation['locale']] = [
                            'name' => $translation['name']
                        ];
                    }
    
                    $uniqueCategories[$category->id] = [
                        'id' => $category->id,
                        'translations' => $categoryTranslations,
                    ];
                }
            }

            $mapped['categories'] = array_values($uniqueCategories);
        }
    
        return $mapped;
    }
}
