# Пользователи, корзина, заказы

Статус: схема и Eloquent-связи готовы, но бизнес-логика (сессия гостя → корзина, оформление
заказа, админка заказов) ещё не реализована — это этапы 5–7 проекта (см. `CLAUDE.md`).
Этот файл — просто справка по уже существующей структуре БД.

## `users` (+ `user_addresses`)

`users` расширен под магазин кастомными полями: `first_name`, `last_name`, `is_admin`,
`is_active` (через `#[Fillable]`/`#[Hidden]` атрибуты модели вместо классических
`$fillable`/`$hidden`-свойств). `UserAddress` — `hasMany` от `User`, хранит адреса доставки
(страна/регион/город/улица/дом/квартира/телефон).

## `baskets` — гостевая и пользовательская корзина в одной таблице

```php
Sche[features](../features)ma::create('baskets', function (Blueprint $table) {
    $table->string('session_id')->nullable();
    $table->integer('quantity');
    $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
    $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
    $table->unique(['user_id', 'session_id', 'product_id'])->nullsNotDistinct();
});
```

Одна таблица обслуживает оба случая из финальной цели проекта («корзина для гостей —
сессия, для авторизованных — БД»):
- гость: `user_id = null`, `session_id = <id сессии>`
- авторизован: `user_id = <id>`, `session_id = null` (либо тоже заполнен — на момент
  написания это не зафиксировано логикой, так как сама логика добавления в корзину ещё не
  написана)

`nullsNotDistinct()` на уникальном индексе — важный нюанс: по умолчанию в Postgres `NULL`
не равен другому `NULL`, и `unique(a, b, c)` пропустил бы несколько строк с одинаковыми
`product_id`/`session_id`, если `user_id` везде `NULL` (гости). `nullsNotDistinct()`
заставляет Postgres считать `NULL = NULL` для этого индекса — так одна и та же
гостевая сессия не может добавить один и тот же товар в корзину второй отдельной строкой
(вместо этого при повторном добавлении пришлось бы обновлять `quantity` в существующей
строке, не вставлять новую).

Связи: `Basket::user()` / `Basket::product()`; `User::products()` и `Product::users()` —
обе `BelongsToMany` через `baskets` с `withPivot('session_id', 'quantity')`.

## `orders` / `orders_products`

`orders`: `user_id` (FK, cascade), `order_number` (unique), `price`, `payment_method`
(enum: `cash`/`card`), `address`, `status` (enum: `pending`/`processing`/`completed`/`cancelled`,
по умолчанию `pending`).

`orders_products` — пивот `orders` ↔ `products`, с `unique(['order_id', 'product_id'])` и
собственными `quantity`/`price` в пивоте — это **снапшот** цены товара на момент заказа, а
не ссылка на текущую цену в `products` (цена товара может потом измениться, в заказе должна
остаться та, что была при покупке).

Связи: `Order::user()`, `Order::products()` / `Product::orders()` (обе `BelongsToMany` через
`orders_products`, с `withPivot('quantity', 'price')`).
