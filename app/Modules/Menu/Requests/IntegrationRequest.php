<?php

namespace App\Modules\Menu\Requests;

use App\Modules\Menu\Enums\IntegrationsEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class IntegrationRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'integration' => ['required', new Enum(IntegrationsEnum::class)],
            'itemsIds' => 'required|array',
            'itemsIds.*' => 'required|exists:items,id'
        ];
    }
}
