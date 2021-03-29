<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NutrientLimitStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create-nutrient-limit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nutrient_id'       => 'required|exists:nutrients,id',
            'pregnant'          => 'required|boolean',
            'breast_feeding'    => 'required|boolean',
            'age_low'           => 'required|numeric|min:0',
            'age_high'          => 'required|numeric|min:0',
            'upper_limit_men'   => 'required|numeric|min:0',
            'upper_limit_women' => 'required|numeric|min:0',
            'upper_limit_unit'  => 'required|string|max:8|in:mg,mcg,g,IU',
        ];
    }

    protected function prepareForValidation()
    {
        if ( ! $this->has('pregnant')) {
            $this->merge(['pregnant' => 0]);
        }
        if ( ! $this->has('breast_feeding')) {
            $this->merge(['breast_feeding' => 0]);
        }
    }

}
