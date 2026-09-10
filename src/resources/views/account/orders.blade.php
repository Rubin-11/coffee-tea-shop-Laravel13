{{-- Личный кабинет: список заказов (статичный демо-шаблон) --}}
@extends('layouts.main-layout')

@section('title', 'Мои заказы')

@section('content')
    <div class="wrap py-10">
        <h1 class="text-[34px] font-extrabold text-ink sm:text-[42px]">Мои заказы</h1>

        <div class="mt-8 grid gap-8 lg:grid-cols-[260px_1fr]">
            @include('components.account-nav')

            <div class="space-y-6">
                {{-- Фильтр по статусу --}}
                <div class="flex flex-wrap gap-2">
                    <a href="#" class="rounded-full bg-accent px-4 py-2 text-sm font-semibold text-white">Все</a>
                    <a href="#" class="rounded-full border border-line px-4 py-2 text-sm font-medium text-body transition-colors hover:border-accent hover:text-accent">Активные</a>
                    <a href="#" class="rounded-full border border-line px-4 py-2 text-sm font-medium text-body transition-colors hover:border-accent hover:text-accent">Завершённые</a>
                    <a href="#" class="rounded-full border border-line px-4 py-2 text-sm font-medium text-body transition-colors hover:border-accent hover:text-accent">Отменённые</a>
                </div>

                {{-- Заказ 1 --}}
                <article class="rounded-card border border-line bg-white p-6 shadow-card">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <div class="font-bold text-ink">Заказ № 10245</div>
                        <span class="rounded-full bg-accent-soft px-3 py-1 text-xs font-bold text-accent-dark">В обработке</span>
                    </div>
                    <p class="mt-1 text-sm text-muted">от 10.09.2026 · 2 товара · 4 720 ₽</p>
                    <div class="mt-4 flex flex-wrap gap-3">
                        <a href="/account/orders/10245" class="btn-outline px-5 py-2.5 text-sm">Детали</a>
                        <button type="button" class="btn-dark px-5 py-2.5 text-sm">Повторить заказ</button>
                    </div>
                </article>

                {{-- Заказ 2 --}}
                <article class="rounded-card border border-line bg-white p-6 shadow-card">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <div class="font-bold text-ink">Заказ № 10188</div>
                        <span class="rounded-full bg-soft px-3 py-1 text-xs font-bold text-body">Завершён</span>
                    </div>
                    <p class="mt-1 text-sm text-muted">от 22.08.2026 · 1 товар · 1 020 ₽</p>
                    <div class="mt-4 flex flex-wrap gap-3">
                        <a href="/account/orders/10188" class="btn-outline px-5 py-2.5 text-sm">Детали</a>
                        <button type="button" class="btn-dark px-5 py-2.5 text-sm">Повторить заказ</button>
                    </div>
                </article>
            </div>
        </div>
    </div>
@endsection
