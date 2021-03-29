<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NutrientRdaUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $nutrient_rda = $this->route('nutrient_rda');

        return $nutrient_rda
            && $this->user()->can('update-nutrient-rda', $nutrient_rda);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nutrient_id' => 'required|exists:nutrients,id',
            'pregnant'          => 'required|boolean',
            'breast_feeding'    => 'required|boolean',
            'age_low'     => 'required|numeric|min:0',
            'age_high'    => 'required|numeric|min:0',
            'ra_men'      => 'required|numeric|min:0',
            'ra_women'    => 'required|numeric|min:0',
            'ra_unit'     => 'required|string|max:8|in:mg,mcg,g,IU',
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
