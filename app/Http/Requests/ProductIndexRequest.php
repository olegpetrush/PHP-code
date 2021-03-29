<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return $this->user() && $this->user()->can('view-any-product');
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
            'filter'        => 'sometimes|nullable|array',
            'filter.search' => 'sometimes|nullable|string',
        ];
    }

    public function prepareForValidation()
    {
        if ($this->has('filter.search')) {
            $filter = $this->get('filter');
            $filter['search'] = '%'.$filter['search'].'%';
            $this->merge(['filter' => $filter]);
        }
    }
}
