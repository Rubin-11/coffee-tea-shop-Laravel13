<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Создание главных категорий
        $mainCategories = $this->createMainCategories();

        // Создаем подкатегории для всех категорий
        $this->createFreshCoffeeSubcategories($mainCategories);
        $this->createTeaDrinksSubcategories($mainCategories);
        $this->createVendingSubcategories($mainCategories);
        $this->createHealthyFoodSubcategories($mainCategories);
    }

    private function createMainCategories(): array
    {
        $categories = [];

        // Массив с данными главных категорий
        $mainCategories = [
            [
                'name' => 'Свежеобжаренный кофе',
                'slug' => 'svezheobzharennyy-kofe',
                'description' => 'Премиальный кофе свежей обжарки из лучших плантаций мира. Арабика и робуста высшего качества из Африки, Азии, Центральной и Латинской Америки.',
                'image' => 'img/category/fresh-roasted-coffee.png',
            ],
            [
                'name' => 'Чай и кофейные напитки',
                'slug' => 'chay-i-kofejnye-napitki',
                'description' => 'Качественный листовой чай всех видов и готовые кофейные напитки. Черный, зеленый, улун, матча, пуэр и растворимый кофе.',
                'image' => 'img/category/tea-coffee-drinks.png',
            ],
            [
                'name' => 'Продукция вендинга',
                'slug' => 'produktsiya-vendinga',
                'description' => 'Профессиональные решения для вендинговых аппаратов. Растворимый кофе, цикорий, какао, сухое молоко и сопутствующие товары.',
                'image' => 'img/category/vending-products.png',
            ],
            [
                'name' => 'Здоровое питание',
                'slug' => 'zdorovoe-pitanie',
                'description' => 'Полезные продукты для здорового образа жизни: цикорий, ячменные напитки, протеиновые смеси, толокняные каши и органический кофе.',
                'image' => 'img/category/healthy-food.png.png',
            ]
        ];

        // Создаем категории в базе данных
        foreach ($mainCategories as $categoryData) {
            $category = Category::create([
                'name' => $categoryData['name'],
                'slug' => $categoryData['slug'],
                'description' => $categoryData['description'],
                'image' => $categoryData['image'],
                'parent_id' => null, // Главная категория не имеет родителя
            ]);

            // Сохраняем категорию в массив для последующего использования
            $categories[$categoryData['name']] = $category;
        }

        return $categories;
    }

    private function createFreshCoffeeSubcategories(array $mainCategories): void
    {
        $coffeeCategory = $mainCategories['Свежеобжаренный кофе'];

        $subcategoriesData = [
            [
                'name' => 'Африка',
                'slug' => 'afrika',
                'description' => 'Кофе из африканских стран: Кения, Руанда, Танзания, Бурунди. Яркие фруктовые и цветочные ноты.',
            ],
            [
                'name' => 'Йемен',
                'slug' => 'yemen',
                'description' => 'Легендарный йеменский кофе Мокка с уникальным винно-шоколадным вкусом. Один из древнейших сортов.',
            ],
            [
                'name' => 'Уганда',
                'slug' => 'uganda',
                'description' => 'Угандийская арабика и робуста с плотным телом и мягким вкусом. Отличное соотношение цена-качество.',
            ],
            [
                'name' => 'Эфиопия',
                'slug' => 'efiopiya',
                'description' => 'Родина кофе. Эфиопский кофе славится яркими фруктовыми и цветочными нотами, высокой кислотностью.',
            ],
            [
                'name' => 'Азия',
                'slug' => 'aziya',
                'description' => 'Азиатский кофе из Индонезии, Вьетнама, Индии. Характерны землистые ноты, плотное тело, низкая кислотность.',
            ],
            [
                'name' => 'Центральная Америка',
                'slug' => 'centralnaya-amerika',
                'description' => 'Кофе из Гватемалы, Коста-Рики, Панамы, Сальвадора. Сбалансированный вкус с нотами какао и цитрусов.',
            ],
            [
                'name' => 'Латинская Америка',
                'slug' => 'latinskaya-amerika',
                'description' => 'Колумбия, Бразилия, Перу, Эквадор. Классические сорта с шоколадно-ореховым профилем, средней кислотностью.',
            ],
        ];
        foreach ($subcategoriesData as $subcategoryData) {
            Category::create([
                'name' => $subcategoryData['name'],
                'slug' => $subcategoryData['slug'],
                'description' => $subcategoryData['description'],
                'image' => null,
                'parent_id' => $coffeeCategory->id,
            ]);

            $this->command->line("  ✓ Создана подкатегория: {$subcategoryData['name']} (родитель: {$coffeeCategory->name})");
        }
    }

    private function createTeaDrinksSubcategories(array $mainCategories): void
    {
        $teaCategory = $mainCategories['Чай и кофейные напитки'];

        $subcategoriesData = [
            [
                'name' => 'Черный чай',
                'slug' => 'chernyy-chay',
                'description' => 'Классический черный чай из Индии, Цейлона, Китая. Насыщенный вкус и аромат.',
            ],
            [
                'name' => 'Зеленый чай',
                'slug' => 'zelenyy-chay',
                'description' => 'Зеленый чай из Китая и Японии. Освежающий вкус, богат антиоксидантами.',
            ],
            [
                'name' => 'Молочный улун',
                'slug' => 'molochnyy-ulung',
                'description' => 'Популярный полуферментированный чай с нежным молочно-сливочным вкусом.',
            ],
            [
                'name' => 'Травяной чай',
                'slug' => 'travyanoy-chay',
                'description' => 'Травяные и фруктовые чаи без кофеина: ройбуш, каркаде, мята, ромашка.',
            ],
            [
                'name' => 'Матча',
                'slug' => 'matcha',
                'description' => 'Японский порошковый зеленый чай матча премиум качества. Богат антиоксидантами.',
            ],
            [
                'name' => 'Пуэр',
                'slug' => 'puer',
                'description' => 'Выдержанный китайский чай пуэр. Глубокий, землистый вкус, полезен для пищеварения.',
            ],
            [
                'name' => 'Кофейные напитки',
                'slug' => 'kofejnye-napitki',
                'description' => 'Растворимый кофе, капучино, латте-миксы. Удобные готовые решения.',
            ],
        ];

        foreach ($subcategoriesData as $subcategoryData) {
            Category::create([
                'name' => $subcategoryData['name'],
                'slug' => $subcategoryData['slug'],
                'description' => $subcategoryData['description'],
                'image' => null,
                'parent_id' => $teaCategory->id,
            ]);

            $this->command->line("  ✓ Создана подкатегория: {$subcategoryData['name']} (родитель: {$teaCategory->name})");
        }
    }

    private function createVendingSubcategories(array $mainCategories): void
    {
        $vendingCategory = $mainCategories['Продукция вендинга'];

        $subcategoriesData = [
            [
                'name' => 'Гранулированный кофе',
                'slug' => 'granulirovannyy-kofe',
                'description' => 'Растворимый гранулированный кофе для вендинговых аппаратов. Быстрое приготовление.',
            ],
            [
                'name' => 'Гранулированный цикорий',
                'slug' => 'granulirovannyy-tsikoriy',
                'description' => 'Растворимый цикорий для вендинга. Альтернатива кофе без кофеина.',
            ],
            [
                'name' => 'Зерновой кофе',
                'slug' => 'zernovoy-kofe-vending',
                'description' => 'Зерновой кофе для профессиональных кофейных автоматов.',
            ],
            [
                'name' => 'Гранулированный какао',
                'slug' => 'granulirovannyy-kakao',
                'description' => 'Растворимый какао-порошок для приготовления горячего шоколада в автоматах.',
            ],
            [
                'name' => 'Гранулированные кофейные напитки',
                'slug' => 'granulirovannye-kofejnye-napitki',
                'description' => 'Готовые миксы: капучино, латте, горячий шоколад для вендинга.',
            ],
            [
                'name' => 'Кофе порошкообразный',
                'slug' => 'kofe-poroshkoobraznyy',
                'description' => 'Порошковый кофе для вендинговых аппаратов. Быстрое растворение.',
            ],
            [
                'name' => 'Сухое молоко гранулированное',
                'slug' => 'suhoe-moloko-granulirovannoe',
                'description' => 'Сухие сливки и молоко для приготовления напитков в автоматах.',
            ],
        ];

        foreach ($subcategoriesData as $subcategoryData) {
            Category::create([
                'name' => $subcategoryData['name'],
                'slug' => $subcategoryData['slug'],
                'description' => $subcategoryData['description'],
                'image' => null,
                'parent_id' => $vendingCategory->id,
            ]);

            $this->command->line("  ✓ Создана подкатегория: {$subcategoryData['name']} (родитель: {$vendingCategory->name})");
        }
    }

    private function createHealthyFoodSubcategories(array $mainCategories): void
    {
        $healthyCategory = $mainCategories['Здоровое питание'];

        $subcategoriesData = [
            [
                'name' => 'Цикорий и корень цикория',
                'slug' => 'tsikoriy-i-koren-tsikoriya',
                'description' => 'Натуральный цикорий - полезная альтернатива кофе без кофеина. Улучшает пищеварение.',
            ],
            [
                'name' => 'Ячменные напитки',
                'slug' => 'yachmennye-napitki',
                'description' => 'Напитки из обжаренного ячменя. Мягкий вкус, без кофеина, полезны для здоровья.',
            ],
            [
                'name' => 'Напитки для здоровья',
                'slug' => 'napitki-dlya-zdorovya',
                'description' => 'Функциональные напитки: детокс-чаи, имбирные напитки, куркума латте.',
            ],
            [
                'name' => 'Протеиновые смеси',
                'slug' => 'proteinovye-smesi',
                'description' => 'Протеиновые смеси с кофе, матча и шоколадом. Для спортивного питания.',
            ],
            [
                'name' => 'Толокняные каши',
                'slug' => 'toloknyannye-kashi',
                'description' => 'Полезные толокняные и овсяные каши с натуральными добавками.',
            ],
        ];

        foreach ($subcategoriesData as $subcategoryData) {
            Category::create([
                'name' => $subcategoryData['name'],
                'slug' => $subcategoryData['slug'],
                'description' => $subcategoryData['description'],
                'image' => null,
                'parent_id' => $healthyCategory->id,
            ]);

            $this->command->line("  ✓ Создана подкатегория: {$subcategoryData['name']} (родитель: {$healthyCategory->name})");
        }
    }
}
