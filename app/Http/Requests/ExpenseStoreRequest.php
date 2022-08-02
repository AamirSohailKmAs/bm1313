<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'expense_qty' => ['required', 'numeric', 'min:1'],
            'expense_item' => ['required', 'numeric'],
            'expense_price' => ['required', 'numeric', 'min:0.01'],
            'expense_remarks' => ['nullable', 'string',],
        ];
    }
    public function attributes()
    {
        return [
            'expense_qty' => 'Expense Quantity',
        ];
    }
}
