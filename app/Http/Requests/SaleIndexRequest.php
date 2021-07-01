<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleIndexRequest extends FormRequest
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
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation() 
    {
        $this->merge(['seller_id' => $this->route('seller_id')]);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'seller_id' => ['required','exists:sellers,uuid']
        ];
    }
}