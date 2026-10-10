# Товары и характеристики

Модели: `app/Models/Product.php`, `app/Models/Property.php`, `app/Models/ProductImage.php`
Миграции: `create_products_table`, `create_properties_table`, `create_product_properties_table`, `create_product_images_table`

## `products`

| Колонка | Тип | Примечание |
|---|---|---|
| `category_id` | FK → `categories.id` | |
| `name`, `slug` (unique), `description` | string | |
| `price` | decimal(10,2) | |
| `quantity` | integer | складской остаток |
| `reviews_count` | integer, default 0 | счётчик отзывов — сам отзыв как сущность пока не реализован |

Связи `Product`: `category()` (BelongsTo), `productsImages()` (HasMany → `ProductImage`),
`properties()` (BelongsToMany → `Property` через `product_properties`), `users()` (BelongsToMany
→ `User` через `baskets` — это и есть связь "товар в корзине у пользователя", см.
[users-baskets-orders.md](users-baskets-orders.md)), `orders()` (BelongsToMany → `Order` через
`orders_products`).

## `properties` — характеристики как универсальная таблица "имя группы → значение"

| Колонка | Тип |
|---|---|
| `name` | string — имя группы характеристики, например `"Способ обжарки"` |
| `value` | string, nullable — для категориальных значений ("Сухая", "Арабика") |
| `value_int` | integer, nullable — для числовых шкал (1..5, 1..10) |

Это не одна строка на характеристику товара, а справочник возможных значений: каждая пара
"группа + конкретное значение" — отдельная строка. Например, группа `"Кислинка"` — это три
строки (Низкая/Средняя/Высокая), группа `"Насыщенность"` — десять строк (`value_int` 1..10).
Какие именно значения привязаны к конкретному товару — решает pivot-таблица
`product_properties`, не эта таблица.

Группы, которые реально существуют в данных (см. `PropertySeeder`):
`Способ обжарки`, `Кислинка`, `Особые`, `Вид кофе`, `Рейтинг`, `Степень обжарки`,
`Кислинка число`, `Горчинка`, `Насыщенность`.


## `product_properties` — пивот `products` ↔ `properties`

`unique(['product_id', 'property_id'])` — у одной пары товар/характеристика не может быть
дублей. Сама таблица не ограничивает, сколько строк одной группы (`name`) может быть у
одного товара — это только соглашение в коде сидера
(см. [features/seeders.md](../features/seeders.md)): для категориальных и числовых групп —
по одному значению на товар, а для группы `"Особые"` — от 0 до нескольких тегов сразу.

Связь в модели: `Product::properties()` / `Property::products()`, обе `BelongsToMany`.

## `product_images`

Схема есть (`product_id`, `image_path`, `alt_text`), связь `ProductImage::product()` и
`Product::productsImages()` объявлены — но нигде в коде (сидеры, контроллеры, Blade) эта
таблица пока не используется. Карточки товаров сейчас показывают статичную SVG-иконку
вместо реального изображения.
