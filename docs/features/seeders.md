# Сидеры (тестовые данные)

`database/seeders/DatabaseSeeder.php` — порядок запуска важен, часть сидеров зависит от
того, что предыдущие уже создали записи в БД:

```
CategorySeeder → UserSeeder → ProductSeeder → PropertySeeder → ProductPropertySeeder → UserAddressSeeder
```

| Сидер | Что делает |
|---|---|
| `CategorySeeder` | 4 категории верхнего уровня + их подкатегории. Подробнее: [../database/categories.md](../database/categories.md) |
| `UserSeeder` | Тестовые пользователи |
| `ProductSeeder` | ~90 товаров (кофе/чай/вендинг/здоровое питание), привязанные к категориям по `slug` |
| `PropertySeeder` | Справочник характеристик: группы (`property_groups`) и их значения (`properties`). Подробнее: [../database/products-and-properties.md](../database/products-and-properties.md) |
| `ProductPropertySeeder` | Привязка характеристик к товарам кофе (пивот `product_properties`) — см. ниже |
| `UserAddressSeeder` | Тестовые адреса пользователей |

## `ProductPropertySeeder`

Отдельный шаг **после** `ProductSeeder` и `PropertySeeder` (а не внутри одного из них) —
так не нужно было менять их взаимный порядок: привязка просто берёт уже существующие
строки `products` и `properties` и связывает их.

Ключевые решения:
- **Только товары категории кофе.** `coffeeCategoryIds()` находит категорию
  `svezheobzharennyy-kofe` и всех её детей — характеристики вроде "способ обжарки"
  осмысленны только для кофе, остальным категориям (чай, вендинг, здоровое питание) они не
  присваиваются.
- **`PropertyGroup::with('properties')->get()->keyBy('slug')`** — группы вместе со значениями
  двумя запросами вместо запроса на каждый товар; дальше `$groups['roast-level']->properties->random()->id`.
- **Одно значение на одиночную группу, 0–3 на `specials`.** Восемь одиночных групп — ровно один
  случайный `id` на товар. Для `specials` (бейджи «Популярное»/«Скидки», `is_multiple = true`) —
  `rand(0, 3)` случайных тегов, может быть и 0. Теперь это не только соглашение сидера: для
  одиночных групп вторую строку отклонит частичный уникальный индекс в БД (см.
  [../database/products-and-properties.md](../database/products-and-properties.md)).
- **`syncProperties()`, не `attach()`.** Метод модели вызывает `sync()` и заполняет `group_id` /
  `is_multiple` в пивоте. Повторный запуск `db:seed` не приведёт к дублям — набор связей
  товара каждый раз переустанавливается с нуля.
