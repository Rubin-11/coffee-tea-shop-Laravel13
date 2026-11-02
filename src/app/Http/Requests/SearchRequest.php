<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SearchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'q' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'q.string' => 'Некорректный поисковый запрос.',
            'q.max' => 'Поисковый запрос слишком длинный.',
        ];
    }

    // Как у фильтров каталога: кривой параметр в URL не уводит «назад», а открывает поиск без него
    protected function failedValidation(Validator $validator): void
    {
        $valid = array_filter($validator->valid(), fn ($value) => $value !== null);

        throw new HttpResponseException(
            redirect()->route('search', $valid)->withErrors($validator)
        );
    }
}
