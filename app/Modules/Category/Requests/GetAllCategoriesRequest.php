<?php

namespace App\Modules\Category\Requests;

use App\Modules\Shared\Requests\BaseRequest;

class GetAllCategoriesRequest extends BaseRequest
{
    public function getFilters()
    {
        return [
            'menuId' => 'menu_id',
        ];
    }

    public function constructQueryCriteria(array $queryParameters)
    {
        $filters = $this->setFilters(data_get($queryParameters, 'filters'));
        return array_merge($this->constructBaseGetQuery($queryParameters), ['filters' => $filters]);
    }
}
