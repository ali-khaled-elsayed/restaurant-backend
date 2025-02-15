<?php

namespace App\Modules\Item\Requests;

use App\Modules\Shared\Requests\BaseRequest;

class GetAllItemsRequest extends BaseRequest
{
    public function getFilters()
    {
        return [
            'price' => 'price',
        ];
    }

    public function constructQueryCriteria(array $queryParameters)
    {
        $filters = $this->setFilters(data_get($queryParameters, 'filters'));
        return array_merge($this->constructBaseGetQuery($queryParameters), ['filters' => $filters]);
    }
}
