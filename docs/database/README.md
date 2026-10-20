# Схема БД — обзор

Таблицы приложения (без служебных `cache`/`jobs`/`sessions` от Laravel) и связи между ними.

| Таблица | Назначение | Подробнее |
|---|---|---|
| `categories` | Дерево категорий каталога | [categories.md](categories.md) |
| `products` | Товары | [products-and-properties.md](products-and-properties.md) |
| `properties` / `product_properties` | Характеристики товаров (обжарка, кислинка и т.д.) и их привязка к товарам | [products-and-properties.md](products-and-properties.md) |
| `product_images` | Изображения товара (схема есть, в коде пока не используется) | [products-and-properties.md](products-and-properties.md) |
| `users` / `user_addresses` | Пользователи и их адреса | [users-baskets-orders.md](users-baskets-orders.md) |
| `baskets` | Корзина авторизованных пользователей (гостевая — в сессии) | [users-baskets-orders.md](users-baskets-orders.md) |
| `orders` / `orders_products` | Заказы и состав заказа | [users-baskets-orders.md](users-baskets-orders.md) |

## Связи между таблицами (сводно)

```
categories.parent_id → categories.id        (self-join, дерево категорий)
products.category_id → categories.id       (restrictOnDelete; products мягко удаляются через deleted_at)
product_images.product_id → products.id
product_properties: products ↔ properties   (многие-ко-многим)
baskets.user_id → users.id (NOT NULL)          корзина только авторизованных; гость — в сессии
baskets.product_id → products.id
user_addresses.user_id → users.id
orders.user_id → users.id (nullable, nullOnDelete: заказ переживает удаление пользователя)
orders_products: orders ↔ products           (многие-ко-многим, со снапшотом цены/количества)
```

Откуда реально берутся данные для этих таблиц (сидеры, порядок запуска, нюансы заполнения
pivot-таблиц) — см. [features/seeders.md](../features/seeders.md).
