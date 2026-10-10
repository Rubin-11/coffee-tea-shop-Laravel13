# Страница каталога

Маршрут: `routes/web.php` → `Route::get('/catalog/{slug}', [CatalogController::class, 'index'])->name('catalog')`
Контроллер: `app/Http/Controllers/CatalogController.php`
View: `resources/views/components/pages/catalog.blade.php`

## Что делает `CatalogController::index(Request $request, string $slug)`

1. Находит категорию по `slug` (`firstOrFail()` — чужого/несуществующего slug даёт 404,
   не падение с ошибкой 500).
2. Берёт её прямых детей (`childCategories`) — нужны, чтобы в выдачу попали товары не
   только самой категории, но и всех её подкатегорий (см.
   [../database/categories.md](../database/categories.md) про то, что `Category::products()`
   без этого вернул бы только товары напрямую в этой категории).
3. Отдельно берёт **все категории верхнего уровня** (`$categories`) — это не то же самое,
   что `$childCategories`: используется не для товаров, а для переключателя категорий над
   заголовком (см. ниже).
4. Запрос товаров: `Product::with('category')->whereIn('category_id', [все дочерние id + id самой категории])`,
   дальше цепочка `->when(...)` на каждый возможный фильтр из query string (см. ниже),
   `->paginate(6)->appends($request->query())`.

`->appends($request->query())` дописывает текущие query-параметры (фильтры) к ссылкам
пагинации — без этого переход на страницу 2 сбрасывал бы выбранные фильтры. Подробнее про
`$paginator`/`$elements` — в [pagination.md](pagination.md).

### Как читаются фильтры

Каждый фильтр — отдельный `->when($request->filled('param'), fn ($query) => ...)`:
`when()` добавляет условие в запрос только если параметр реально пришёл и не пустой
(`filled()`, а не `has()` — пустая строка `price_min=` не должна превращаться в
`where('price', '>=', '')`).

- `price_min`/`price_max` — обычный `where('price', '>=' / '<=', ...)`.
- `processing`, `acidity`, `coffee_type` — категориальные свойства, ищутся через
  `whereHas('properties', fn ($p) => $p->where('name', '<имя группы в БД>')->whereIn('value', $request->...))`.
- `roast_level`, `body`, `bitterness` — числовые шкалы, та же схема, но по `value_int` и
  `whereIn('value_int', ...)`.
- `subcategory` — id'шники подкатегорий (чекбоксы в сайдбаре для некофейных категорий, см.
  ниже), обычный `whereIn('category_id', array_map('intval', $request->subcategory))`. Это
  условие добавляется к уже наложенному в начале запроса `whereIn('category_id', [все дети +
  сама категория])`, то есть сужает его, а не заменяет — выбрать подкатегорию, которая не
  входит в текущую открытую категорию, через URL нельзя.

`whereHas('properties', ...)` — товар попадает в выдачу, если среди *его* строк в пивоте
`product_properties` есть хотя бы одна, подходящая под условие внутри closure (имя группы +
значение из списка выбранных в чекбоксах). Про сам `properties()`/`product_properties` — см.
[../database/products-and-properties.md](../database/products-and-properties.md).

Имена query-параметров (`processing`, `roast_level`, ...) — это просто имена полей формы,
они не обязаны совпадать со значением колонки `properties.name` в БД: сама привязка
query-параметр → группа БД делается внутри closure (`->where('name', 'Способ обжарки')` и
т.д.), один раз в контроллере.

## View: структура `catalog.blade.php`

### Переключатель категорий (над заголовком)
```blade
@foreach($categories as $mainCategory)
    @include('components.category-card', ['category' => $mainCategory])
@endforeach
```
Тот же компонент `category-card`, что и на главной странице — одна и та же карточка-ссылка
`<a href="/catalog/{slug}">` переиспользуется в обоих местах.

Переменная цикла называется `$mainCategory`, а не `$category` — специально, чтобы не
затереть переменную `$category` (текущая открытая категория), которая используется чуть
ниже в `<h1>{{ $category->name }}</h1>` и далее в блоке фильтров. После `@foreach` в Blade
(как и в обычном PHP `foreach`) переменная цикла остаётся равна своему последнему значению
— назови её `$category`, и заголовок страницы показывал бы последнюю категорию из списка
верхнего уровня, а не ту, что реально открыта.

### Фильтры (сайдбар) — работают для всех категорий: свойства для кофе, подкатегории для остальных
Вся разметка фильтров (кроме переключателя подкатегорий в `@else`) обёрнута в
`<form method="GET">`. GET-форма отправляет данные как query string на тот же URL (путь
`/catalog/{slug}` не меняется — он часть пути, а не формы), поэтому отдельный `action` не
нужен.

- Цена (от/до) — `<input type="number" name="price_min">` / `name="price_max"`, значение
  восстанавливается через `value="{{ request('price_min') }}"` после отправки формы.
- Для категории кофе (`@if($category->slug === 'svezheobzharennyy-kofe')`) — чекбоксы/чипы
  по реальным характеристикам из `properties` (способ обжарки, степень обжарки, кислинка,
  вид кофе, насыщенность, горчинка), с `name="...[]"` (массив — можно выбрать несколько
  значений одной группы). Состояние после отправки восстанавливается директивой
  `@checked(in_array(..., (array) request('...', [])))`.
- Для остальных категорий (`@else`) — чекбоксы по `$childCategories` (подкатегориям
  открытой категории), `name="subcategory[]"` / `value="{{ $childCategory->id }}"`, состояние
  восстанавливается так же через `@checked(in_array($childCategory->id, (array) request('subcategory', [])))`.
  Свойства (`processing`, `roast_level` и т.д.) для этих категорий не показываются и не
  годятся: `product_properties` заполнен только для кофе (см.
  [seeders.md](seeders.md#productpropertyseeder)), поэтому единственный осмысленный фильтр
  здесь — по подкатегории, а не по характеристикам.
- «Сбросить» — обычная ссылка на `route('catalog', $category->slug)` без query string, то
  есть просто чистый URL категории (это не кнопка формы, а отдельная `<a>`).

Как эти характеристики попадают в БД для кофе — см.
[seeders.md](seeders.md#productpropertyseeder). Как контроллер читает эти параметры — см.
выше, "Как читаются фильтры".

Несоответствие имени группы «Способ обработки» (в вёрстке) ↔ «Способ обжарки» (в БД),
которое раньше было здесь отмечено, устранено — подпись в фильтре переименована в «Способ
обжарки», совпадает с `Property.name` в БД.

### Сетка товаров и пагинация
```blade
@foreach($products as $product)
    @include('components.product-card', ['product' => $product])
@endforeach
{{ $products->links('components.pagination') }}
```
Как устроен `components/pagination.blade.php` — см. [pagination.md](pagination.md).
