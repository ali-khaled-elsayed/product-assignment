<?php

namespace App\Modules\Product\Requests;

use App\Modules\Shared\Enums\LanguagesEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'productId' => 'required|integer|min:1|exists:products,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
        ];
    }

    public function  prepareForValidation()
    {
        $this->merge([
            'productId' => (int) $this->route('productId'),
        ]);
    }
}
