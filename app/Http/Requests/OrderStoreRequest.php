<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
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
            'qty' => ['required', 'numeric', 'min:1'],
            'activation' => ['required_without:product'],
            'cash' => ['nullable', 'required_without:mb', 'numeric', 'min:0.01'],
            'mb' => ['nullable', 'numeric', 'min:0.01'],
            'unit_cost' => ['nullable', 'numeric', 'min:0.01'],
        ];
    }
    public function attributes()
    {
        return [
            'qty' => 'Quantity',
            'mb' => 'Multi Bank',
            'unit_cost' => 'Unit Cost',
        ];
    }
}
