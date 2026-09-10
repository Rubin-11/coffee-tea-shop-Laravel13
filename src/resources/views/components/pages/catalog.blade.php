{{-- Каталог категории (статичный демо-шаблон) --}}
@extends('layouts.main-layout')

@section('title', 'Каталог — свежеобжаренный кофе')

@section('content')
    @include('components.breadcrumbs')

    <div class="wrap pb-16">
        <h1 class="text-[34px] font-extrabold text-ink sm:text-[42px]">Свежеобжаренный кофе</h1>
        <p class="mt-3 max-w-2xl text-body">Кофе из разных стран произрастания, обжаренный в Калининграде. Выберите сорт под свой вкус.</p>

        <div class="mt-8 grid gap-8 lg:grid-cols-[280px_1fr]">
            {{-- ===== Фильтры ===== --}}
            <aside class="space-y-6">
                <div class="rounded-card border border-line bg-white p-6 shadow-card">
                    <div class="mb-4 flex items-center justify-between">
                        <span class="text-lg font-bold text-ink">Фильтры</span>
                        <a href="#" class="text-sm text-muted transition-colors hover:text-accent">Сбросить</a>
                    </div>

                    <div class="space-y-2">
                        <div class="text-sm font-bold uppercase tracking-wide text-muted">Категории</div>
                        <label class="flex items-center gap-2 text-body"><input type="radio" name="cat" class="accent-accent" checked> Свежеобжаренный кофе</label>
                        <label class="flex items-center gap-2 text-body"><input type="radio" name="cat" class="accent-accent"> Чай и кофейные напитки</label>
                        <label class="flex items-center gap-2 text-body"><input type="radio" name="cat" class="accent-accent"> Продукция для вендинга</label>
                        <label class="flex items-center gap-2 text-body"><input type="radio" name="cat" class="accent-accent"> Здоровое питание</label>
                    </div>

                    <hr class="my-5 border-line">

                    <div class="space-y-2">
                        <div class="text-sm font-bold uppercase tracking-wide text-muted">Цена, ₽</div>
                        <div class="flex items-center gap-2">
                            <input type="number" placeholder="от" class="field py-2.5">
                            <span class="text-muted">—</span>
                            <input type="number" placeholder="до" class="field py-2.5">
                        </div>
                    </div>

                    <hr class="my-5 border-line">

                    <div class="space-y-2">
                        <div class="text-sm font-bold uppercase tracking-wide text-muted">Обжарка</div>
                        <label class="flex items-center gap-2 text-body"><input type="checkbox" class="rounded accent-accent"> Светлая</label>
                        <label class="flex items-center gap-2 text-body"><input type="checkbox" class="rounded accent-accent"> Средняя</label>
                        <label class="flex items-center gap-2 text-body"><input type="checkbox" class="rounded accent-accent"> Тёмная</label>
                    </div>

                    <button type="button" class="btn-accent mt-6 w-full">Применить</button>
                </div>
            </aside>

            {{-- ===== Сетка товаров ===== --}}
            <div>
                <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
                    <span class="text-sm text-muted">Найдено 48 товаров</span>
                    <label class="flex items-center gap-2 text-sm text-body">
                        Сортировка:
                        <select class="field py-2.5 pr-8">
                            <option>По популярности</option>
                            <option>Сначала дешёвые</option>
                            <option>Сначала дорогие</option>
                            <option>По рейтингу</option>
                        </select>
                    </label>
                </div>

                <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                    @include('components.product-card')
                    @include('components.product-card')
                    @include('components.product-card')
                    @include('components.product-card')
                    @include('components.product-card')
                    @include('components.product-card')
                </div>

                @include('components.pagination')
            </div>
        </div>
    </div>
@endsection
