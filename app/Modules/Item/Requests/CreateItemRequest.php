<?php

namespace App\Modules\Item\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateItemRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'price' => 'required|numeric|min:0|max:999999.99',
            'categories' => 'required|array',
            'categories.*' => 'numeric|exists:categories,id',
            'translations' => 'required|array',
            'translations.*.name' => 'required|string|max:255',
            'translations.*.description' => 'nullable|string',
        ];
    }
}
