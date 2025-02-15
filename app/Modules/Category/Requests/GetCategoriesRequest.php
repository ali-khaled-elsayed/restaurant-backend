<?php

namespace App\Modules\Category\Requests;

use App\Modules\Shared\Requests\BaseGetRequestValidator;


class GetCategoriesRequest extends BaseGetRequestValidator
{
    public function rules(): array
    {
        $rules = [
            'menuId' => "integer",
        ];
        return array_merge(parent::rules(), $rules);
    }
}
