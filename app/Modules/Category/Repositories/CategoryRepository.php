<?php

namespace App\Modules\Category\Repositories;

use App\Models\Category;
use App\Modules\Shared\Repositories\BaseRepository;

class categoryRepository extends BaseRepository
{
    public function __construct(private Category $model)
    {
        parent::__construct($model);
    }

    public function getCategoryWithRelations($id){
        return $this->model->with(['menu', 'items', 'translations'])->find($id);
    }
}
