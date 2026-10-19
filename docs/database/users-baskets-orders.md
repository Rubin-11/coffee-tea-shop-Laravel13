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

| Колонка | Тип | Примечание |
|---|---|---|
| `user_id` | nullable FK → `users.id`, `nullOnDelete` | `NULL` у гостевого заказа и у заказа удалённого пользователя |
| `order_number` | string, unique | |
| `price` | decimal(10,2) | итоговая сумма заказа |
| `payment_method` | enum `cash`/`card` | |
| `customer_name`, `customer_email`, `customer_phone` | string (телефон до 20 символов) | контакты покупателя на момент заказа |
| `country`, `region`, `city`, `street`, `house_number` | string | адрес доставки на момент заказа |
| `flat_number` | string, nullable | в частном доме квартиры нет |
| `status` | enum `pending`/`processing`/`completed`/`cancelled`, default `pending` | |

### Почему заказ хранит копию контактов и адреса (изменено 2026-10-19)

Раньше было `user_id ... onDelete('cascade')` и одна строка `address`. Удаление пользователя
стирало всю историю его заказов, а без пользователя в заказе не оставалось ни имени, ни
телефона: менеджеру некому позвонить.

Теперь заказ самодостаточен, по той же идее, что и снапшот цены в `orders_products`:
- `nullOnDelete()`: при удалении пользователя Postgres выставляет `user_id = NULL`
  (`ON DELETE SET NULL`), а сам заказ остаётся в отчётах;
- `nullable()` нужен для этого же поведения и заодно разрешает гостевые заказы на уровне
  БД. Можно ли гостю оформлять заказ, решит логика оформления (этап 7), схема это
  поддерживает;
- контакты и адрес копируются в заказ при оформлении. Если пользователь потом поменяет
  телефон или адрес в `user_addresses`, старые заказы останутся с теми данными, по которым
  их реально доставляли. У гостя строк в `user_addresses` нет, поэтому ссылка на адрес ему
  бы не подошла.
- адрес хранится по полям (как в `user_addresses`), а не одной строкой, чтобы его было
  легко скопировать из сохранённого адреса и фильтровать заказы, например, по городу.

В модели `Order` задан `#[Fillable]` со всеми этими полями, кроме `status`: при создании
заказ получает `pending` по умолчанию, а статус меняет только админка.

`orders_products` — пивот `orders` ↔ `products`, с `unique(['order_id', 'product_id'])` и
собственными `quantity`/`price` в пивоте — это **снапшот** цены товара на момент заказа, а
не ссылка на текущую цену в `products` (цена товара может потом измениться, в заказе должна
остаться та, что была при покупке).

Связи: `Order::user()`, `Order::products()` / `Product::orders()` (обе `BelongsToMany` через
`orders_products`, с `withPivot('quantity', 'price')`).
