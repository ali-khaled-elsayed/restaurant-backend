<?php

namespace App\Modules\Item\Services;

use App\Modules\Item\Repositories\ItemRepository;
use App\Modules\Item\Repositories\ItemTranslationsRepository;
use App\Modules\Item\Requests\GetAllItemsRequest;

class ItemService
{
    public function __construct(private ItemRepository $itemRepository, private ItemTranslationsRepository $itemTranslationsRepository)
    {
    }

    public function getAllItems(array $queryParameters)
    {
        $getAllItemsRequest = (new GetAllItemsRequest)->constructQueryCriteria($queryParameters);
        $items = $this->itemRepository->findAllBy($getAllItemsRequest);

        return [
            'data' => $items['data'],
            'count' => $items['count']
        ];
    }

    public function createItem($request)
    {
        $item = $this->itemRepository->create($this->constructItemModel($request));
        foreach ($request['translations'] as $locale => $value){
            $this->itemTranslationsRepository->create($this->constructItemTranslationsModel($locale, $value, $item->id));
        }
        $item->categories()->attach($request['categories']);
        return $item;
    }

    public function updateItem($id, $request)
    {
        $item = $this->itemRepository->update($id,$this->constructItemModel($request));
       
        if (isset($request['categories'])) {
            $item->categories()->sync($request['categories']);
        }

        foreach ($request['translations'] as $locale => $value){
            $itemTranslation = $this->itemTranslationsRepository->getByItemIdAndLocale($item->id, $locale);

            if ($itemTranslation) {
                $this->itemTranslationsRepository->update(
                    $itemTranslation->id,
                    $this->constructItemTranslationsModel($locale, $value, $item->id)
                );
            } else {
                $this->itemTranslationsRepository->create(
                    $this->constructItemTranslationsModel($locale, $value, $item->id)
                );
            }
        }
        return $item;
    }

    public function getItemById($id)
    {
        return $this->itemRepository->getItemWithRelations($id);
    }

    public function deleteItem($id)
    {
        $Item = $this->itemRepository->find($id);
        return $Item->delete();
    }

    public function constructItemModel(array $request)
    {
        return [
            'price' => $request['price'],
        ];
    }
    public function constructItemTranslationsModel($locale, $value, $itemId)
    {
        return [
            'item_id' => $itemId,
            'locale' => $locale,
            'name' => $value['name'],
            'description' => $value['description']
        ];
    }

    public function getBulkOfItemsById($ids){
        $items= $this->itemRepository->getBulkOfItemsByIds($ids);
        return $items;
    }
}
