{{-- Корзина (статичный демо-шаблон) --}}
@extends('layouts.main-layout')

@section('title', 'Корзина')

@section('content')
    @include('components.breadcrumbs')

    <div class="wrap pb-16">
        <h1 class="text-[34px] font-extrabold text-ink sm:text-[42px]">Корзина</h1>

        <div class="mt-8 grid gap-8 lg:grid-cols-[1fr_360px]">
            {{-- ===== Позиции ===== --}}
            <div class="space-y-4">
                {{-- Позиция 1 --}}
                <div class="flex flex-col gap-4 rounded-card border border-line bg-white p-5 shadow-card sm:flex-row sm:items-center">
                    <span class="grid h-24 w-24 shrink-0 place-items-center rounded-btn bg-soft text-[#cfcfcf]">
                        <svg class="h-10 w-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="3"></rect><circle cx="9" cy="9" r="2"></circle><path d="m21 15-5-5L5 21"></path></svg>
                    </span>
                    <div class="flex-1">
                        <h3 class="font-bold text-ink">Colombia Supremo</h3>
                        <p class="text-sm text-muted">Вес: 250 г · Обжарка: средняя</p>
                    </div>
                    <div class="flex items-center rounded-btn border border-line">
                        <button type="button" class="px-3 py-2 text-muted hover:text-ink">−</button>
                        <span class="w-9 text-center font-semibold text-ink">1</span>
                        <button type="button" class="px-3 py-2 text-muted hover:text-ink">+</button>
                    </div>
                    <div class="w-28 text-right text-lg font-extrabold text-ink">1 020 ₽</div>
                    <button type="button" aria-label="Удалить" class="text-muted transition-colors hover:text-red-500">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18M8 6V4h8v2m-9 0 1 14h8l1-14"></path></svg>
                    </button>
                </div>

                {{-- Позиция 2 --}}
                <div class="flex flex-col gap-4 rounded-card border border-line bg-white p-5 shadow-card sm:flex-row sm:items-center">
                    <span class="grid h-24 w-24 shrink-0 place-items-center rounded-btn bg-soft text-[#cfcfcf]">
                        <svg class="h-10 w-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="3"></rect><circle cx="9" cy="9" r="2"></circle><path d="m21 15-5-5L5 21"></path></svg>
                    </span>
                    <div class="flex-1">
                        <h3 class="font-bold text-ink">Ethiopia Yirgacheffe</h3>
                        <p class="text-sm text-muted">Вес: 1000 г · Обжарка: светлая</p>
                    </div>
                    <div class="flex items-center rounded-btn border border-line">
                        <button type="button" class="px-3 py-2 text-muted hover:text-ink">−</button>
                        <span class="w-9 text-center font-semibold text-ink">2</span>
                        <button type="button" class="px-3 py-2 text-muted hover:text-ink">+</button>
                    </div>
                    <div class="w-28 text-right text-lg font-extrabold text-ink">3 400 ₽</div>
                    <button type="button" aria-label="Удалить" class="text-muted transition-colors hover:text-red-500">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18M8 6V4h8v2m-9 0 1 14h8l1-14"></path></svg>
                    </button>
                </div>
            </div>

            {{-- ===== Итого ===== --}}
            <aside class="lg:sticky lg:top-24 lg:self-start">
                <div class="rounded-card border border-line bg-white p-6 shadow-card">
                    <h2 class="text-xl font-bold text-ink">Итого</h2>
                    <dl class="mt-5 space-y-3 text-sm">
                        <div class="flex justify-between"><dt class="text-muted">Товары (3)</dt><dd class="font-semibold text-ink">4 420 ₽</dd></div>
                        <div class="flex justify-between"><dt class="text-muted">Скидка</dt><dd class="font-semibold text-accent-dark">−240 ₽</dd></div>
                        <div class="flex justify-between"><dt class="text-muted">Доставка</dt><dd class="font-semibold text-ink">300 ₽</dd></div>
                    </dl>

                    <div class="mt-5 flex items-center gap-2">
                        <input type="text" placeholder="Промокод" class="field flex-1 py-2.5">
                        <button type="button" class="btn-dark px-4 py-2.5 text-sm">ОК</button>
                    </div>

                    <div class="mt-5 flex items-baseline justify-between border-t border-line pt-5">
                        <span class="text-body">К оплате</span>
                        <span class="text-2xl font-extrabold text-ink">4 480 ₽</span>
                    </div>

                    <a href="/checkout" class="btn-accent mt-5 w-full py-4">Оформить заказ</a>
                    <a href="/catalog" class="mt-3 block text-center text-sm font-semibold text-ink transition-colors hover:text-accent">Продолжить покупки</a>
                </div>
            </aside>
        </div>

        {{-- Пустая корзина (шаблон состояния) --}}
        <div class="mt-12 hidden rounded-card border border-dashed border-line bg-white p-12 text-center">
            <p class="text-lg font-bold text-ink">В корзине пока пусто</p>
            <p class="mt-2 text-body">Добавьте товары из каталога — они появятся здесь.</p>
            <a href="/catalog" class="btn-accent mt-6 px-8 py-3.5">Перейти в каталог</a>
        </div>
    </div>
@endsection
