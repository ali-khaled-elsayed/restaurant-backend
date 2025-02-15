<?php

namespace App\Modules\Menu\Requests;

use App\Modules\Shared\Requests\BaseGetRequestValidator;

class GetMenusRequest extends BaseGetRequestValidator
{
    public function rules(): array
    {
        $rules = [
            'name' => "string",
        ];
        return array_merge(parent::rules(), $rules);
    }
}
