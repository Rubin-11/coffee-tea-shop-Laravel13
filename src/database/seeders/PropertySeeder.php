<?php

namespace Database\Seeders;

use App\Models\PropertyGroup;
use Illuminate\Database\Seeder;

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
        // slug => [название группы, несколько значений у товара?, значения]
        $groups = [
            'processing-method' => ['Способ обжарки', false, ['Сухая', 'Мытая', 'Прочие']],
            'acidity' => ['Кислинка', false, ['Низкая', 'Средняя', 'Высокая']],
            'specials' => ['Особые', true, [
                'Популярное', 'Новый урожай', 'Ваш выбор', 'Микролот', 'Сорт недели', 'Скидки', 'Новинка',
            ]],
            'coffee-type' => ['Вид кофе', false, ['Арабика', 'Рабуста', 'Смесь арабики', 'Смесь арабика/рабуста']],
            'rating' => ['Рейтинг', false, range(1, 5)],
            'roast-level' => ['Степень обжарки', false, range(1, 5)],
            'acidity-level' => ['Кислинка число', false, range(1, 10)],
            'bitterness' => ['Горчинка', false, range(1, 10)],
            'body' => ['Насыщенность', false, range(1, 10)],
        ];

        $groupSort = 0;
        foreach ($groups as $slug => [$name, $isMultiple, $values]) {
            $group = PropertyGroup::create([
                'name' => $name,
                'slug' => $slug,
                'is_multiple' => $isMultiple,
                'sort' => ++$groupSort,
            ]);

            // Порядок значений в массиве = порядок вывода (sort)
            foreach (array_values($values) as $i => $value) {
                $group->properties()->create(['value' => (string) $value, 'sort' => $i + 1]);
            }
        }
    }
}
