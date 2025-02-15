<?php

namespace App\Modules\Menu;

use App\Http\Controllers\Controller;
use App\Modules\Menu\Requests\CreateMenuRequest;
use App\Modules\Menu\Requests\GetMenusRequest;
use App\Modules\Menu\Requests\IntegrationRequest;
use App\Modules\Menu\Services\menuService;
use App\Modules\Shared\Enums\HttpStatusCodeEnum;

class MenuController extends Controller
{
    public function __construct(private MenuService $menuService)
    {
    }

    public function getAllMenus(GetMenusRequest $request)
    {
        $menus = $this->menuService->getAllMenus($request->validated());
        return successJsonResponse(data_get($menus, 'data'), __('menu.success.get_all_menus'), data_get($menus, 'count'));
    }

    public function createMenu(CreateMenuRequest $request)
    {
        $menu = $this->menuService->createMenu($request->validated());
        return successJsonResponse($menu, __('menu.success.create_menu'));
    }

    public function updateMenu($id, CreateMenuRequest $request)
    {
        $menu = $this->menuService->updateMenu($id, $request->validated());
        return successJsonResponse($menu, __('menu.success.update_menu'));
    }

    public function getMenuById($id)
    {
        $menu = $this->menuService->getMenuById($id);
        if (!$menu) {
            return errorJsonResponse(__('menu.error.menu_not_found', ['MenuId' => $id]), HttpStatusCodeEnum::Not_Found->value);
        }
        return successJsonResponse($menu, __('menu.success.get_menu_by_id', ['MenuId' => $id]));
    }

    public function deleteMenu($id)
    {
        $menu = $this->menuService->deleteMenu($id);
        return successJsonResponse($menu, __('menu.success.menu_deleted'));
    }

    public function integrate($id , IntegrationRequest $request){
        $integration = $this->menuService->integrate($id , $request->validated());
        return successJsonResponse($integration, __('menu.success.in_delivery'));

    }

}
