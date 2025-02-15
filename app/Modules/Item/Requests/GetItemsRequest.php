<?php

namespace App\Modules\Item\Requests;

use App\Modules\Shared\Requests\BaseGetRequestValidator;


class GetItemRequest extends BaseGetRequestValidator
{
    public function rules(): array
    {
        $rules = [
            'price' => "required|numeric|min:0|max:999999.99",
        ];
        return array_merge(parent::rules(), $rules);
    }
}
