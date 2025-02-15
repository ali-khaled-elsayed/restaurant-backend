<?php

namespace App\Modules\Item\Repositories;

use App\Models\ItemTranslation;
use App\Modules\Shared\Repositories\BaseRepository;

class ItemTranslationsRepository extends BaseRepository
{
    public function __construct(private ItemTranslation $model)
    {
        parent::__construct($model);
    }

    public function getByItemIdAndLocale($itemId, $locale){
        return $this->model->where('item_id' , $itemId)->where('locale', $locale)->first();
    }
}
