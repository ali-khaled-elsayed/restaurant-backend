<?php

namespace App\Modules\Item;

use App\Http\Controllers\Controller;
use App\Modules\Item\Requests\CreateItemRequest;
use App\Modules\Item\Requests\GetItemRequest;
use App\Modules\Item\Services\ItemService;
use App\Modules\Shared\Enums\HttpStatusCodeEnum;

class ItemController extends Controller
{
    public function __construct(private ItemService $itemService)
    {
    }

    public function getAllItems(GetItemRequest $request)
    {
        $items = $this->itemService->getAllItems($request->validated());
        return successJsonResponse(data_get($items, 'data'), __('item.success.get_all_items'), data_get($items, 'count'));
    }

    public function createItem(CreateItemRequest $request)
    {
        $item = $this->itemService->createItem($request->validated());
        return successJsonResponse($item, __('item.success.create_item'));
    }

    public function updateItem($id, CreateItemRequest $request)
    {
        $item = $this->itemService->updateItem($id, $request->validated());
        return successJsonResponse($item, __('item.success.update_item'));
    }

    public function getItemById($id)
    {
        $item = $this->itemService->getItemById($id);
        if (!$item) {
            return errorJsonResponse(__('item.error.item_not_found', ['ItemId' => $id]), HttpStatusCodeEnum::Not_Found->value);
        }
        return successJsonResponse($item, __('item.success.get_item_by_id', ['ItemId' => $id]));
    }

    public function deleteItem($id)
    {
        $item = $this->itemService->deleteItem($id);
        return successJsonResponse($item, __('item.success.item_deleted'));
    }

}
