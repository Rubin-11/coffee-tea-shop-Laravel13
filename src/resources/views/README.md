# Шаблоны магазина (Blade + Tailwind v4)

Каркас (шаблон) всех страниц магазина: только разметка и стили.
**Никакой логики, циклов и переменных** — данные подставляются позже из БД.

## Как это устроено

- Стили — Tailwind v4. Дизайн-токены объявлены в `src/resources/css/app.css` в блоке `@theme`
  (акцент `#F9B300`, цвета `ink/body/muted/soft/line/accent-soft`, радиусы `card/btn`, тени).
  Из них автоматически генерируются утилиты: `bg-accent`, `text-ink`, `rounded-card`, `shadow-card` и т.п.
- Общий каркас страницы — `layouts/main-layout.blade.php` (подключает `app.css`, шрифт Onest, шапку и подвал).
- Страницы подключают каркас: `@extends('layouts.main-layout')` + `@section('content') … @endsection`.
- Данные захардкожены (демо), чтобы шаблон сразу отображался без БД.

## Структура

```
views/
├── layouts/main-layout.blade.php   — общий каркас (head, vite, header, footer)
├── components/
│   ├── header.blade.php            — шапка (лого, меню, поиск, ЛК, корзина, мобильное меню)
│   ├── footer.blade.php            — подвал (+ блок подписки)
│   ├── breadcrumbs.blade.php       — хлебные крошки
│   ├── product-card.blade.php      — карточка товара
│   ├── category-card.blade.php     — карточка категории
│   ├── pagination.blade.php        — пагинация
│   ├── account-nav.blade.php       — боковое меню личного кабинета
│   └── pages/catalog.blade.php     — каталог категории
├── home.blade.php                  — главная
├── product.blade.php               — карточка товара
├── cart.blade.php                  — корзина
├── checkout.blade.php              — оформление заказа
├── checkout-success.blade.php      — заказ оформлен
├── account/                        — ЛК: index, edit, orders, order
├── blog/                           — блог: index, show
├── pages/                          — about, contacts, delivery, returns, privacy, terms
├── auth/                           — login, register, forgot-password, reset-password
└── errors/                         — 404, 500
```

## Как посмотреть

1. `npm run dev` (или `npm run build`) — собрать CSS.
2. Временно добавить маршруты для предпросмотра, например в `routes/web.php`:
   ```php
   Route::view('/tpl/home', 'home');
   Route::view('/tpl/product', 'product');
   // и т.д.
   ```
   (потом удалить — это чисто для просмотра вёрстки)
3. Открыть страницы в браузере.

## Как подключать данные

Шаблоны статичны. Когда будете выводить из БД:
- повторяющиеся блоки (карточки товаров, отзывы, заказы, статьи) обернуть в `@foreach`,
  заменив демо-текст на переменные (`{{ $product->name }}` и т.д.);
- повторяющиеся карточки удобно вынести в Blade-компонент (`@props(['product'])`);
- ссылки-заглушки (`href="/..."`) заменить на `route(...)`.

## Состояния, которые уже заложены

- Пустая корзина — в `cart.blade.php` (блок «В корзине пока пусто», по умолчанию скрыт).
- Активная/завершённая вкладка — во вкладках товара и фильтрах заказов.
- Мобильное меню — на CSS (checkbox + peer), без JS.
