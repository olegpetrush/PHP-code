<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NutrientStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create-nutrient');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'              => 'required|string|max:64|unique:nutrients,name',
            'other_name'        => 'sometimes|nullable|string|max:128',
            'type'              => 'required|string|max:16',
            'daily_value_men'   => 'required|numeric',
            'daily_value_women' => 'required|numeric',
            'upper_limit'       => 'required|numeric',
            'daily_value_unit'  => 'sometimes|nullable|string|max:8|in:mg,mcg,g,IU',
            'primary_sources'   => 'required|string|max:2048',
            'secondary_sources' => 'sometimes|nullable|string|max:2048',
            'benefits'          => 'required|string|max:2048',
            'side_effects' => 'sometimes|nullable|string|max:2048',
            'interactions' => 'sometimes|nullable|string|max:2048',
            'risks'        => 'sometimes|nullable|string|max:2048',
            'notes'             => 'required|string|max:2048',
        ];
    }
}
