# Автотесты

Фреймворк — [Pest 5](https://pestphp.com/) поверх PHPUnit. Тесты лежат в `src/tests/`,
добавлены 2026-10-21 в ветке `feature/tests`.

## Как запускать

```bash
docker compose exec php php artisan test                 # все тесты
docker compose exec php php artisan test tests/Feature/Catalog   # одна папка
docker compose exec php php artisan test --filter="фильтр"       # по названию
```

## Тестовая база

Тесты идут на **PostgreSQL**, а не на SQLite в памяти (это было значение по умолчанию в
`phpunit.xml`). Причина: миграции используют возможности Postgres, которых нет в SQLite, —
частичный уникальный индекс (`product_properties`), `nullsNotDistinct()` (`categories`),
`ALTER TABLE ... ADD CONSTRAINT CHECK` (`baskets`, `reviews`, `products`). И сами ограничения
БД — часть того, что мы проверяем, на SQLite это не имело бы смысла.

- БД `laravel_db_test` создаётся в том же контейнере `postgres`, что и рабочая
  `laravel_db`, владелец тот же. В `phpunit.xml` её имя, хост и драйвер заданы с
  `force="true"`: значения из `.env` не могут их перекрыть, поэтому тесты не
  способны случайно очистить рабочую БД.
- Новый том `postgres-data` получит тестовую БД сам: `docker/postgres/01-create-test-db.sql`
  смонтирован в `/docker-entrypoint-initdb.d` (Postgres выполняет такие скрипты только при
  создании пустого тома). На уже существующем томе скрипт не сработает, базу нужно создать
  один раз вручную: `docker compose exec postgres psql -U laravel_user -d laravel_db -c "CREATE DATABASE laravel_db_test OWNER laravel_user"`.
- `RefreshDatabase` (подключён в `tests/Pest.php` для `Feature` и `Unit`): схема создаётся
  один раз, каждый тест выполняется в транзакции, которая откатывается в конце.

## `tests/Pest.php` — общее для всех тестов

- `pest()->extend(TestCase::class)->use(RefreshDatabase::class)` — база и приложение в
  каждом тесте; `withoutVite()` — Blade-шаблоны содержат `@vite`, а собранного
  `public/build` в тестах нет.
- `propertyValue($groupSlug, $value, $multiple = false)` — значение характеристики в группе
  (группа создаётся при первом обращении).
- `productWith($category, [[группа, значение], ...], $attributes)` — товар в категории сразу
  с характеристиками, через `Product::syncProperties()`.
- `expectRejected(fn)` — «БД отклонила операцию». Внутри `RefreshDatabase` тест лежит в
  одной транзакции, а Postgres после первой же ошибки считает транзакцию сломанной и
  отказывает всем следующим запросам. Вложенный `DB::transaction()` создаёт savepoint и
  откатывает только его.

## Фабрики (`database/factories/`)

`Category` (`childOf($parent)`), `Product`, `PropertyGroup` (`multiple()`), `Property`,
`Review`, `Order` (`guest()`), плюс уже существовавшие `User`, `UserAddress`. Модели
подключают их через `HasFactory`. Связи (`category_id`, `user_id`, `group_id`...) фабрика
создаёт сама, если их не передать. Проверяются в `tests/Feature/FactoriesTest.php`.

## Что покрыто

| Файл | Что проверяет |
|---|---|
| `Feature/HomePageTest` | главная открывается, показывает только категории верхнего уровня |
| `Feature/Catalog/CatalogPageTest` | 200/404, товары категории и подкатегорий без чужих, «Найдено N», мягко удалённые скрыты, 6 на страницу, фильтры сохраняются в ссылках пагинации |
| `Feature/Catalog/CatalogFiltersTest` | цена (границы включительно), подкатегории, характеристики: ИЛИ внутри группы, И между группами, одинаковые значения в разных группах не путаются, пустые/неизвестные параметры, сочетание с ценой и мягким удалением |
| `Feature/Catalog/CatalogInvalidInputTest` | некорректные параметры фильтров (`price_min=abc`, `subcategory=1`, вложенный массив) не дают 500 |
| `Feature/Catalog/CatalogValidationTest` | редирект на категорию с оставленными корректными параметрами, сообщение об ошибке на странице, `price_max` < `price_min`, сброс всего массива при одном неверном элементе, 404 |
| `Feature/Database/ProductPropertiesTest` | `syncProperties()`, запрет второго значения одиночной группы, теги `is_multiple`, составные внешние ключи, каскады |
| `Feature/Database/ReviewsTest` | один отзыв на пару пользователь/товар, оценка 1–5, обязательный текст, счётчик `reviews_count`, каскады |
| `Feature/Database/BasketsTest` | количество (default 1, > 0), уникальность пары, владелец обязателен, очистка корзин при удалении товара |
| `Feature/Database/CatalogSchemaTest` | остаток и счётчик не меньше 0, `text`-описание, уникальность slug и имени категории (`parent_id`+`name`), `restrict` категории с товарами, `set null` у подкатегорий |
| `Feature/Database/OrdersTest` | enum'ы статуса и оплаты, уникальный номер, `user_id` → `NULL` при удалении пользователя, заказ и товар из заказа физически не удаляются, снапшот названия в позиции |

## Как убедиться, что тест вообще способен упасть

Тест, который ни при каких условиях не падает, бесполезен. После написания фильтров каталога
проверили вручную («мутационная проверка»): временно убрали из `CatalogController`
проверку группы `whereHas('group', ...)` — упал тест «не путает одинаковые значения из разных
групп»; заменили `<=` на `<` для `price_max` — упал тест границ цены; увеличили счётчик
отзывов на 2 — упали три теста; убрали очистку корзин в `Product::booted()` — упал тест корзин.
Код после проверок возвращался в исходное состояние.

## Чего пока нет

Корзины в сессии, авторизации, оформления заказа, админки и страницы товара в коде ещё
нет (этапы 5–7), тестов на них тоже. Когда эти части появятся, тесты добавляются сюда же и
в таблицу выше.
