<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('☕ создание свойств товаров...');
        $this->command->newLine();

        $this->createProperty();
    }

    public function createProperty(): void
    {
        $property = [
            'Способ обжарки' => [
                ['value' => 'Сухая'],
                ['value' => 'Мытая'],
                ['value' => 'Прочие'],
            ],
            'Кислинка' => [
                ['value' => 'Низкая'],
                ['value' => 'Средняя'],
                ['value' => 'Высокая'],
            ],
            'Особые' => [
                ['value' => 'Популярное'],
                ['value' => 'Новый урожай'],
                ['value' => 'Ваш выбор'],
                ['value' => 'Микролот'],
                ['value' => 'Сорт недели'],
                ['value' => 'Скидки'],
                ['value' => 'Новинка'],
            ],
            'Вид кофе' => [
                ['value' => 'Арабика'],
                ['value' => 'Рабуста'],
                ['value' => 'Смесь арабики'],
                ['value' => 'Смесь арабика/рабуста'],
            ],
            'Рейтинг' => [
                ['value_int' => 1],
                ['value_int' => 2],
                ['value_int' => 3],
                ['value_int' => 4],
                ['value_int' => 5],
            ],
            'Степень обжарки' => [
                ['value_int' => 1],
                ['value_int' => 2],
                ['value_int' => 3],
                ['value_int' => 4],
                ['value_int' => 5],
            ],
            'Кислинка число' => [
                ['value_int' => 1],
                ['value_int' => 2],
                ['value_int' => 3],
                ['value_int' => 4],
                ['value_int' => 5],
                ['value_int' => 6],
                ['value_int' => 7],
                ['value_int' => 8],
                ['value_int' => 9],
                ['value_int' => 10],
            ],
            'Горчинка' => [
                ['value_int' => 1],
                ['value_int' => 2],
                ['value_int' => 3],
                ['value_int' => 4],
                ['value_int' => 5],
                ['value_int' => 6],
                ['value_int' => 7],
                ['value_int' => 8],
                ['value_int' => 9],
                ['value_int' => 10],
            ],
            'Насыщенность' => [
                ['value_int' => 1],
                ['value_int' => 2],
                ['value_int' => 3],
                ['value_int' => 4],
                ['value_int' => 5],
                ['value_int' => 6],
                ['value_int' => 7],
                ['value_int' => 8],
                ['value_int' => 9],
                ['value_int' => 10],
            ],
        ];

        foreach ($property as $name => $values) {
            foreach ($values as $value) {
                if (isset($value['value'])) {
                    $valueV = 'value';
                } elseif (isset($value['value_int'])) {
                    $valueV = 'value_int';
                } else {
                    $this->command->info('❌ Ошибка с ключом массива...');
                    continue;
                }
                Property::create([
                    'name' => $name,
                    "$valueV" => $value["$valueV"],
                ]);
            }
        }
    }
}
