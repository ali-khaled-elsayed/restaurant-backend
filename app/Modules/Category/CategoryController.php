<?php

namespace App\Modules\Category;

use App\Http\Controllers\Controller;
use App\Modules\Category\Requests\CreateCategoryRequest;
use App\Modules\Category\Requests\GetCategoriesRequest;
use App\Modules\Category\Services\categoryService;
use App\Modules\Shared\Enums\HttpStatusCodeEnum;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $categoryService)
    {
    }

    public function getAllCategories(GetCategoriesRequest $request)
    {
        $categories = $this->categoryService->getAllCategories($request->validated());
        return successJsonResponse(data_get($categories, 'data'), __('category.success.get_all_categories'), data_get($categories, 'count'));
    }

    public function createCategory(CreateCategoryRequest $request)
    {
        $category = $this->categoryService->createCategory($request->validated());
        return successJsonResponse($category, __('category.success.create_category'));
    }

    public function updateCategory($id, CreateCategoryRequest $request)
    {
        $category = $this->categoryService->updateCategory($id, $request->validated());
        return successJsonResponse($category, __('category.success.update_category'));
    }

    public function getCategoryById($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        if (!$category) {
            return errorJsonResponse(__('category.error.category_not_found', ['CategoryId' => $id]), HttpStatusCodeEnum::Not_Found->value);
        }
        return successJsonResponse($category, __('category.success.get_category_by_id', ['CategoryId' => $id]));
    }

    public function deleteCategory($id)
    {
        $category = $this->categoryService->deleteCategory($id);
        return successJsonResponse($category, __('category.success.category_deleted'));
    }

}
