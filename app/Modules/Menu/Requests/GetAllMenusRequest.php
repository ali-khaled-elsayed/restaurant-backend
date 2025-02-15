<?php

namespace App\Modules\Menu\Requests;

use App\Modules\Shared\Requests\BaseRequest;

class GetAllMenusRequest extends BaseRequest
{
    public function getFilters()
    {
        return [
            'name' => 'name',
        ];
    }

    public function constructQueryCriteria(array $queryParameters)
    {
        $filters = $this->setFilters(data_get($queryParameters, 'filters'));
        return array_merge($this->constructBaseGetQuery($queryParameters), ['filters' => $filters]);
    }
}
