# Товары и характеристики

Модели: `app/Models/Product.php`, `app/Models/PropertyGroup.php`, `app/Models/Property.php`, `app/Models/ProductImage.php`
Миграции: `create_products_table`, `create_property_groups_table`, `create_properties_table`, `create_product_properties_table`, `create_product_images_table`

## `products`

| Колонка | Тип | Примечание |
|---|---|---|
| `category_id` | FK → `categories.id`, `restrictOnDelete` | категорию с товарами удалить нельзя |
| `name`, `slug` (unique) | string | |
| `description` | text | описание длиннее 255 символов не обрезается |
| `price` | decimal(10,2) | |
| `quantity` | integer, `CHECK (quantity >= 0)` | складской остаток, в минус уйти не может |
| `reviews_count` | integer, default 0, `CHECK (reviews_count >= 0)` | счётчик отзывов; обновляется событиями модели `Review`, см. [reviews.md](reviews.md) |
| `deleted_at` | timestamp, nullable (`softDeletes()`) | мягкое удаление, см. ниже |

### Удаление товара — мягкое (изменено 2026-10-19)

Товар, который хоть раз заказывали, физически удалять нельзя: на него ссылается
`orders_products.product_id` (`ON DELETE RESTRICT`), и вместе с ним пропала бы история
заказов. Поэтому в модели `Product` подключён трейт
[`SoftDeletes`](https://laravel.com/docs/13.x/eloquent#soft-deleting):

- `$product->delete()` не удаляет строку, а записывает время в `deleted_at`;
- все запросы через `Product::` (каталог, `CatalogController`) автоматически добавляют
  `where deleted_at is null`, поэтому удалённый товар пропадает с витрины без правок в
  контроллерах;
- `Product::withTrashed()` показывает и удалённые, `Product::onlyTrashed()` только
  удалённые (пригодится для «корзины» в админке), `$product->restore()` возвращает товар;
- `$product->forceDelete()` удаляет строку по-настоящему. Если товар есть в заказах,
  Postgres не даст это сделать (ошибка `23001 restrict_violation`). Товар без заказов
  удалится, и тогда каскадом уйдут его картинки, характеристики и строки корзин.

Что ещё сделано вокруг мягкого удаления:
- `Order::products()` вызывает `withTrashed()`. Без этого Laravel применил бы скрытие
  удалённых и к составу заказа, и позиции удалённых товаров исчезли бы из старых заказов.
- В `Product::booted()` есть обработчик события `deleted`: при удалении товара (мягком или
  полном) его строки удаляются из `baskets`, потому что купить такой товар уже нельзя.
  Внешний ключ `baskets.product_id ... cascade` срабатывает только при физическом
  удалении, при мягком строка в `products` остаётся, поэтому чистить корзины нужно в коде.
- У `products.category_id` явно указан `restrictOnDelete()`. Так было и раньше (это
  поведение по умолчанию), теперь это видно в миграции. Мягко удалённые товары тоже держат
  категорию, поэтому перед удалением категории товары нужно перенести в другую.

Нюанс на будущее (админка): `slug` уникален по всей таблице, включая удалённые товары.
Новый товар с тем же slug, что у удалённого, создать не получится, пока старый не
восстановлен или не удалён полностью.

Связи `Product`: `category()` (BelongsTo), `productsImages()` (HasMany → `ProductImage`),
`reviews()` (HasMany → `Review`), `properties()` (BelongsToMany → `Property` через `product_properties`), `syncProperties()` (запись характеристик, см. ниже), `users()` (BelongsToMany
→ `User` через `baskets` — это и есть связь "товар в корзине у пользователя", см.
[users-baskets-orders.md](users-baskets-orders.md)), `orders()` (BelongsToMany → `Order` через
`orders_products`).

## Характеристики: три таблицы (изменено 2026-10-20)

Раньше всё лежало в одной `properties` (`name` + `value` + `value_int`): группа была просто
повторяющимся текстом, БД не знала, что «Светлая» и «Тёмная» — варианты одной обжарки, а
фильтры в `CatalogController` искали группы по русским строкам. Теперь три таблицы:

```
property_groups                 properties                         product_properties
(Обжарка, Кислинка…)            (значения групп)                   (что у какого товара)
───────────────────             ─────────────────────              ────────────────────────────
id                              id                                 product_id → products
name  unique                    group_id → property_groups         property_id ┐ составной FK
slug  unique                    value   '«Сухая»' / '7'            group_id    ┘ → properties(id, group_id)
is_multiple                     sort                               is_multiple ── составной FK
sort                            unique(group_id, value)                          (group_id, is_multiple)
unique(id, is_multiple)         unique(id, group_id)                             → property_groups
```

### `property_groups`
Одна строка — одна характеристика («Степень обжарки»). `slug` — ключ для кода и фильтров
(`roast-level`, `body`…), от русского названия ничего не зависит. `is_multiple`: `false` —
у товара ровно одно значение группы (обжарка, кислинка), `true` — несколько (теги группы
«Особые»: «Популярное», «Скидки»). `sort` — порядок вывода групп.

### `properties`
Одна строка — одно значение группы. Тексты («Сухая») и числа шкалы («7») хранятся в одной
колонке `value` (string), вместо прежней пары `value` / `value_int`; порядок вывода — `sort`.
`unique(group_id, value)` не даёт завести дубль значения в группе. Второй индекс
`unique(id, group_id)` технически избыточен (`id` и так уникален), но нужен как цель
составного внешнего ключа из `product_properties`.

### `product_properties` — пивот, который знает про группу
Кроме `product_id` / `property_id` хранит копии `group_id` и `is_multiple`. Зачем: обычный
`unique(product_id, property_id)` пропустил бы товару и «Светлую», и «Тёмную» обжарку сразу
(пары разные). Поэтому:

1. **Составной FK `(property_id, group_id) → properties(id, group_id)`** — `group_id` в пивоте
   обязан совпадать с группой самого значения, подделать нельзя.
2. **Составной FK `(group_id, is_multiple) → property_groups(id, is_multiple)`** — флаг
   в пивоте обязан совпадать с флагом группы. Смена `is_multiple` в группе каскадно
   (`ON UPDATE CASCADE`) обновит пивот; если после этого у какого-то товара окажется
   несколько значений одиночной группы, Postgres отклонит смену флага.
3. **Частичный уникальный индекс** `product_properties_single_value` на
   `(product_id, group_id) WHERE NOT is_multiple` — не больше одного значения на товар для
   одиночных групп. Для `is_multiple = true` ограничения нет. Частичные индексы Blueprint не
   умеет, поэтому индекс создаётся через `DB::statement()` в миграции.
4. `unique(product_id, property_id)` остаётся — не дублировать одно и то же значение.
5. `index('property_id')` — фильтр каталога ищет товары по значению характеристики, а
   составной unique начинается с `product_id` и для такого поиска не подходит.

### Как записывать характеристики товара
`$product->properties()->sync([...])` напрямую **не годится**: он не заполнит `group_id` и
`is_multiple`, и вставка упадёт на NOT NULL. Для этого есть `Product::syncProperties(array
$propertyIds)` — берёт значения вместе с группами (`Property::with('group')`), собирает
`[property_id => ['group_id' => …, 'is_multiple' => …]]` и вызывает `sync()`. Так же будет
сохранять характеристики админка.

### Фильтры каталога
`CatalogController::PROPERTY_FILTERS` связывает параметр query string со slug группы:
`processing → processing-method`, `roast_level → roast-level`, `acidity`, `coffee_type →
coffee-type`, `body`, `bitterness`. Один цикл вместо шести копий `where('name', 'Русская
строка')`: товар подходит, если у него есть значение с `value IN (выбранные)` в группе с
этим slug. Внутри группы значения объединяются через ИЛИ, между группами — через И. Значения
в query остались прежними («Сухая», «3»), потому что Blade-фильтры не менялись; числа
приводятся к строке (`strval`), так как `value` — string. Значения уникальны внутри группы,
поэтому однозначности это не мешает.

Связи моделей: `PropertyGroup::properties()` (HasMany, по `sort`), `Property::group()`
(BelongsTo), `Property::products()` и `Product::properties()` (BelongsToMany с
`withPivot('group_id', 'is_multiple')` и `withTimestamps()`).

Группы в данных (см. `PropertySeeder`), slug → название: `processing-method` Способ обжарки,
`acidity` Кислинка, `specials` Особые (`is_multiple`), `coffee-type` Вид кофе, `rating`
Рейтинг, `roast-level` Степень обжарки, `acidity-level` Кислинка число, `bitterness`
Горчинка, `body` Насыщенность. Названия «Кислинка» (Низкая/Средняя/Высокая) и «Кислинка
число» (1–10) пока дублируют друг друга по смыслу — оставлены как есть, к ним можно
вернуться при доработке фильтров. «Рейтинг» тоже временная характеристика: в перспективе он
должен считаться из отзывов.

## `product_images`

Схема есть (`product_id`, `image_path` NOT NULL, `alt_text` nullable): строка с картинкой без пути не имеет смысла, связь `ProductImage::product()` и
`Product::productsImages()` объявлены — но нигде в коде (сидеры, контроллеры, Blade) эта
таблица пока не используется. Карточки товаров сейчас показывают статичную SVG-иконку
вместо реального изображения.
