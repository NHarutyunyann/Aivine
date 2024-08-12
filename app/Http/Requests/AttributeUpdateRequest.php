<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeUpdateRequest extends FormRequest
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
            'slug' => 'required|unique:attributes,slug,'.$this->attribute->id.'|string|max:255', //atributes table-i slug@ uniquea --baci ays id-i depqum
            'name' => 'required|string|max:255',
            'options' => 'array|nullable',
        ];
    }
}
