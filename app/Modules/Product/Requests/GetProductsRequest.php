<?php

namespace App\Modules\Product\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetProductsRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            // 'channelCode' => "string",
            "limit" => 'required_with:offset|integer|min:1|max:100',
            "offset" => 'required_with:limit|integer|min:0',
            "sort" => 'required_with:sortBy|in:ASC,DESC,asc,desc',
            "sortBy" => 'required_with:sort|string',
        ];
        return $rules;
    }
}
