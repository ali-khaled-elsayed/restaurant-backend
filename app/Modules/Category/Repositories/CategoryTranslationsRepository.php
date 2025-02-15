<?php

namespace App\Modules\Category\Repositories;

use App\Models\CategoryTranslation;
use App\Modules\Shared\Repositories\BaseRepository;

class categoryTranslationsRepository extends BaseRepository
{
    public function __construct(private CategoryTranslation $model)
    {
        parent::__construct($model);
    }

    public function getByCategoryIdAndLocale($categoryId, $locale){
        return $this->model->where('category_id' , $categoryId)->where('locale', $locale)->first();
    }
}
