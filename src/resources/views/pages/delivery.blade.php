{{-- Информационная страница: Доставка и оплата (статичный демо-шаблон) --}}
@extends('layouts.main-layout')

@section('title', 'Доставка и оплата — Coffee-Tea Shop')

@section('content')
    @include('components.breadcrumbs')

    <div class="wrap max-w-4xl pb-16">
        <h1 class="text-[34px] font-extrabold text-ink sm:text-[42px]">Доставка и оплата</h1>

        <h2 class="mt-8 text-2xl font-extrabold text-ink">Способы доставки</h2>
        <div class="mt-4 grid gap-4 sm:grid-cols-3">
            <div class="rounded-card border border-line bg-white p-5 shadow-card"><div class="font-bold text-ink">Курьером</div><p class="mt-2 text-sm text-body">По городу — 300 ₽, доставим за 1–2 дня.</p></div>
            <div class="rounded-card border border-line bg-white p-5 shadow-card"><div class="font-bold text-ink">Самовывоз</div><p class="mt-2 text-sm text-body">Бесплатно из нашего магазина.</p></div>
            <div class="rounded-card border border-line bg-white p-5 shadow-card"><div class="font-bold text-ink">Почтой России</div><p class="mt-2 text-sm text-body">От 250 ₽, 3–7 дней по России.</p></div>
        </div>

        <h2 class="mt-10 text-2xl font-extrabold text-ink">Оплата</h2>
        <ul class="mt-4 space-y-3 text-body">
            <li class="flex gap-3"><span class="text-accent-dark">•</span> Банковской картой онлайн.</li>
            <li class="flex gap-3"><span class="text-accent-dark">•</span> Наличными при получении.</li>
            <li class="flex gap-3"><span class="text-accent-dark">•</span> Безналичный расчёт для организаций.</li>
        </ul>
    </div>
@endsection
