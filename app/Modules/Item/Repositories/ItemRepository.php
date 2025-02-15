<?php

namespace App\Modules\Item\Repositories;

use App\Models\Item;
use App\Modules\Shared\Repositories\BaseRepository;

class ItemRepository extends BaseRepository
{
    public function __construct(private Item $model)
    {
        parent::__construct($model);
    }

    public function getItemWithRelations($id){
        return $this->model->with(['categories', 'translations'])->find($id);
    }

    public function getBulkOfItemsByIds($ids){
        return $this->model->with(['categories', 'translations'])->whereIn('id', $ids)->get();
    }



}
