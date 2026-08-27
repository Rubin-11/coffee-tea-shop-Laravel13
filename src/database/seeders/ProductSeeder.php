<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    private $categories;

    public function run(): void
    {
        $this->command->info('☕ Создание товаров магазина...');
        $this->command->newLine();

        $this->categories = Category::all()->keyBy('slug');

        if ($this->categories->isEmpty()) {
            $this->command->error('❌ Ошибка: сначала нужно запустить CategorySeeder!');
            return;
        }
        $this->createCoffee();
        $this->createTea();
        $this->createProductsVendinga();
        $this->createHealthyFoodProducts();
    }

    public function createCoffee(): void
    {
        $coffeeProductsByRegion = [
            'afrika' => [
                ['name' => 'Кения АА', 'slug' => 'Kenya-AA', 'description' => 'Арабика с яркой кислинкой и нотами чёрных ягод', 'price' => 580, 'quantity' => 300],
                ['name' => 'Руанда Bourbon', 'slug' => 'Rwanda-Bourbon', 'description' => 'Мягкий кофе с цветочными нотами и лёгкой цитрусовой кислинкой', 'price' => 520, 'quantity' => 150],
                ['name' => 'Танзания Пиберри', 'slug' => 'Tanzania-Piberries', 'description' => 'Плотное тело с оттенками чёрной смородины и вина', 'price' => 550, 'quantity' => 200],
                ['name' => 'Бурунди', 'slug' => 'Burundi', 'description' => 'Выразительный вкус с цитрусовыми нотами и медовым послевкусием', 'price' => 540, 'quantity' => 100],
                ['name' => 'Замбия', 'slug' => 'Zambia', 'description' => 'Мягкий кофе с шоколадными нотами и лёгкой сладостью', 'price' => 510, 'quantity' => 250],
            ],
            'yemen' => [
                ['name' => 'Йемен Мокка', 'slug' => 'Yemen-Mocha', 'description' => 'Кофе с винными нотами и оттенками шоколада и специй', 'price' => 780, 'quantity' => 80],
                ['name' => 'Йемен Матари', 'slug' => 'Yemen-Mathari', 'description' => 'Зелёный кофе с пряным вкусом и кофейными нотами', 'price' => 820, 'quantity' => 60],
            ],
            'uganda' => [
                ['name' => 'Уганда Бугису', 'slug' => 'Uganda-Bugisu', 'description' => 'Арабика с balanced вкусом и нотами шоколада и фруктов', 'price' => 460, 'quantity' => 180],
                ['name' => 'Уганда Робуста', 'slug' => 'Uganda-Robusta', 'description' => 'Крепкий кофе с плотным телом и ореховыми нотами', 'price' => 380, 'quantity' => 350],
            ],
            'efiopiya' => [
                ['name' => 'Эфиопия Иргачиф', 'slug' => 'Ethiopia-Irgachif', 'description' => 'Цветочный аромат с цитрусовыми нотами и лёгкой сладостью', 'price' => 520, 'quantity' => 220],
                ['name' => 'Эфиопия Сидамо', 'slug' => 'Ethiopia-Sidamo', 'description' => 'Кофе с яркой кислинкой и фруктовыми оттенками', 'price' => 490, 'quantity' => 170],
                ['name' => 'Эфиопия Харар', 'slug' => 'Ethiopia-Harar', 'description' => 'Плотный кофе с ягодными нотами и винными оттенками', 'price' => 560, 'quantity' => 130],
                ['name' => 'Эфиопия Йоргачеффе', 'slug' => 'Ethiopia-Yirgacheffe', 'description' => 'Сладкий кофе с цветочными нотами и нотами черники', 'price' => 580, 'quantity' => 90],
                ['name' => 'Эфиопия Лиму', 'slug' => 'Ethiopia-Limu', 'description' => 'Светлая обжарка с лимонными нотами и медовым послевкусием', 'price' => 510, 'quantity' => 260],
            ],
            'aziya' => [
                ['name' => 'Суматра Манделинг', 'slug' => 'Sumatra-Mandheling', 'description' => 'Плотный кофе с землистыми нотами и горьким шоколадом', 'price' => 460, 'quantity' => 300],
                ['name' => 'Ява Арабика', 'slug' => 'Java-Arabica', 'description' => 'Мягкий кофе с травянистыми нотами и низкой кислинкой', 'price' => 440, 'quantity' => 110],
                ['name' => 'Сулавеси Торая', 'slug' => 'Sulawesi-Toraja', 'description' => 'Кофе с пряными нотами и шоколадно-ореховым вкусом', 'price' => 490, 'quantity' => 140],
                ['name' => 'Бали Кинтамани', 'slug' => 'Bali-Kintamani', 'description' => 'Свежий кофе с цитрусовыми нотами и травянистым послевкусием', 'price' => 520, 'quantity' => 160],
                ['name' => 'Вьетнам Арабика', 'slug' => 'Vietnam-Arabica', 'description' => 'Кофе с фруктовыми нотами и лёгкой кислинкой', 'price' => 390, 'quantity' => 400],
            ],
            'centralnaya-amerika' => [
                ['name' => 'Гватемала Антигуа', 'slug' => 'Guatemala-Antigua', 'description' => 'Кофе с шоколадными нотами и специями с плотным телом', 'price' => 480, 'quantity' => 210],
                ['name' => 'Гватемала Уэуэтенанго', 'slug' => 'Guatemala-Huatusco', 'description' => 'Чистый вкус с фруктовыми нотами и какао', 'price' => 520, 'quantity' => 120],
                ['name' => 'Коста-Рика Тарразу', 'slug' => 'Costa-Rica-Tarrazu', 'description' => 'Яркий кофе с плотным телом и карамельной сладостью', 'price' => 540, 'quantity' => 180],
                ['name' => 'Коста-Рика Центральная Долина', 'slug' => 'Costa-Rica-Central-Valley', 'description' => 'Сбалансированный кофе с медовыми нотами', 'price' => 510, 'quantity' => 240],
                ['name' => 'Панама Гейша', 'slug' => 'Panama-Geisha', 'description' => 'Элитный кофе с цветочными нотами жасмина и тропических фруктов', 'price' => 890, 'quantity' => 40],
                ['name' => 'Сальвадор', 'slug' => 'Salvador', 'description' => 'Мягкий кофе с ореховыми нотами и карамельным послевкусием', 'price' => 470, 'quantity' => 190],
            ],
            'latinskaya-amerika' => [
                ['name' => 'Колумбия Супремо', 'slug' => 'Colombia-Supremo', 'description' => 'Сбалансированный кофе с карамельными нотами и красными фруктами', 'price' => 450, 'quantity' => 280],
                ['name' => 'Колумбия Уила', 'slug' => 'Colombia-Huila', 'description' => 'Кофе с нотами шоколада, орехов и красных фруктов', 'price' => 480, 'quantity' => 160],
                ['name' => 'Колумбия Эксельсо', 'slug' => 'Colombia-Excelso', 'description' => 'Мягкий кофе с медовыми нотами и лёгкой кислинкой', 'price' => 420, 'quantity' => 320],
                ['name' => 'Бразилия Сантос', 'slug' => 'Brazil-Santos', 'description' => 'Низкая кислинка с шоколадными и ореховыми нотами', 'price' => 380, 'quantity' => 450],
                ['name' => 'Бразилия Моджиана', 'slug' => 'Brazil-Mogiana', 'description' => 'Плотный кофе с шоколадными нотами и низкой кислинкой', 'price' => 400, 'quantity' => 370],
                ['name' => 'Бразилия Серрадо', 'slug' => 'Brazil-Serrado', 'description' => 'Сладкий кофе с нотами сухофруктов и орехов', 'price' => 420, 'quantity' => 230],
                ['name' => 'Перу', 'slug' => 'Peru', 'description' => 'Мягкий кофе с шоколадными нотами и лёгкой кислинкой', 'price' => 440, 'quantity' => 200],
                ['name' => 'Эквадор', 'slug' => 'Ecuador', 'description' => 'Экзотический кофе с тропическими нотами и медовым послевкусием', 'price' => 460, 'quantity' => 150],
            ],
        ];

        // Создаем продукты кофе в базе данных
        foreach ($coffeeProductsByRegion as $categorySlug => $coffeeProducts) {
            if (!isset($this->categories[$categorySlug])) {
                $this->command->warn("  ⚠ Категория '{$categorySlug}' не найдена, пропускаем");
                continue;
            }
            foreach ($coffeeProducts as $product) {
                Product::create([
                    'category_id' => $this->categories[$categorySlug]->id,
                    'name' => $product['name'],
                    'slug' => $product['slug'],
                    'description' => $product['description'],
                    'price' => $product['price'],
                    'quantity' => $product['quantity'],
                ]);
            }
        }
    }

    public function createTea(): void
    {
        $teaProductsByCategory = [
            'chernyy-chay' => [
                ['name' => 'Черный чай Эрл Грей', 'slug' => 'earl-grey-black-tea', 'description' => 'Чёрный чай с натуральной добавкой масла бергамота. Яркий цитрусовый аромат и насыщенный вкус.', 'price' => 280, 'quantity' => 200],
                ['name' => 'Ассам FTGFOP1', 'slug' => 'assam-ftgfop1', 'description' => 'Индийский чай высшего качества. Мальтийский вкус с нотами сухофруктов и плотным телом.', 'price' => 320, 'quantity' => 180],
                ['name' => 'Дарджилинг первый сбор', 'slug' => 'darjeeling-first-flush', 'description' => 'Элитный индийский чай с лёгким цветочным ароматом и нежным фруктовым вкусом.', 'price' => 450, 'quantity' => 120],
                ['name' => 'Цейлонский Оранж Пеко', 'slug' => 'ceylon-orange-peko', 'description' => 'Шри-ланкийский чай с ярким вкусом, нотами специй и золотистым цветом настоя.', 'price' => 290, 'quantity' => 250],
            ],
            'zelenyy-chay' => [
                ['name' => 'Зеленый чай Сенча', 'slug' => 'green-sencha', 'description' => 'Классический японский зеленый чай. Освежающий вкус с лёгкой терпкостью и травянистым ароматом.', 'price' => 260, 'quantity' => 220],
                ['name' => 'Жасминовый чай Мао Фэн', 'slug' => 'jasmine-mao-feng', 'description' => 'Китайский зеленый чай, ароматизированный цветками жасмина. Нежный сладкий вкус.', 'price' => 340, 'quantity' => 160],
                ['name' => 'Генмайча', 'slug' => 'genmaicha', 'description' => 'Японский зеленый чай с обжаренным рисом. Насыщенный ореховый вкус и аромат.', 'price' => 310, 'quantity' => 190],
                ['name' => 'Лунцзин', 'slug' => 'longjing-dragon-well', 'description' => 'Легендарный китайский зеленый чай. Мягкий сладкий вкус с ореховыми нотами.', 'price' => 420, 'quantity' => 100],
                ['name' => 'Би Ло Чунь', 'slug' => 'bi-luo-chun', 'description' => 'Элитный китайский зеленый чай с цветочным ароматом и сладким фруктовым вкусом.', 'price' => 380, 'quantity' => 140],
            ],
            'molochnyy-ulung' => [
                ['name' => 'Молочный улун классический', 'slug' => 'classic-milk-oolong', 'description' => 'Полуферментированный чай с нежным молочно-сливочным вкусом и цветочным ароматом.', 'price' => 350, 'quantity' => 170],
                ['name' => 'Молочный улун премиум', 'slug' => 'premium-milk-oolong', 'description' => 'Отборный молочный улун с выраженным сливочным вкусом и долгим послевкусием.', 'price' => 420, 'quantity' => 130],
                ['name' => 'Женьшень улун', 'slug' => 'ginseng-oolong', 'description' => 'Улун с добавлением женьшеня. Уникальный вкус с лекарственными нотами и мягким ароматом.', 'price' => 380, 'quantity' => 150],
            ],
            'travyanoy-chay' => [
                ['name' => 'Ройбуш ванильный', 'slug' => 'vanilla-rooibos', 'description' => 'Южноафриканский чай ройбуш с натуральной ванилью. Без кофеина, сладкий вкус.', 'price' => 240, 'quantity' => 280],
                ['name' => 'Каркаде высшего сорта', 'slug' => 'premium-hibiscus', 'description' => 'Египетский чай каркаде из цветков гибискуса. Яркий кислый вкус, богат витамином C.', 'price' => 220, 'quantity' => 300],
                ['name' => 'Мятный чай', 'slug' => 'mint-tea', 'description' => 'Освежающий травяной чай с натуральной мятой. Успокаивающий эффект, приятный аромат.', 'price' => 190, 'quantity' => 320],
                ['name' => 'Ромашковый чай', 'slug' => 'chamomile-tea', 'description' => 'Натуральный ромашковый чай с мягким вкусом и цветочным ароматом. Без кофеина.', 'price' => 180, 'quantity' => 260],
            ],
            'matcha' => [
                ['name' => 'Матча премиум класс', 'slug' => 'premium-matcha', 'description' => 'Японская матча премиум качества. Насыщенный умами вкус, яркий зеленый цвет.', 'price' => 580, 'quantity' => 100],
                ['name' => 'Матча церемониальная', 'slug' => 'ceremonial-matcha', 'description' => 'Высший сорт для чайных церемоний. Нежный сладкий вкус и изумрудный оттенок.', 'price' => 680, 'quantity' => 80],
                ['name' => 'Матча кулинарная', 'slug' => 'culinary-matcha', 'description' => 'Идеальна для выпечки, латте и десертов. Выраженный вкус, доступная цена.', 'price' => 420, 'quantity' => 140],
            ],
            'puer' => [
                ['name' => 'Пуэр Шу 5 лет выдержки', 'slug' => 'shu-puer-5-years', 'description' => 'Ферментированный пуэр с плотным телом, землистым вкусом и глубоким ароматом.', 'price' => 450, 'quantity' => 120],
                ['name' => 'Пуэр Шен 3 года', 'slug' => 'sheng-puer-3-years', 'description' => 'Природный пуэр с терпким вкусом, цветочными нотами и долгим послевкусием.', 'price' => 520, 'quantity' => 90],
                ['name' => 'Пуэр Мини То Ча', 'slug' => 'mini-puer-to-cha', 'description' => 'Компактный прессованный пуэр в форме чаши. Удобная порционная форма.', 'price' => 380, 'quantity' => 200],
            ],
            'kofejnye-napitki' => [
                ['name' => 'Растворимый кофе Премиум', 'slug' => 'premium-instant-coffee', 'description' => 'Качественный растворимый кофе гранулированный. Насыщенный вкус, быстрое приготовление.', 'price' => 320, 'quantity' => 400],
                ['name' => 'Сублимированный кофе Gold', 'slug' => 'freeze-dried-gold-coffee', 'description' => 'Сублимированный кофе высшего качества. Сохраняет аромат свежесваренного кофе.', 'price' => 450, 'quantity' => 250],
                ['name' => 'Капучино 3в1', 'slug' => 'cappuccino-3in1', 'description' => 'Готовый напиток капучино с молоком и сахаром. Удобный порционный формат.', 'price' => 180, 'quantity' => 500],
                ['name' => 'Латте микс', 'slug' => 'latte-mix', 'description' => 'Классический латте с молоком. Мягкий сливочный вкус, готов за считанные минуты.', 'price' => 200, 'quantity' => 450],
                ['name' => 'Айс-кофе микс', 'slug' => 'iced-coffee-mix', 'description' => 'Холодный кофейный напиток с молоком. Освежающий сладкий вкус для летних дней.', 'price' => 150, 'quantity' => 350],
            ],
        ];

        // Создаем продукты чая в базе данных
        foreach ($teaProductsByCategory as $categorySlug => $teaProducts) {
            if (!isset($this->categories[$categorySlug])) {
                $this->command->warn("  ⚠ Категория '{$categorySlug}' не найдена, пропускаем");
                continue;
            }

            foreach ($teaProducts as $product) {
                Product::create([
                    'category_id' => $this->categories[$categorySlug]->id,
                    'name' => $product['name'],
                    'slug' => $product['slug'],
                    'description' => $product['description'],
                    'price' => $product['price'],
                    'quantity' => $product['quantity'],
                ]);
            }
        }
        $this->command->info('✅ Чай и кофейные напитки успешно созданы!');
    }

    public function createProductsVendinga(): void
    {
        $vendingProductsByCategory = [
            'granulirovannyy-kofe' => [
                ['name' => 'Растворимый кофе для вендинга', 'slug' => 'instant-vending-coffee', 'description' => 'Гранулированный растворимый кофе для вендинговых аппаратов. Быстрое растворение и насыщенный вкус.', 'price' => 890, 'quantity' => 200],
                ['name' => 'Растворимый кофе премиум', 'slug' => 'premium-instant-vending', 'description' => 'Растворимый кофе высшего качества. Аромат свежесваренного кофе в удобном формате.', 'price' => 1050, 'quantity' => 150],
                ['name' => 'Растворимый кофе эконом', 'slug' => 'economy-instant-vending', 'description' => 'Доступный растворимый кофе для массового приготовления. Оптимальное соотношение цена-качество.', 'price' => 720, 'quantity' => 300],
            ],
            'granulirovannyy-tsikoriy' => [
                ['name' => 'Цикорий гранулированный', 'slug' => 'granulated-chicory', 'description' => 'Натуральный растворимый цикорий для вендинга. Полезная альтернатива кофе без кофеина.', 'price' => 450, 'quantity' => 250],
                ['name' => 'Цикорий с женьшенем', 'slug' => 'chicory-ginseng', 'description' => 'Цикорий с добавлением женьшеня. Бодрящий эффект и польза для здоровья.', 'price' => 380, 'quantity' => 200],
            ],
            'zernovoy-kofe-vending' => [
                ['name' => 'Зерновой кофе для автоматов', 'slug' => 'vending-bean-coffee', 'description' => 'Специальный зерновой кофе для профессиональных кофейных автоматов.', 'price' => 980, 'quantity' => 180],
                ['name' => 'Зерновой кофе смесь', 'slug' => 'bean-coffee-blend', 'description' => 'Бленд зернового кофе сбалансированный для вендинговых аппаратов.', 'price' => 850, 'quantity' => 220],
            ],
            'granulirovannyy-kakao' => [
                ['name' => 'Какао-порошок для автоматов', 'slug' => 'vending-cocoa-powder', 'description' => 'Растворимый какао-порошок для приготовления горячего шоколада в автоматах.', 'price' => 650, 'quantity' => 280],
                ['name' => 'Какао премиум', 'slug' => 'premium-cocoa', 'description' => 'Какао высшего качества с насыщенным шоколадным вкусом и ароматом.', 'price' => 780, 'quantity' => 200],
            ],
            'granulirovannye-kofejnye-napitki' => [
                ['name' => 'Капучино для вендинга', 'slug' => 'vending-cappuccino', 'description' => 'Гранулированный микс для приготовления капучино. Быстрое растворение, богатый вкус.', 'price' => 720, 'quantity' => 350],
                ['name' => 'Латте-микс', 'slug' => 'latte-mix-vending', 'description' => 'Микс для приготовления латте с молоком. Нежный сливочный вкус.', 'price' => 750, 'quantity' => 320],
                ['name' => 'Горячий шоколад микс', 'slug' => 'hot-chocolate-mix', 'description' => 'Гранулированный микс для приготовления горячего шоколада. Сладкий насыщенный вкус.', 'price' => 720, 'quantity' => 300],
            ],
            'kofe-poroshkoobraznyy' => [
                ['name' => 'Кофе порошкообразный', 'slug' => 'powdered-vending-coffee', 'description' => 'Порошковый кофе для вендинговых аппаратов. Быстрое растворение в горячей воде.', 'price' => 680, 'quantity' => 260],
                ['name' => 'Кофе порошкообразный со сливками', 'slug' => 'powdered-coffee-cream', 'description' => 'Порошковый кофе со сливками. Готовый кофейный напиток с нежным вкусом.', 'price' => 820, 'quantity' => 240],
            ],
            'suhoe-moloko-granulirovannoe' => [
                ['name' => 'Сливки растительные', 'slug' => 'vegetable-cream-vending', 'description' => 'Растительные сливки для вендинга. Идеальны для кофейных напитков.', 'price' => 280, 'quantity' => 400],
                ['name' => 'Сухое молоко цельное', 'slug' => 'whole-dried-milk', 'description' => 'Гранулированное цельное сухое молоко. Натуральный состав, быстрое растворение.', 'price' => 420, 'quantity' => 350],
            ],
        ];

        // Создаем продукты вендинга в базе данных
        foreach ($vendingProductsByCategory as $categorySlug => $vendingProducts) {
            if (!isset($this->categories[$categorySlug])) {
                $this->command->warn("  ⚠ Категория '{$categorySlug}' не найдена, пропускаем");
                continue;
            }

            foreach ($vendingProducts as $product) {
                Product::create([
                    'category_id' => $this->categories[$categorySlug]->id,
                    'name' => $product['name'],
                    'slug' => $product['slug'],
                    'description' => $product['description'],
                    'price' => $product['price'],
                    'quantity' => $product['quantity'],
                ]);
            }
        }

        $this->command->info('✅ Продукция вендинга успешно создана!');
    }

    public function createHealthyFoodProducts(): void
    {
        $healthyProductsByCategory = [
            'tsikoriy-i-koren-tsikoriya' => [
                ['name' => 'Цикорий растворимый натуральный', 'slug' => 'instant-natural-chicory', 'description' => 'Натуральный растворимый цикорий без добавок. Полезная альтернатива кофе.', 'price' => 180, 'quantity' => 300],
                ['name' => 'Корень цикория молотый', 'slug' => 'ground-chicory-root', 'description' => 'Молотый корень цикория для приготовления натурального напитка.', 'price' => 160, 'quantity' => 350],
                ['name' => 'Цикорий с экстрактом женьшеня', 'slug' => 'chicory-ginseng-extract', 'description' => 'Цикорий с добавлением экстракта женьшеня. Бодрящий эффект и польза.', 'price' => 220, 'quantity' => 250],
                ['name' => 'Цикорий с витаминами', 'slug' => 'chicory-with-vitamins', 'description' => 'Цикорий, обогащённый витаминами и минералами. Улучшенный состав.', 'price' => 240, 'quantity' => 280],
            ],
            'yachmennye-napitki' => [
                ['name' => 'Ячменный напиток классический', 'slug' => 'classic-barley-drink', 'description' => 'Напиток из обжаренного ячменя без кофеина. Мягкий вкус, полезен для здоровья.', 'price' => 150, 'quantity' => 400],
                ['name' => 'Ячменный напиток с цикорием', 'slug' => 'barley-chicory-drink', 'description' => 'Ячменный напиток с добавлением цикория. Насыщенный вкус и аромат.', 'price' => 170, 'quantity' => 320],
                ['name' => 'Ячменный напиток с имбирем', 'slug' => 'barley-ginger-drink', 'description' => 'Ячменный напиток с пряным имбирём. Согревающий и полезный.', 'price' => 190, 'quantity' => 280],
            ],
            'napitki-dlya-zdorovya' => [
                ['name' => 'Напиток для здоровья', 'slug' => 'health-drink', 'description' => 'Функциональный напиток для поддержания здоровья. Натуральный состав.', 'price' => 280, 'quantity' => 200],
                ['name' => 'Детокс-чай травяной', 'slug' => 'herbal-detox-tea', 'description' => 'Травяной чай для детокса. Очищает организм и восстанавливает силы.', 'price' => 280, 'quantity' => 220],
                ['name' => 'Имбирный напиток', 'slug' => 'ginger-drink', 'description' => 'Освежающий имбирный напиток с природными специями. Укрепляет иммунитет.', 'price' => 250, 'quantity' => 260],
                ['name' => 'Куркума латте', 'slug' => 'turmeric-latte', 'description' => 'Напиток с куркумой и молоком. Полезные свойства и нежный вкус.', 'price' => 320, 'quantity' => 180],
            ],
            'proteinovye-smesi' => [
                ['name' => 'Протеиновая смесь с кофе', 'slug' => 'protein-coffee-mix', 'description' => 'Протеиновая смесь с натуральным кофе. Идеальна для утреннего приёма энергии.', 'price' => 680, 'quantity' => 150],
                ['name' => 'Протеиновая смесь с матча', 'slug' => 'protein-matcha-mix', 'description' => 'Протеин с японской матчей. Антиоксиданты и заряд бодрости.', 'price' => 720, 'quantity' => 130],
                ['name' => 'Протеиновая смесь шоколадная', 'slug' => 'chocolate-protein-mix', 'description' => 'Шоколадная протеиновая смесь для спортивного питания. Вкус и польза.', 'price' => 850, 'quantity' => 100],
            ],
            'toloknyannye-kashi' => [
                ['name' => 'Толокняная каша классическая', 'slug' => 'classic-oatmeal', 'description' => 'Классическая толокняная каша из овсяной муки. Натуральный продукт здорового питания.', 'price' => 180, 'quantity' => 350],
                ['name' => 'Толокняная каша с ягодами', 'slug' => 'oatmeal-with-berries', 'description' => 'Толокняная каша с натуральными ягодами. Вкус и полезные свойства.', 'price' => 220, 'quantity' => 280],
                ['name' => 'Толокняная каша с орехами', 'slug' => 'oatmeal-with-nuts', 'description' => 'Толокняная каша с миксом орехов. Энергия и насыщенный вкус.', 'price' => 240, 'quantity' => 260],
                ['name' => 'Овсяная каша с суперфудами', 'slug' => 'oatmeal-superfoods', 'description' => 'Овсяная каша с добавлением суперфудов. Витамины и минералы на каждый день.', 'price' => 280, 'quantity' => 220],
            ],
        ];

        // Создаем продукты здорового питания в базе данных
        foreach ($healthyProductsByCategory as $categorySlug => $healthyProducts) {
            if (!isset($this->categories[$categorySlug])) {
                $this->command->warn("  ⚠ Категория '{$categorySlug}' не найдена, пропускаем");
                continue;
            }

            foreach ($healthyProducts as $product) {
                Product::create([
                    'category_id' => $this->categories[$categorySlug]->id,
                    'name' => $product['name'],
                    'slug' => $product['slug'],
                    'description' => $product['description'],
                    'price' => $product['price'],
                    'quantity' => $product['quantity'],
                ]);
            }
        }

        $this->command->info('✅ Продукция здорового питания успешно создана!');
    }
}
