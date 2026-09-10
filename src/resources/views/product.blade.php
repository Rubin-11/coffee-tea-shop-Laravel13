{{-- Карточка товара (статичный демо-шаблон) --}}
@extends('layouts.main-layout')

@section('title', 'Colombia Supremo — купить свежеобжаренный кофе')

@section('content')
    @include('components.breadcrumbs')

    <div class="wrap pb-16">
        <div class="grid gap-10 lg:grid-cols-2">
            {{-- ===== Галерея ===== --}}
            <div>
                <div class="grid aspect-square place-items-center rounded-card border border-line bg-soft text-[#cfcfcf]">
                    <svg class="h-24 w-24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="18" height="18" rx="3"></rect><circle cx="9" cy="9" r="2"></circle><path d="m21 15-5-5L5 21"></path>
                    </svg>
                </div>
                <div class="mt-4 grid grid-cols-4 gap-4">
                    <span class="grid aspect-square place-items-center rounded-btn border-2 border-accent bg-soft text-[#cfcfcf]">
                        <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="3"></rect></svg>
                    </span>
                    <span class="grid aspect-square place-items-center rounded-btn border border-line bg-soft text-[#cfcfcf]">
                        <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="3"></rect></svg>
                    </span>
                    <span class="grid aspect-square place-items-center rounded-btn border border-line bg-soft text-[#cfcfcf]">
                        <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="3"></rect></svg>
                    </span>
                    <span class="grid aspect-square place-items-center rounded-btn border border-line bg-soft text-[#cfcfcf]">
                        <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="3"></rect></svg>
                    </span>
                </div>
            </div>

            {{-- ===== Информация ===== --}}
            <div>
                <h1 class="text-[32px] font-extrabold text-ink sm:text-[38px]">Colombia Supremo</h1>

                <div class="mt-3 flex items-center gap-2 text-sm">
                    <span class="text-accent" aria-hidden="true">★★★★☆</span>
                    <span class="font-semibold text-ink">4.0</span>
                    <a href="#reviews" class="text-muted transition-colors hover:text-accent">(32 отзыва)</a>
                </div>

                <p class="mt-5 text-body">
                    Плотный кофе с нотами тёмного шоколада, орехов и карамели. Средняя обжарка, идеален для эспрессо и гейзерной кофеварки.
                </p>

                <div class="mt-6 flex items-baseline gap-3">
                    <span class="text-sm text-muted line-through">1 200 ₽</span>
                    <span class="text-[34px] font-extrabold text-ink">1 020 ₽</span>
                    <span class="rounded-full bg-accent px-3 py-1 text-xs font-bold text-white">−15%</span>
                </div>

                {{-- Вес --}}
                <div class="mt-6">
                    <div class="mb-2 text-sm font-bold uppercase tracking-wide text-muted">Вес</div>
                    <div class="flex flex-wrap gap-3">
                        <label class="cursor-pointer rounded-btn border border-accent bg-accent-soft px-5 py-3 text-sm font-semibold text-ink">
                            <input type="radio" name="weight" class="sr-only" checked> 250 г
                        </label>
                        <label class="cursor-pointer rounded-btn border border-line px-5 py-3 text-sm font-semibold text-body">
                            <input type="radio" name="weight" class="sr-only"> 1000 г
                        </label>
                    </div>
                </div>

                {{-- Количество + покупка --}}
                <div class="mt-6 flex flex-wrap items-center gap-3">
                    <div class="flex items-center rounded-btn border border-line">
                        <button type="button" class="px-4 py-3 text-lg text-muted hover:text-ink">−</button>
                        <span class="w-10 text-center font-semibold text-ink">1</span>
                        <button type="button" class="px-4 py-3 text-lg text-muted hover:text-ink">+</button>
                    </div>
                    <button type="button" class="btn-accent flex-1 px-8 py-4 text-base">В корзину</button>
                </div>

                <button type="button" class="btn-outline mt-3 w-full py-3.5">Купить в 1 клик</button>

                {{-- Характеристики --}}
                <dl class="mt-8 divide-y divide-line rounded-card border border-line bg-white shadow-card">
                    <div class="flex items-center justify-between gap-4 px-5 py-3.5 text-sm"><dt class="text-muted">Страна произрастания</dt><dd class="font-semibold text-ink">Колумбия</dd></div>
                    <div class="flex items-center justify-between gap-4 px-5 py-3.5 text-sm"><dt class="text-muted">Обжарка</dt><dd class="font-semibold text-ink">Средняя</dd></div>
                    <div class="flex items-center justify-between gap-4 px-5 py-3.5 text-sm"><dt class="text-muted">Обработка</dt><dd class="font-semibold text-ink">Мытая</dd></div>
                    <div class="flex items-center justify-between gap-4 px-5 py-3.5 text-sm"><dt class="text-muted">Кислинка</dt><dd class="font-semibold text-ink">3 / 5</dd></div>
                    <div class="flex items-center justify-between gap-4 px-5 py-3.5 text-sm"><dt class="text-muted">Горчинка</dt><dd class="font-semibold text-ink">4 / 5</dd></div>
                </dl>
            </div>
        </div>

        {{-- ===== Вкладки ===== --}}
        <div class="mt-14">
            <div class="flex flex-wrap gap-2 border-b border-line">
                <button type="button" class="-mb-px border-b-2 border-accent px-5 py-3 text-sm font-bold text-ink">Описание</button>
                <button type="button" class="-mb-px border-b-2 border-transparent px-5 py-3 text-sm font-semibold text-muted hover:text-ink">Характеристики</button>
                <button type="button" class="-mb-px border-b-2 border-transparent px-5 py-3 text-sm font-semibold text-muted hover:text-ink">Отзывы (32)</button>
            </div>
            <div class="pt-6 text-body">
                <p>Colombia Supremo — классика колумбийского кофе. Зёрна выращиваются в высокогорных районах на высоте 1500–1900 м, что придаёт напитку насыщенное тело и сбалансированный вкус.</p>
                <p class="mt-4">Отлично подходит для эспрессо, а также для гейзера и френч-пресса. Рекомендуем заваривать при 92–94 °C.</p>
            </div>
        </div>

        {{-- ===== Отзывы ===== --}}
        <div class="mt-14" id="reviews">
            <h2 class="section-title">Отзывы покупателей</h2>
            <div class="mt-6 space-y-4">
                <article class="rounded-card border border-line bg-white p-6 shadow-card">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <div class="font-bold text-ink">Алексей М.</div>
                            <div class="text-sm text-muted">12.08.2026</div>
                        </div>
                        <span class="text-accent" aria-hidden="true">★★★★★</span>
                    </div>
                    <p class="mt-3 text-body">Отличный кофе, насыщенный вкус с шоколадными нотками. Заказываю уже третий раз — стабильно качественно.</p>
                </article>
                <article class="rounded-card border border-line bg-white p-6 shadow-card">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <div class="font-bold text-ink">Мария К.</div>
                            <div class="text-sm text-muted">03.08.2026</div>
                        </div>
                        <span class="text-accent" aria-hidden="true">★★★★☆</span>
                    </div>
                    <p class="mt-3 text-body">Очень свежая обжарка, аромат потрясающий. Для эспрессо немного крепковат, но для воронки — идеально.</p>
                </article>
            </div>
        </div>

        {{-- ===== Похожие ===== --}}
        <div class="mt-14">
            <h2 class="section-title">Похожие товары</h2>
            <div class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @include('components.product-card')
                @include('components.product-card')
                @include('components.product-card')
                @include('components.product-card')
            </div>
        </div>
    </div>
@endsection
