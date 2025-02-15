<?php

namespace App\Modules\Menu\Services;

use App\Modules\Item\Services\ItemService;
use App\Modules\Menu\Requests\GetAllMenusRequest;
use App\Modules\Menu\Repositories\menuRepository;

class MenuService
{
    public function __construct(private menuRepository $menuRepository
        , private ItemService $itemService)
    {
    }

    public function getAllMenus(array $queryParameters)
    {
        $getAllMenusRequest = (new GetAllMenusRequest)->constructQueryCriteria($queryParameters);
        $menus = $this->menuRepository->findAllBy($getAllMenusRequest);

        return [
            'data' => $menus['data'],
            'count' => $menus['count']
        ];
    }

    public function createMenu($request)
    {
        $menu = $this->constructMenuModel($request);
        return $this->menuRepository->create($menu);
    }

    public function updateMenu($id, $request)
    {
        $menu = $this->constructMenuModel($request);
        return $this->menuRepository->update($id, $menu);
    }

    public function getMenuById($id)
    {
        return $this->menuRepository->find($id);
    }

    public function deleteMenu($id)
    {
        $menu = $this->menuRepository->find($id);
        return $menu->delete();
    }

    public function constructMenuModel(array $request)
    {
        return [
            'name' => $request['name'],
        ];
    }

    public function integrate($id, $request){
        $items = $this->itemService->getBulkOfItemsById($request['itemsIds']);
        //provider
        $integrateProvider = $request['integration'];
        //make service
        $integrateService = app()->make(config("integrate.providers.{$integrateProvider}.service"));
        //make deliver request
        $integrate =$integrateService->deliver($id, $items, $integrateProvider);

        return $integrate;
    }
}
