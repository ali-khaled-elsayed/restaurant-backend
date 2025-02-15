<?php

namespace App\Modules\Category\Services;

use App\Modules\Category\Repositories\categoryRepository;
use App\Modules\Category\Repositories\categoryTranslationsRepository;
use App\Modules\Category\Requests\GetAllCategoriesRequest;

class CategoryService
{
    public function __construct(private categoryRepository $categoryRepository, private categoryTranslationsRepository $categoryTranslationsRepository)
    {
    }

    public function getAllCategories(array $queryParameters)
    {
        $getAllMenusRequest = (new GetAllCategoriesRequest)->constructQueryCriteria($queryParameters);
        $Categories = $this->categoryRepository->findAllBy($getAllMenusRequest);

        return [
            'data' => $Categories['data'],
            'count' => $Categories['count']
        ];
    }

    public function createCategory($request)
    {
        $category = $this->categoryRepository->create($this->constructCategoryModel($request));
        foreach ($request['translations'] as $locale => $value){
            $this->categoryTranslationsRepository->create($this->constructCategoryTranslationsModel($locale, $value, $category->id));
        }
        return $category;
    }

    public function updateCategory($id, $request)
    {
        $category = $this->categoryRepository->update($id,$this->constructCategoryModel($request));
        foreach ($request['translations'] as $locale => $value){
            $categoryTranslation = $this->categoryTranslationsRepository->getByCategoryIdAndLocale($category->id, $locale);

        if ($categoryTranslation) {
            $this->categoryTranslationsRepository->update(
                $categoryTranslation->id,
                $this->constructCategoryTranslationsModel($locale, $value, $category->id)
            );
        } else {
            $this->categoryTranslationsRepository->create(
                $this->constructCategoryTranslationsModel($locale, $value, $category->id)
            );
        }
        }
        return $category;
    }

    public function getCategoryById($id)
    {
        $category = $this->categoryRepository->getCategoryWithRelations($id);
        return $category;
    }

    public function deleteCategory($id)
    {
        $menu = $this->categoryRepository->find($id);
        return $menu->delete();
    }

    public function constructCategoryModel(array $request)
    {
        return [
            'menu_id' => $request['menuId'],
        ];
    }

    public function constructCategoryTranslationsModel($locale, $value, $categoryId)
    {
        return [
            'category_id' => $categoryId,
            'locale' => $locale,
            'name' => $value['name'],
        ];
    }
}
