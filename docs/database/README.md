# Схема БД — обзор

Таблицы приложения (без служебных `cache`/`jobs`/`sessions` от Laravel) и связи между ними.

| Таблица | Назначение | Подробнее |
|---|---|---|
| `categories` | Дерево категорий каталога | [categories.md](categories.md) |
| `products` | Товары | [products-and-properties.md](products-and-properties.md) |
| `property_groups` / `properties` / `product_properties` | Группы характеристик (обжарка, кислинка), их значения и привязка значений к товарам | [products-and-properties.md](products-and-properties.md) |
| `product_images` | Изображения товара (схема есть, в коде пока не используется) | [products-and-properties.md](products-and-properties.md) |
| `users` / `user_addresses` | Пользователи и их адреса | [users-baskets-orders.md](users-baskets-orders.md) |
| `reviews` | Отзывы авторизованных пользователей о товарах | [reviews.md](reviews.md) |
| `baskets` | Корзина авторизованных пользователей (гостевая — в сессии) | [users-baskets-orders.md](users-baskets-orders.md) |
| `orders` / `orders_products` | Заказы и состав заказа | [users-baskets-orders.md](users-baskets-orders.md) |

## Связи между таблицами (сводно)

```
categories.parent_id → categories.id        (self-join, дерево категорий)
products.category_id → categories.id       (restrictOnDelete; products мягко удаляются через deleted_at)
product_images.product_id → products.id
properties.group_id → property_groups.id
product_properties: products ↔ properties   (многие-ко-многим; group_id и is_multiple копируются в пивот,
                                             одиночная группа — одно значение на товар, см. products-and-properties.md)
baskets.user_id → users.id (NOT NULL)          корзина только авторизованных; гость — в сессии
baskets.product_id → products.id
user_addresses.user_id → users.id
reviews.user_id → users.id, reviews.product_id → products.id   (один отзыв на пару пользователь/товар)
orders.user_id → users.id (nullable, nullOnDelete: заказ переживает удаление пользователя)
orders_products: orders ↔ products           (многие-ко-многим, со снапшотом цены/количества)
```

Откуда реально берутся данные для этих таблиц (сидеры, порядок запуска, нюансы заполнения
pivot-таблиц) — см. [features/seeders.md](../features/seeders.md).

## Индексы на внешних ключах

Postgres (в отличие от MySQL) **не создаёт индекс на столбце внешнего ключа сам**. Поэтому
для каждого FK, по которому ищут или удаляют, индекс заводится в миграции вручную. Составной
`unique(a, b)` обслуживает поиск по `a` (первый столбец), но не по `b`. Так добавлены
`index('product_id')` в `baskets` и `orders_products` и `index('property_id')` в
`product_properties` (2026-10-21, по ревью этапа 1); `reviews.product_id`,
`products.category_id`, `categories.parent_id`, `orders.user_id`, `user_addresses.user_id` и
`product_images.product_id` индекс имели с самого начала.
