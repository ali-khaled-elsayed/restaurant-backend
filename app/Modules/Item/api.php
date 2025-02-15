<?php

use App\Modules\Category\CategoryController;
use App\Modules\Menu\MenuController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::controller(MenuController::class)->prefix('menus')->group(function () {
    Route::get('', 'getAllMenus');
    Route::get('/{id}', 'getMenuById');
    Route::post('', 'createMenu');
    Route::put('{id}', 'updateMenu');
    Route::delete('{id}', 'deleteMenu');
});

Route::controller(CategoryController::class)->prefix('Categories')->group(function () {
    Route::get('', 'getAllCategories');
    Route::get('/{id}', 'getCategoryById');
    Route::post('', 'createCategory');
    Route::put('{id}', 'updateCategory');
    Route::delete('{id}', 'deleteCategory');
});