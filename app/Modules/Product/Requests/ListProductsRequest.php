<?php

namespace App\Modules\Product\Requests;

use app\Modules\Shared\Requests\BaseGetRequestValidator;

class ListProductsRequest extends BaseGetRequestValidator
{
    public function rules(): array
    {
        $rules = [
            //
        ];
        return array_merge(parent::rules(), $rules);
    }
}
