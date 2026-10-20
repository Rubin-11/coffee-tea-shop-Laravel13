<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CatalogFilterRequest extends FormRequest
{
    // параметр query string => slug группы характеристик (property_groups.slug)
    public const PROPERTY_FILTERS = [
        'processing' => 'processing-method',
        'roast_level' => 'roast-level',
        'acidity' => 'acidity',
        'coffee_type' => 'coffee-type',
        'body' => 'body',
        'bitterness' => 'bitterness',
    ];

    // Верхняя граница колонки products.price — decimal(10, 2)
    private const MAX_PRICE = 99999999.99;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'price_min' => ['nullable', 'numeric', 'min:0', 'max:' . self::MAX_PRICE],
            'price_max' => [
                'nullable', 'numeric', 'min:0', 'max:' . self::MAX_PRICE,
                // gte без price_min (или с нечисловым price_min) падает сам, поэтому сравниваем только когда есть с чем
                Rule::when(is_numeric($this->input('price_min')), ['gte:price_min']),
            ],
            'subcategory' => ['nullable', 'array'],
            'subcategory.*' => ['integer', 'min:1'],
        ];

        foreach (array_keys(self::PROPERTY_FILTERS) as $param) {
            $rules[$param] = ['nullable', 'array'];
            // string отсекает вложенные массивы вида roast_level[][]=3
            $rules["$param.*"] = ['string', 'max:100'];
        }

        return $rules;
    }

    public function messages(): array
    {
        $messages = [
            'price_min.numeric' => 'Цена «от» должна быть числом.',
            'price_min.min' => 'Цена «от» не может быть отрицательной.',
            'price_min.max' => 'Цена «от» слишком большая.',
            'price_max.numeric' => 'Цена «до» должна быть числом.',
            'price_max.min' => 'Цена «до» не может быть отрицательной.',
            'price_max.max' => 'Цена «до» слишком большая.',
            'price_max.gte' => 'Цена «до» не может быть меньше цены «от».',
            'subcategory.array' => 'Некорректный фильтр по подкатегориям.',
            'subcategory.*.integer' => 'Некорректный фильтр по подкатегориям.',
            'subcategory.*.min' => 'Некорректный фильтр по подкатегориям.',
        ];

        foreach (array_keys(self::PROPERTY_FILTERS) as $param) {
            $messages["$param.array"] = 'Некорректное значение фильтра.';
            $messages["$param.*.string"] = 'Некорректное значение фильтра.';
            $messages["$param.*.max"] = 'Некорректное значение фильтра.';
        }

        return $messages;
    }

    // Страница каталога публичная, а ссылку с кривым параметром легко получить правкой URL.
    // Поэтому вместо стандартного «назад с ошибками» отправляем на ту же категорию, оставив только
    // корректные параметры: остальные фильтры продолжают работать, а причина сброса видна в $errors
    protected function failedValidation(Validator $validator): void
    {
        $valid = array_filter($validator->valid(), fn ($value) => $value !== null);

        throw new HttpResponseException(
            redirect()
                ->route('catalog', ['slug' => $this->route('slug')] + $valid)
                ->withErrors($validator)
        );
    }
}
