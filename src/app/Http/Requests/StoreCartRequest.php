<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => [
                'required',
                'integer',
                // exists смотрит в таблицу напрямую и не знает про SoftDeletes, поэтому deleted_at проверяем сами
                Rule::exists('products', 'id')->whereNull('deleted_at'),
            ],
            'quantity' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'Не выбран товар.',
            'product_id.integer' => 'Некорректный товар.',
            'product_id.exists' => 'Товар недоступен.',
            'quantity.required' => 'Укажите количество.',
            'quantity.integer' => 'Количество должно быть целым числом.',
            'quantity.min' => 'Количество должно быть больше нуля.',
        ];
    }
}
