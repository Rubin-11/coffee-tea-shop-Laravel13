# Пагинация

Файл: `resources/views/components/pagination.blade.php`
Вызывается из [catalog-page.md](catalog-page.md) как `{{ $products->links('components.pagination') }}`.

## Откуда берутся переменные во view

`LengthAwarePaginator::links($view)` (вызывается на результате `paginate()`) рендерит
указанный view и передаёт в него ровно две переменные — это поведение самого Laravel
(`vendor/laravel/framework/.../LengthAwarePaginator.php`), не что-то специфичное для этого
проекта:
- `$paginator` — сам объект пагинации: `onFirstPage()`, `hasMorePages()`,
  `previousPageUrl()`, `nextPageUrl()`, `currentPage()`, `hasPages()`.
- `$elements` — уже собранный массив "кусков" для вывода номеров страниц.

## Структура `$elements`

Верхний уровень — список кусков, каждый кусок это либо:
1. строка `'...'` — многоточие между далёкими блоками страниц, либо
2. массив вида `[номер_страницы => ссылка]` — подряд идущие страницы.

Поэтому в шаблоне два вложенных `@foreach`: внешний отличает многоточие от блока страниц
(`is_string($element)`), внутренний — перебирает сами страницы в блоке. Текущая страница
(`$page == $paginator->currentPage()`) рисуется как `<span>` (не кликабельна), остальные —
как `<a href="{{ $url }}">`.

Кнопки «Назад»/«Вперёд» — по `onFirstPage()`/`hasMorePages()`: на границах рисуется
неактивный `<span>` вместо `<a>`, чтобы не было ссылки в никуда.

## На что обратить внимание при доработке

- Фильтры каталога (см. [catalog-page.md](catalog-page.md)) отправляют query-параметры, и
  `CatalogController` цепляет `->appends($request->query())` к результату `paginate()` —
  поэтому переход на страницу 2 не сбрасывает выбранные фильтры: `$paginator->appends(...)`
  добавляет эти же параметры во все ссылки `previousPageUrl()`/`nextPageUrl()`/`$elements`.
- В `resources/views/components/pagination/` лежит файл `tailwind.blade.php` — это
  неиспользуемый черновик (view вызывается по пути `'components.pagination'`, что резолвится
  в `pagination.blade.php`, а не в `pagination/tailwind.blade.php`). Он не подключён нигде в
  проекте.
