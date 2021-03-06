<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title" => "required|min:2|max:255",
            "description" => "max:1000",
            "price" => "required|integer",
            "currency" => "required",
            "type" => "required",
            "image_url" => "min:1|url",
            "images.*.url" => ['regex:/^(http)?s?:?(\/\/[^\']*\.(?:png|jpg|jpeg))/']

        ];
    }
}
