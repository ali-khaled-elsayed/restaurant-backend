<?php

namespace App\Modules\Menu\Repositories;

use App\Models\Menu;
use App\Modules\Shared\Repositories\BaseRepository;

class menuRepository extends BaseRepository
{
    public function __construct(private Menu $model)
    {
        parent::__construct($model);
    }
}
